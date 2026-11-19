<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $portfolios = Portfolio::query()->ordered()->paginate(15)->withQueryString();

        if ($portfolios->isEmpty() && $portfolios->currentPage() > 1) {
            return redirect()->to(
                $request->fullUrlWithQuery(['page' => $portfolios->lastPage() ?: 1])
            );
        }

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        $portfolio = new Portfolio([
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 0,
        ]);

        return view('admin.portfolios.create', compact('portfolio'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolios,slug'],
            'client_name' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'challenge_solution' => ['nullable', 'string'],
            'results_metric' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'deployed_at' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'hardware_used_text' => ['nullable', 'string'],
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        if (! empty($validated['hardware_used_text'])) {
            $lines = array_map('trim', explode(',', $validated['hardware_used_text']));
            $validated['hardware_used'] = array_values(array_filter($lines));
        } else {
            $validated['hardware_used'] = [];
        }
        unset($validated['hardware_used_text']);

        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/portfolios');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/portfolios');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image'] = 'storage/portfolios/' . $filename;
        }

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Case study deployment created successfully.');
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('portfolios')->ignore($portfolio->id)],
            'client_name' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'challenge_solution' => ['nullable', 'string'],
            'results_metric' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'deployed_at' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'hardware_used_text' => ['nullable', 'string'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if (! empty($validated['hardware_used_text'])) {
            $lines = array_map('trim', explode(',', $validated['hardware_used_text']));
            $validated['hardware_used'] = array_values(array_filter($lines));
        } else {
            $validated['hardware_used'] = [];
        }
        unset($validated['hardware_used_text']);

        if ($request->hasFile('image_file')) {
            $request->validate(['image_file' => ['image', 'max:4096']]);
            $file = $request->file('image_file');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/portfolios');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/portfolios');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['image'] = 'storage/portfolios/' . $filename;
        }

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Case study deployment updated successfully.');
    }

    public function destroy(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        $redirectTo = $request->input('redirect_to') ?: route('admin.portfolios.index');

        return redirect()->to($redirectTo)
            ->with('success', 'Case study deployment deleted successfully.');
    }
}
