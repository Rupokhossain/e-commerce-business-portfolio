@props([
    'title' => null,
    'description' => 'ProudRock Ltd. — B2B hardware, Auto-ID, RFID, access control, and workplace automation showcase.',
    'image' => null,
])

@php
    $companyName = $siteSettings['company_name'] ?? 'ProudRock Ltd.';
    $pageTitle = $title ? "{$title} — {$companyName}" : $companyName;
    $currentUrl = url()->current();
    $ogImage = $image ?: asset('images/categories/barcode-auto-id.jpg');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description }}">

        {{-- OpenGraph Social Media Meta Tags --}}
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:url" content="{{ $currentUrl }}">
        <meta property="og:site_name" content="{{ $companyName }}">
        <meta property="og:image" content="{{ $ogImage }}">

        {{-- Twitter / X Meta Tags --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $description }}">
        <meta name="twitter:image" content="{{ $ogImage }}">

        <title>{{ $pageTitle }}</title>

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
    <body class="min-h-screen flex flex-col bg-surface-canvas text-ink-primary font-sans antialiased overflow-x-clip selection:bg-brand-accent selection:text-brand-primary">
        {{-- Top Branded Page Loading Progress Bar --}}
        <div id="page-progress-bar" aria-hidden="true"></div>

        <x-layout.header />

        <main class="flex-1">
            {{ $slot }}
        </main>

        <x-layout.footer />

        {{-- Global Image Lightbox Modal --}}
        <x-ui.lightbox />

        {{-- Global Toast Notification System --}}
        <x-ui.toast />

        {{-- Floating Back to Top Action Button --}}
        <button
            type="button"
            id="back-to-top-btn"
            aria-label="Back to top"
            title="Scroll to top"
            class="is-hidden fixed bottom-6 right-6 z-40 flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-primary text-brand-accent shadow-xl border border-white/20 hover:bg-brand-primary-hover hover:scale-110 active:scale-95 transition-all duration-200 cursor-pointer backdrop-blur-md"
        >
            <x-icon name="arrow-up" class="w-5 h-5 stroke-[2.5]" />
        </button>
    </body>
</html>
