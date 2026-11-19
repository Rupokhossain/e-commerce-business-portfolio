<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $slides = HeroSlide::query()->ordered()->paginate(15)->withQueryString();

        if ($slides->isEmpty() && $slides->currentPage() > 1) {
            return redirect()->to(
                $request->fullUrlWithQuery(['page' => $slides->lastPage() ?: 1])
            );
        }

        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create(): View
    {
        $slide = new HeroSlide([
            'cta_text' => 'Explore Solutions',
            'link_url' => '/products',
            'show_overlay' => true,
            'is_active' => true,
            'sort_order' => 0,
        ]);

        return view('admin.hero-slides.create', compact('slide'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'show_overlay' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['show_overlay'] = $request->boolean('show_overlay');
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/slides');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/slides');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image_path'] = 'storage/slides/' . $filename;
        }

        if (empty($validated['image_path'])) {
            $validated['image_path'] = 'images/slides/slide-1.jpg';
        }

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $hero_slide): View
    {
        return view('admin.hero-slides.edit', ['slide' => $hero_slide]);
    }

    public function update(Request $request, HeroSlide $hero_slide): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'show_overlay' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['show_overlay'] = $request->boolean('show_overlay');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/slides');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/slides');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image_path'] = 'storage/slides/' . $filename;
        }

        $hero_slide->update($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(Request $request, HeroSlide $hero_slide): RedirectResponse
    {
        $hero_slide->delete();

        $redirectTo = $request->input('redirect_to') ?: route('admin.hero-slides.index');

        return redirect()->to($redirectTo)
            ->with('success', 'Hero slide deleted successfully.');
    }
}
