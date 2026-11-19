<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $categories = Category::query()
            ->withCount('products')
            ->ordered()
            ->paginate(15);

        if ($categories->isEmpty() && $categories->currentPage() > 1) {
            $lastPage = $categories->lastPage() ?: 1;
            return redirect()->route('admin.categories.index', array_merge($request->query(), ['page' => $lastPage]));
        }

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $category = new Category([
            'icon' => 'layers',
            'is_active' => true,
            'sort_order' => 0,
        ]);

        return view('admin.categories.create', compact('category'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/categories');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/categories');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image'] = 'storage/categories/' . $filename;
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/categories');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/categories');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image'] = 'storage/categories/' . $filename;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category with associated products. Reassign or delete products first.');
        }

        $name = $category->name;
        $category->delete();

        $target = $request->input('redirect_to') ?: route('admin.categories.index');

        return redirect()->to($target)
            ->with('success', "Category '{$name}' deleted successfully.");
    }
}
