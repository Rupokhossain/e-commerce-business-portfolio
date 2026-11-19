<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $query = Client::query();

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($sub) use ($search): void {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('sector', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('solution_provided', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $clients = $query->ordered()->paginate(15)->withQueryString();

        if ($clients->isEmpty() && $clients->currentPage() > 1) {
            return redirect()->to(
                $request->fullUrlWithQuery(['page' => $clients->lastPage() ?: 1])
            );
        }

        return view('admin.clients.index', compact('clients'));
    }

    public function create(): View
    {
        $client = new Client([
            'is_active' => true,
            'sort_order' => 0,
        ]);

        return view('admin.clients.create', compact('client'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:clients,slug'],
            'logo' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'solution_provided' => ['nullable', 'string', 'max:500'],
            'badge' => ['nullable', 'string', 'max:100'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $baseSlug = Str::slug(($validated['slug'] ?? null) ?: $validated['name']);
        $validated['slug'] = $this->generateUniqueSlug($baseSlug);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('logo_file')) {
            $request->validate(['logo_file' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096']]);
            $file = $request->file('logo_file');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/clients');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/clients');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['logo'] = 'storage/clients/' . $filename;
        }

        Client::create($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Principle client added successfully.');
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('clients')->ignore($client->id)],
            'logo' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'solution_provided' => ['nullable', 'string', 'max:500'],
            'badge' => ['nullable', 'string', 'max:100'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $baseSlug = Str::slug(($validated['slug'] ?? null) ?: $validated['name']);
        $validated['slug'] = $this->generateUniqueSlug($baseSlug, $client->id);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo_file')) {
            $request->validate(['logo_file' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096']]);
            $file = $request->file('logo_file');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = Str::random(40) . '.' . $extension;

            $publicDestination = public_path('storage/clients');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/clients');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $validated['logo'] = 'storage/clients/' . $filename;
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Principle client updated successfully.');
    }

    public function destroy(Request $request, Client $client): RedirectResponse
    {
        $name = $client->name;
        $client->delete();

        $redirectTo = $request->input('redirect_to') ?: route('admin.clients.index');

        return redirect()->to($redirectTo)
            ->with('success', "Client \"{$name}\" removed successfully.");
    }

    private function generateUniqueSlug(string $baseSlug, ?int $ignoreId = null): string
    {
        $slug = $baseSlug;
        $counter = 1;

        while (
            Client::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
