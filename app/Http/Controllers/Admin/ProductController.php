<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $status = $request->query('status');

        $query = Product::query()->with('category')->ordered();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model_number', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($status === 'featured') {
            $query->where('is_featured', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $products = $query->paginate(15)->withQueryString();

        if ($products->isEmpty() && $products->currentPage() > 1) {
            $lastPage = $products->lastPage() ?: 1;
            return redirect()->route('admin.products.index', array_merge($request->query(), ['page' => $lastPage]));
        }

        $categories = Category::query()->ordered()->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId', 'status'));
    }

    public function create(): View
    {
        $categories = Category::query()->active()->ordered()->get();
        $product = new Product([
            'availability_status' => 'in_stock',
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 0,
        ]);

        return view('admin.products.create', compact('product', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'required_without:new_category_name'],
            'new_category_name' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:100'],
            'brand_url' => ['nullable', 'string', 'max:255'],
            'model_number' => ['nullable', 'string', 'max:100'],
            'sku' => ['nullable', 'string', 'max:100'],
            'availability_status' => ['required', 'string', 'in:in_stock,on_request,discontinued'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'show_details_tab' => ['boolean'],
            'image' => ['nullable', 'string', 'max:255'],
            'datasheet_url' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'key_features_text' => ['nullable', 'string'],
            'specifications_text' => ['nullable', 'string'],
            'gallery_urls_text' => ['nullable', 'string'],
            'gallery_files.*' => ['nullable', 'image', 'max:4096'],
        ]);

        // Handle on-the-fly category creation if provided
        if (! empty($request->input('new_category_name'))) {
            $newCatName = trim($request->input('new_category_name'));
            $baseSlug = Str::slug($newCatName) ?: 'cat-' . time();
            $category = Category::query()->firstOrCreate(
                ['name' => $newCatName],
                [
                    'slug' => $baseSlug,
                    'is_active' => true,
                    'icon' => 'layers',
                    'sort_order' => (Category::max('sort_order') ?? 0) + 1,
                ]
            );
            $validated['category_id'] = $category->id;
        } else {
            // Validate category_id exists if new_category_name was empty
            $request->validate(['category_id' => ['required', 'exists:categories,id']]);
        }
        unset($validated['new_category_name']);

        // Generate unique slug automatically to prevent duplicate slug crash
        $validated['slug'] = $this->generateUniqueSlug($validated['name'], $validated['slug'] ?? null);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['show_details_tab'] = $request->boolean('show_details_tab', true);

        // Convert key_features_text (lines) to array
        if (! empty($validated['key_features_text'])) {
            $lines = array_map('trim', explode("\n", $validated['key_features_text']));
            $validated['key_features'] = array_values(array_filter($lines));
        } else {
            $validated['key_features'] = [];
        }
        unset($validated['key_features_text']);

        // Convert specifications_text (lines) to array of ['label' => ..., 'value' => ...]
        $validated['specifications'] = $this->parseSpecificationsText($validated['specifications_text'] ?? null);
        unset($validated['specifications_text']);

        // Process gallery images (multiple uploads + manual paths)
        $validated['gallery'] = $this->processGallery($request);
        unset($validated['gallery_urls_text']);

        // Handle image file upload directly to public/storage/products so it never fails on Windows
        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/products');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            // Mirror backup into storage/app/public/products
            $storageBackup = storage_path('app/public/products');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image'] = 'storage/products/' . $filename;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::query()->ordered()->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'required_without:new_category_name'],
            'new_category_name' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:100'],
            'brand_url' => ['nullable', 'string', 'max:255'],
            'model_number' => ['nullable', 'string', 'max:100'],
            'sku' => ['nullable', 'string', 'max:100'],
            'availability_status' => ['required', 'string', 'in:in_stock,on_request,discontinued'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'show_details_tab' => ['boolean'],
            'image' => ['nullable', 'string', 'max:255'],
            'datasheet_url' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'key_features_text' => ['nullable', 'string'],
            'specifications_text' => ['nullable', 'string'],
            'gallery_urls_text' => ['nullable', 'string'],
            'gallery_files.*' => ['nullable', 'image', 'max:4096'],
        ]);

        // Handle on-the-fly category creation if provided
        if (! empty($request->input('new_category_name'))) {
            $newCatName = trim($request->input('new_category_name'));
            $baseSlug = Str::slug($newCatName) ?: 'cat-' . time();
            $category = Category::query()->firstOrCreate(
                ['name' => $newCatName],
                [
                    'slug' => $baseSlug,
                    'is_active' => true,
                    'icon' => 'layers',
                    'sort_order' => (Category::max('sort_order') ?? 0) + 1,
                ]
            );
            $validated['category_id'] = $category->id;
        } else {
            $request->validate(['category_id' => ['required', 'exists:categories,id']]);
        }
        unset($validated['new_category_name']);

        $validated['slug'] = $this->generateUniqueSlug($validated['name'], $validated['slug'] ?? null, $product->id);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_details_tab'] = $request->boolean('show_details_tab');

        if (! empty($validated['key_features_text'])) {
            $lines = array_map('trim', explode("\n", $validated['key_features_text']));
            $validated['key_features'] = array_values(array_filter($lines));
        } else {
            $validated['key_features'] = [];
        }
        unset($validated['key_features_text']);

        // Convert specifications_text (lines) to array of ['label' => ..., 'value' => ...]
        $validated['specifications'] = $this->parseSpecificationsText($validated['specifications_text'] ?? null);
        unset($validated['specifications_text']);

        // Process gallery images (multiple uploads + manual paths)
        $validated['gallery'] = $this->processGallery($request, is_array($product->gallery) ? $product->gallery : []);
        unset($validated['gallery_urls_text']);

        // Handle image file upload directly to public/storage/products
        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/products');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            // Mirror backup into storage/app/public/products
            $storageBackup = storage_path('app/public/products');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image'] = 'storage/products/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        $target = $request->input('redirect_to') ?: route('admin.products.index');

        return redirect()->to($target)
            ->with('success', "Product '{$name}' deleted successfully.");
    }

    /**
     * Generate an always-unique slug to prevent Integrity constraint violation crashes.
     */
    protected function generateUniqueSlug(string $name, ?string $customSlug = null, ?int $ignoreId = null): string
    {
        $base = ! empty($customSlug) ? Str::slug($customSlug) : Str::slug($name);
        if (empty($base)) {
            $base = 'product-' . time();
        }

        $slug = $base;
        $counter = 1;

        while (Product::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Parse multiline specifications text into structured array of ['label' => ..., 'value' => ...].
     */
    protected function parseSpecificationsText(?string $text): array
    {
        if (empty($text)) {
            return [];
        }

        $rows = [];
        $lines = explode("\n", $text);

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Support: "Label: Value", "Label - Value", or "Label\tValue"
            if (str_contains($line, ':')) {
                [$label, $value] = explode(':', $line, 2);
            } elseif (str_contains($line, ' - ')) {
                [$label, $value] = explode(' - ', $line, 2);
            } elseif (str_contains($line, "\t")) {
                [$label, $value] = explode("\t", $line, 2);
            } else {
                $label = $line;
                $value = 'Yes';
            }

            $label = trim($label);
            $value = trim($value);

            if ($label !== '' && $value !== '') {
                $rows[] = [
                    'label' => $label,
                    'value' => $value,
                ];
            }
        }

        return $rows;
    }

    /**
     * Process multiple gallery uploads and manual/existing gallery URLs.
     *
     * @param array<int, string>|null $existingGallery
     * @return array<int, string>
     */
    protected function processGallery(Request $request, ?array $existingGallery = []): array
    {
        $gallery = [];

        // 1. Collect from manual / existing text area if provided
        if ($request->has('gallery_urls_text')) {
            $text = (string) $request->input('gallery_urls_text');
            $lines = array_map('trim', explode("\n", $text));
            foreach ($lines as $line) {
                if ($line !== '') {
                    $gallery[] = $line;
                }
            }
        } elseif (! empty($existingGallery)) {
            $gallery = $existingGallery;
        }

        // 2. Process multiple uploaded gallery files
        if ($request->hasFile('gallery_files')) {
            $publicDestination = public_path('storage/products');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $storageBackup = storage_path('app/public/products');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }

            foreach ($request->file('gallery_files') as $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension() ?: 'jpg';
                    $filename = Str::random(40) . '.' . $extension;
                    $file->move($publicDestination, $filename);
                    @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);
                    $gallery[] = 'storage/products/' . $filename;
                }
            }
        }

        return array_values(array_unique(array_filter($gallery)));
    }
}
