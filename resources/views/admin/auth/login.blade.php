@php
    $companyName = $siteSettings['company_name'] ?? 'ProudRock Ltd.';
    $logoPath = $siteSettings['site_logo'] ?? null;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login — {{ $companyName }}</title>

        @php
            $customFavicon = !empty($siteSettings['site_favicon']) ? asset($siteSettings['site_favicon']) : null;
            $faviconSvg = $customFavicon ?: asset('favicon.svg');
            $faviconIco = asset('favicon.ico');
        @endphp
        <link rel="icon" type="image/svg+xml" href="{{ $faviconSvg }}">
        <link rel="alternate icon" type="image/x-icon" href="{{ $faviconIco }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-surface-canvas text-ink-primary font-sans antialiased flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <a href="{{ route('home') }}" class="inline-flex">
                    <x-ui.brand-logo variant="dark" :logo-path="$logoPath" :company-name="$companyName" />
                </a>
            </div>

            <div class="mt-8 bg-white rounded-xl border border-border-hairline shadow-(--shadow-card) overflow-hidden">
                <div class="bg-brand-primary px-6 py-5 text-white flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-semibold uppercase tracking-[0.08em] text-brand-accent">
                            Control Center
                        </span>
                        <h1 class="mt-1 text-lg font-semibold">Admin Sign In</h1>
                    </div>
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-brand-accent">
                        <x-icon name="lock" class="w-5 h-5" />
                    </span>
                </div>

                <form action="{{ route('admin.login.submit') }}" method="POST" class="p-6 sm:p-7 space-y-5">
                    @csrf

                    @if ($errors->any())
                        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-xs text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-[0.06em] text-ink-secondary mb-1.5">
                            Email Address
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="admin@proudrock.com"
                            class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-white text-sm text-ink-primary placeholder:text-ink-muted focus:border-brand-primary focus:outline-none"
                        />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-[0.06em] text-ink-secondary mb-1.5">
                            Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-white text-sm text-ink-primary placeholder:text-ink-muted focus:border-brand-primary focus:outline-none"
                        />
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="inline-flex items-center gap-2 text-ink-secondary cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary" />
                            <span>Remember session</span>
                        </label>

                        <a href="{{ route('home') }}" class="inline-flex items-center gap-1 font-medium text-brand-primary hover:underline">
                            <x-icon name="arrow-left" class="w-3.5 h-3.5" />
                            <span>Back to Website</span>
                        </a>
                    </div>

                    <x-ui.button type="submit" variant="primary" size="lg" class="w-full">
                        <x-icon name="log-in" class="w-4 h-4 text-brand-accent" />
                        <span>Sign In to Dashboard</span>
                    </x-ui.button>
                </form>
            </div>
        </div>
    </body>
</html>
