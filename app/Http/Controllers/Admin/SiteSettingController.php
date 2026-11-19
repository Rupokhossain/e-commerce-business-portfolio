<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::allMap();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $inputs = $request->except(['_token', '_method', 'site_logo_file', 'site_favicon_file', 'remove_site_logo', 'remove_site_favicon']);
        $mapped = [];

        // Handle Site Logo Upload
        if ($request->boolean('remove_site_logo')) {
            $mapped['site_logo'] = '';
        } elseif ($request->hasFile('site_logo_file')) {
            $request->validate([
                'site_logo_file' => ['image', 'mimes:png,jpg,jpeg,svg,webp', 'max:4096'],
            ]);

            $file = $request->file('site_logo_file');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = 'logo_' . time() . '_' . Str::random(8) . '.' . $extension;

            $publicDestination = public_path('storage/branding');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/branding');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $mapped['site_logo'] = 'storage/branding/' . $filename;
        }

        // Handle Favicon Upload
        if ($request->boolean('remove_site_favicon')) {
            $mapped['site_favicon'] = '';
        } elseif ($request->hasFile('site_favicon_file')) {
            $request->validate([
                'site_favicon_file' => ['file', 'mimes:ico,png,svg', 'max:2048'],
            ]);

            $file = $request->file('site_favicon_file');
            $extension = $file->getClientOriginalExtension() ?: 'ico';
            $filename = 'favicon_' . time() . '.' . $extension;

            $publicDestination = public_path('storage/branding');
            if (! is_dir($publicDestination)) {
                @mkdir($publicDestination, 0755, true);
            }
            $file->move($publicDestination, $filename);

            $storageBackup = storage_path('app/public/branding');
            if (! is_dir($storageBackup)) {
                @mkdir($storageBackup, 0755, true);
            }
            @copy($publicDestination . DIRECTORY_SEPARATOR . $filename, $storageBackup . DIRECTORY_SEPARATOR . $filename);

            $mapped['site_favicon'] = 'storage/branding/' . $filename;
        }

        if (! isset($inputs['social_links'])) {
            $mapped['social_links'] = json_encode([]);
        }

        foreach ($inputs as $key => $value) {
            if ($key === 'social_links' && is_array($value)) {
                $cleanSocial = array_values(array_filter($value, function ($row) {
                    return ! empty(trim($row['url'] ?? ''));
                }));
                $cleanSocial = array_map(function ($row) {
                    $row['is_active'] = isset($row['is_active'])
                        ? ((string) $row['is_active'] !== '0' && (string) $row['is_active'] !== 'false' && ! empty($row['is_active']))
                        : true;
                    return $row;
                }, $cleanSocial);
                $mapped[$key] = json_encode($cleanSocial);
            } else {
                $mapped[$key] = is_array($value) ? json_encode($value) : (string) ($value ?? '');
            }
        }

        SiteSetting::setMany($mapped);

        // Instantly purge all view and application cache so changes reflect on live site immediately
        try {
            \Illuminate\Support\Facades\Cache::flush();
            \Illuminate\Support\Facades\Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // Silently continue if artisan call fails in restricted environments
        }

        return back()->with('success', 'Site settings and branding updated successfully.');
    }
}
