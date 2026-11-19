<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BrandPartnerController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $partners = BrandPartner::query()->ordered()->paginate(15);

        if ($partners->isEmpty() && $partners->currentPage() > 1) {
            $lastPage = $partners->lastPage() ?: 1;
            return redirect()->route('admin.brand-partners.index', array_merge($request->query(), ['page' => $lastPage]));
        }

        return view('admin.brand-partners.index', compact('partners'));
    }

    public function create(): View
    {
        $partner = new BrandPartner([
            'is_active' => true,
            'sort_order' => 0,
        ]);

        return view('admin.brand-partners.create', compact('partner'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:brand_partners,slug'],
            'logo' => ['nullable', 'string', 'max:255'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('logo_file')) {
            $request->validate(['logo_file' => ['image', 'max:4096']]);
            $file = $request->file('logo_file');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/brands');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $this->autoTrimWhitespace($publicDestination . DIRECTORY_SEPARATOR . $filename);

            $storageBackup = storage_path('app/public/brands');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['logo'] = 'storage/brands/' . $filename;
        }

        BrandPartner::create($validated);

        return redirect()->route('admin.brand-partners.index')
            ->with('success', 'Brand partner added successfully.');
    }

    public function edit(BrandPartner $brand_partner): View
    {
        return view('admin.brand-partners.edit', ['partner' => $brand_partner]);
    }

    public function update(Request $request, BrandPartner $brand_partner): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('brand_partners')->ignore($brand_partner->id)],
            'logo' => ['nullable', 'string', 'max:255'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo_file')) {
            $request->validate(['logo_file' => ['image', 'max:4096']]);
            $file = $request->file('logo_file');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/brands');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $this->autoTrimWhitespace($publicDestination . DIRECTORY_SEPARATOR . $filename);

            $storageBackup = storage_path('app/public/brands');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['logo'] = 'storage/brands/' . $filename;
        }

        $brand_partner->update($validated);

        return redirect()->route('admin.brand-partners.index')
            ->with('success', 'Brand partner updated successfully.');
    }

    public function destroy(Request $request, BrandPartner $brand_partner): RedirectResponse
    {
        $name = $brand_partner->name;
        $brand_partner->delete();

        $target = $request->input('redirect_to') ?: route('admin.brand-partners.index');

        return redirect()->to($target)
            ->with('success', "Brand partner '{$name}' removed successfully.");
    }

    /**
     * Automatically crop excessive outer whitespace or transparency from uploaded brand logos.
     */
    private function autoTrimWhitespace(string $filePath): void
    {
        if (! extension_loaded('gd') || ! file_exists($filePath)) {
            return;
        }

        $info = @getimagesize($filePath);
        if (! $info) {
            return;
        }

        $mime = $info['mime'] ?? '';
        $src = match ($mime) {
            'image/png' => @imagecreatefrompng($filePath),
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($filePath),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($filePath) : null,
            default => null,
        };

        if (! $src) {
            return;
        }

        $w = imagesx($src);
        $h = imagesy($src);
        if ($w <= 10 || $h <= 10) {
            return;
        }

        $minX = $w;
        $maxX = 0;
        $minY = $h;
        $maxY = 0;

        for ($x = 0; $x < $w; $x += 2) {
            for ($y = 0; $y < $h; $y += 2) {
                $c = imagecolorat($src, $x, $y);
                $alpha = ($c >> 24) & 0x7F;
                $r = ($c >> 16) & 0xFF;
                $g = ($c >> 8) & 0xFF;
                $b = $c & 0xFF;

                $isWhite = ($r >= 248 && $g >= 248 && $b >= 248);
                $isTransparent = ($alpha >= 100);

                if (! $isTransparent && ! $isWhite) {
                    if ($x < $minX) $minX = $x;
                    if ($x > $maxX) $maxX = $x;
                    if ($y < $minY) $minY = $y;
                    if ($y > $maxY) $maxY = $y;
                }
            }
        }

        if ($maxX > $minX && $maxY > $minY) {
            $pad = 8;
            $cropX = max(0, $minX - $pad);
            $cropY = max(0, $minY - $pad);
            $cropW = min($w - $cropX, ($maxX - $minX) + ($pad * 2));
            $cropH = min($h - $cropY, ($maxY - $minY) + ($pad * 2));

            // Only crop if significantly trimmed (> 15% reduction in either axis)
            if ($cropW < $w * 0.95 || $cropH < $h * 0.95) {
                $dst = imagecreatetruecolor($cropW, $cropH);
                if ($mime === 'image/png') {
                    imagealphablending($dst, false);
                    imagesavealpha($dst, true);
                    $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
                    imagefilledrectangle($dst, 0, 0, $cropW, $cropH, $transparent);
                } else {
                    $white = imagecolorallocate($dst, 255, 255, 255);
                    imagefilledrectangle($dst, 0, 0, $cropW, $cropH, $white);
                }

                imagecopy($dst, $src, 0, 0, $cropX, $cropY, $cropW, $cropH);

                if ($mime === 'image/png') {
                    imagepng($dst, $filePath, 9);
                } else {
                    imagejpeg($dst, $filePath, 95);
                }
            }
        }
    }
}
