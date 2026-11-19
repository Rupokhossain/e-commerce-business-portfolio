@props([
    'title' => 'Admin Dashboard',
    'subtitle' => null,
    'breadcrumb' => null,
])

@php
    $companyName = $siteSettings['company_name'] ?? 'ProudRock Ltd.';
    $logoPath = $siteSettings['site_logo'] ?? null;
    $unreadCount = (int) ($newInquiriesCount ?? 0);

    $navLinks = [
        [
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'layout-dashboard',
            'pattern' => 'admin.dashboard',
            'badge' => null,
        ],
        [
            'name' => 'Inquiries & Leads',
            'route' => 'admin.inquiries.index',
            'icon' => 'inbox',
            'pattern' => 'admin.inquiries.*',
            'badge' => $unreadCount > 0 ? $unreadCount : null,
            'badge_color' => 'bg-brand-accent text-brand-primary',
        ],
        [
            'name' => 'Products',
            'route' => 'admin.products.index',
            'icon' => 'package',
            'pattern' => 'admin.products.*',
            'badge' => null,
        ],
        [
            'name' => 'Categories',
            'route' => 'admin.categories.index',
            'icon' => 'layers',
            'pattern' => 'admin.categories.*',
            'badge' => null,
        ],
        [
            'name' => 'Brand Partners',
            'route' => 'admin.brand-partners.index',
            'icon' => 'award',
            'pattern' => 'admin.brand-partners.*',
            'badge' => null,
        ],
        [
            'name' => 'Principle Clients',
            'route' => 'admin.clients.index',
            'icon' => 'building-2',
            'pattern' => 'admin.clients.*',
            'badge' => null,
        ],
        [
            'name' => 'Deployments Gallery',
            'route' => 'admin.portfolios.index',
            'icon' => 'images',
            'pattern' => 'admin.portfolios.*',
            'badge' => null,
        ],
        [
            'name' => 'Hero Slides',
            'route' => 'admin.hero-slides.index',
            'icon' => 'images',
            'pattern' => 'admin.hero-slides.*',
            'badge' => null,
        ],
        [
            'name' => 'Site Settings',
            'route' => 'admin.settings.index',
            'icon' => 'settings',
            'pattern' => 'admin.settings.*',
            'badge' => null,
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-surface-canvas">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>{{ $title }} — Admin Portal · {{ $companyName }}</title>

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
    <body class="h-full flex flex-col font-sans text-ink-primary antialiased bg-surface-canvas">
        {{-- Full Screen Admin App Shell --}}
        <div class="flex-1 flex overflow-hidden">
            {{-- DESKTOP SIDEBAR --}}
            <aside class="hidden lg:flex lg:flex-col lg:w-64 bg-brand-primary text-white border-r border-white/10 shrink-0 select-none shadow-xl">
                {{-- Sidebar Header --}}
                <div class="h-16 flex items-center justify-between px-5 border-b border-white/10">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 min-w-0">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-accent text-brand-primary font-black text-lg shadow-sm">
                            PR
                        </span>
                        <div class="min-w-0">
                            <span class="block text-sm font-bold text-white tracking-tight truncate">{{ $companyName }}</span>
                            <span class="block text-[10px] font-semibold tracking-wider uppercase text-brand-accent">Admin Panel</span>
                        </div>
                    </a>
                </div>

                {{-- Navigation Links --}}
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                    <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-white/50">
                        Core Management
                    </div>

                    @foreach ($navLinks as $item)
                        @php
                            $hasRoute = Route::has($item['route']);
                            $targetUrl = $hasRoute ? route($item['route']) : '#';
                            $isActive = $hasRoute && request()->routeIs($item['pattern']);
                        @endphp
                        <a
                            href="{{ $targetUrl }}"
                            class="group relative flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ $isActive ? 'bg-white/15 text-white shadow-inner font-bold' : 'text-white/75 hover:bg-white/10 hover:text-white' }}"
                        >
                            {{-- Active Gold Left Indicator --}}
                            @if ($isActive)
                                <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 rounded-r bg-brand-accent" aria-hidden="true"></span>
                            @endif

                            <div class="flex items-center gap-3 min-w-0">
                                <span class="{{ $isActive ? 'text-brand-accent' : 'text-white/60 group-hover:text-white transition-colors' }}">
                                    <x-icon :name="$item['icon']" class="w-4 h-4" />
                                </span>
                                <span class="truncate">{{ $item['name'] }}</span>
                            </div>

                            @if (!empty($item['badge']))
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ $item['badge_color'] ?? 'bg-brand-accent text-brand-primary' }} animate-pulse">
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </nav>

                {{-- Sidebar Footer / Live Site Link --}}
                <div class="p-3 border-t border-white/10 space-y-2 bg-brand-primary/40">
                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        rel="noopener"
                        class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-medium text-white/80 hover:bg-white/10 hover:text-white transition-colors"
                    >
                        <span class="flex items-center gap-2">
                            <x-icon name="external-link" class="w-3.5 h-3.5 text-brand-accent" />
                            <span>Public Website</span>
                        </span>
                        <x-icon name="arrow-up-right" class="w-3 h-3 text-white/50" />
                    </a>

                    <div class="px-3 py-1 flex items-center justify-between text-[11px] text-white/45">
                        <span>v1.0 Production</span>
                        <span>Laravel {{ app()->version() }}</span>
                    </div>
                </div>
            </aside>

            {{-- MOBILE SIDEBAR DRAWER (Off-canvas) --}}
            <div id="mobile-sidebar-backdrop" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden transition-opacity lg:hidden" aria-hidden="true">
                <div id="mobile-sidebar-panel" class="fixed inset-y-0 left-0 w-72 max-w-[85vw] bg-brand-primary text-white flex flex-col shadow-2xl transform -translate-x-full transition-transform duration-200 ease-in-out">
                    {{-- Mobile Header with Close Button --}}
                    <div class="h-16 flex items-center justify-between px-5 border-b border-white/10">
                        <div class="flex items-center gap-2.5">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-accent text-brand-primary font-black text-lg">
                                PR
                            </span>
                            <div>
                                <span class="block text-sm font-bold text-white">{{ $companyName }}</span>
                                <span class="block text-[10px] font-semibold uppercase text-brand-accent">Admin Panel</span>
                            </div>
                        </div>

                        <button
                            id="mobile-sidebar-close"
                            type="button"
                            class="p-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition-colors"
                            aria-label="Close sidebar"
                        >
                            <x-icon name="x" class="w-5 h-5" />
                        </button>
                    </div>

                    {{-- Mobile Nav Links --}}
                    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                        @foreach ($navLinks as $item)
                            @php
                                $hasRoute = Route::has($item['route']);
                                $targetUrl = $hasRoute ? route($item['route']) : '#';
                                $isActive = $hasRoute && request()->routeIs($item['pattern']);
                            @endphp
                            <a
                                href="{{ $targetUrl }}"
                                class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition-colors {{ $isActive ? 'bg-white/15 text-white font-bold' : 'text-white/75 hover:bg-white/10 hover:text-white' }}"
                            >
                                <div class="flex items-center gap-3">
                                    <span class="{{ $isActive ? 'text-brand-accent' : 'text-white/60' }}">
                                        <x-icon :name="$item['icon']" class="w-4 h-4" />
                                    </span>
                                    <span>{{ $item['name'] }}</span>
                                </div>

                                @if (!empty($item['badge']))
                                    <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-bold {{ $item['badge_color'] ?? 'bg-brand-accent text-brand-primary' }}">
                                        {{ $item['badge'] }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </nav>

                    {{-- Mobile Footer --}}
                    <div class="p-4 border-t border-white/10 space-y-2">
                        <a
                            href="{{ route('home') }}"
                            target="_blank"
                            class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-white/20 transition-colors"
                        >
                            <x-icon name="arrow-up-right" class="w-3.5 h-3.5 text-brand-accent" />
                            <span>View Public Website</span>
                        </a>

                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-rose-500/20 text-rose-200 text-xs font-semibold hover:bg-rose-500/30 transition-colors cursor-pointer"
                            >
                                <x-icon name="log-out" class="w-3.5 h-3.5" />
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT COLUMN --}}
            <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
                {{-- TOP HEADER BAR --}}
                <header class="sticky top-0 z-30 h-16 bg-white border-b border-border-hairline shadow-xs flex items-center justify-between px-4 sm:px-6 lg:px-8">
                    {{-- Left Header: Mobile Toggle & Page Title --}}
                    <div class="flex items-center gap-3 min-w-0">
                        <button
                            id="mobile-sidebar-toggle"
                            type="button"
                            class="lg:hidden p-2 -ml-2 rounded-lg text-ink-secondary hover:text-ink-primary hover:bg-surface-canvas transition-colors"
                            aria-label="Open sidebar"
                        >
                            <x-icon name="menu" class="w-5 h-5" />
                        </button>

                        <div class="min-w-0">
                            <h1 class="text-base sm:text-lg font-bold text-ink-primary truncate tracking-tight">
                                {{ $title }}
                            </h1>
                            @if ($subtitle)
                                <p class="hidden sm:block text-xs text-ink-muted truncate">
                                    {{ $subtitle }}
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Right Header Actions --}}
                    <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                        {{-- New RFQ Inquiries Bell Button --}}
                        <a
                            href="{{ Route::has('admin.inquiries.index') ? route('admin.inquiries.index') : '#' }}"
                            class="relative p-2 rounded-xl text-ink-secondary hover:text-brand-primary hover:bg-surface-canvas transition-colors"
                            title="{{ $unreadCount }} new quote inquiries"
                        >
                            <x-icon name="bell" class="w-4 h-4" />
                            @if ($unreadCount > 0)
                                <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-accent opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-accent"></span>
                                </span>
                            @endif
                        </a>

                        {{-- Quick View Site (Desktop) --}}
                        <a
                            href="{{ route('home') }}"
                            target="_blank"
                            class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border border-border-hairline text-ink-secondary hover:text-brand-primary hover:border-brand-primary/40 bg-surface-canvas transition-colors"
                        >
                            <x-icon name="arrow-up-right" class="w-3.5 h-3.5 text-brand-accent" />
                            <span>Live Site</span>
                        </a>

                        {{-- User Profile Pill & Logout --}}
                        <div class="flex items-center gap-2 pl-2 border-l border-border-hairline">
                            <div class="flex items-center gap-2">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-primary text-brand-accent font-bold text-xs uppercase shadow-xs">
                                    {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                                </span>
                                <div class="hidden xl:block text-left">
                                    <div class="text-xs font-bold text-ink-primary leading-none">{{ auth()->user()->name ?? 'Admin' }}</div>
                                    <div class="text-[10px] text-ink-muted leading-tight mt-0.5">{{ auth()->user()->email }}</div>
                                </div>
                            </div>

                            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                                @csrf
                                <button
                                    type="submit"
                                    class="p-2 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                    title="Sign Out"
                                >
                                    <x-icon name="log-out" class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                {{-- FLASH NOTIFICATIONS CONTAINER --}}
                <div class="px-4 sm:px-6 lg:px-8 pt-4">
                    @if (session('success'))
                        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs sm:text-sm text-emerald-800 flex items-center justify-between gap-3 shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <x-icon name="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0" />
                                <span>{{ session('success') }}</span>
                            </div>
                            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">&times;</button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs sm:text-sm text-rose-800 flex items-center justify-between gap-3 shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <x-icon name="alert-circle" class="w-4 h-4 text-rose-600 shrink-0" />
                                <span>{{ session('error') }}</span>
                            </div>
                            <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900">&times;</button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs sm:text-sm text-amber-900 shadow-xs">
                            <div class="font-bold flex items-center gap-2 mb-1">
                                <x-icon name="alert-circle" class="w-4 h-4 text-amber-600 shrink-0" />
                                <span>Please resolve the following errors:</span>
                            </div>
                            <ul class="list-disc pl-5 space-y-0.5 text-xs text-amber-800">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- INNER VIEW CONTENT SLOT --}}
                <main class="flex-1 px-3 sm:px-6 lg:px-8 py-4 sm:py-6 w-full max-w-full">
                    {{ $slot }}
                </main>

                {{-- ADMIN FOOTER --}}
                <footer class="mt-auto border-t border-border-hairline bg-white px-4 sm:px-6 lg:px-8 py-4 text-xs text-ink-muted flex flex-col sm:flex-row items-center justify-between gap-2">
                    <div>
                        &copy; {{ date('Y') }} <span class="font-semibold text-ink-primary">{{ $companyName }}</span>. All rights reserved.
                    </div>
                    <div class="flex items-center gap-4 text-[11px]">
                        <span>B2B Hardware &amp; System Integration</span>
                        <span>•</span>
                        <span class="text-emerald-600 font-medium flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            System Operational
                        </span>
                    </div>
                </footer>
            </div>
        </div>

        {{-- Lightweight Vanilla JS for Mobile Sidebar Toggle & Dropdowns --}}
        <script>
            (function() {
                const toggleBtn = document.getElementById('mobile-sidebar-toggle');
                const closeBtn = document.getElementById('mobile-sidebar-close');
                const backdrop = document.getElementById('mobile-sidebar-backdrop');
                const panel = document.getElementById('mobile-sidebar-panel');

                function openSidebar() {
                    backdrop.classList.remove('hidden');
                    setTimeout(() => {
                        panel.classList.remove('-translate-x-full');
                    }, 10);
                    document.body.classList.add('overflow-hidden');
                }

                function closeSidebar() {
                    panel.classList.add('-translate-x-full');
                    setTimeout(() => {
                        backdrop.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }, 200);
                }

                if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
                if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
                if (backdrop) {
                    backdrop.addEventListener('click', function(e) {
                        if (e.target === backdrop) closeSidebar();
                    });
                }

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && backdrop && !backdrop.classList.contains('hidden')) {
                        closeSidebar();
                    }
                });
            })();
        </script>

        {{-- Global Image Lightbox Modal --}}
        <x-ui.lightbox />

        {{-- Global Toast Notification System --}}
        <x-ui.toast />
    </body>
</html>
