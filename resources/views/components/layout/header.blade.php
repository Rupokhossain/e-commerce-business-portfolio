@php
    $companyName = $siteSettings['company_name'] ?? 'Proud Rock Limited';
    $logoPath = $siteSettings['site_logo'] ?? null;
    $topbarEnabled = ($siteSettings['header_topbar_enabled'] ?? '1') === '1';
    $topbarNotice = $siteSettings['header_topbar_notice'] ?? 'Formed in 2018 · Registered in Bangladesh · Affiliate AUTOROMO (Active Since 2017)';
    $phone = $siteSettings['contact_phone'] ?? '+880 1712-806237';
    $mobile = $siteSettings['contact_mobile'] ?? '+880 1673-638094';
    $support247 = $siteSettings['contact_support_24_7'] ?? ($mobile ?: '+880 1673-638094');
    $businessHotline = $siteSettings['contact_hotline_business'] ?? ($phone ?: '+880 1712-806237');
    $email = $siteSettings['contact_email'] ?? 'info@proudrock.com.bd';
    $officeHours = $siteSettings['office_hours'] ?? 'Sat – Thu · 9:00 AM – 6:00 PM';
    $topbarRightText = $siteSettings['header_topbar_right_text'] ?? null;
    $ctaText = $siteSettings['header_cta_text'] ?? 'Request Quote';

    $isHome = request()->routeIs('home');
    $isProducts = request()->routeIs('products.*');
    $isCompanyProfile = request()->routeIs('company.profile');
    $isGallery = request()->routeIs('gallery.*');
    $isPortfolio = request()->routeIs('portfolio.*');
    $isContact = request()->routeIs('contact.*');
@endphp

<header class="sticky top-0 z-40 w-full">
    {{-- Tier 1: Slim Midnight Indigo Utility Topbar (Responsive, Admin Toggleable) --}}
    @if ($topbarEnabled)
        <div class="bg-brand-primary text-white/90 border-b border-white/10">
            {{-- Mobile & Tablet Compact Topbar --}}
            <div class="lg:hidden max-w-[1520px] mx-auto px-3 sm:px-6 h-8 flex items-center justify-between gap-2 text-[11px]">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $support247) }}" class="inline-flex items-center gap-1 text-emerald-400 font-semibold truncate">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="truncate">24/7: {{ $support247 }}</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $businessHotline) }}" class="inline-flex items-center gap-1 text-white/90 truncate">
                    <x-icon name="phone" class="w-3 h-3 text-brand-accent shrink-0" />
                    <span class="truncate">Hotline: {{ $businessHotline }}</span>
                </a>
            </div>

            {{-- Desktop Full Topbar --}}
            <div class="hidden lg:flex max-w-[1520px] mx-auto px-6 lg:px-8 h-9 items-center justify-between text-xs">
                <div class="flex items-center gap-5">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $support247) }}" class="inline-flex items-center gap-1.5 text-emerald-300 font-semibold hover:text-white transition-colors">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>24/7 Support: {{ $support247 }}</span>
                    </a>
                    <span class="text-white/25" aria-hidden="true">|</span>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $businessHotline) }}" class="inline-flex items-center gap-1.5 hover:text-brand-accent transition-colors">
                        <x-icon name="phone" class="w-3.5 h-3.5 text-brand-accent" />
                        <span>Sales Hotline (9 AM – 6 PM): {{ $businessHotline }}</span>
                    </a>
                    <span class="text-white/25" aria-hidden="true">|</span>
                    <a href="mailto:{{ $email }}" class="inline-flex items-center gap-1.5 hover:text-brand-accent transition-colors">
                        <x-icon name="mail" class="w-3.5 h-3.5 text-brand-accent" />
                        <span>{{ $email }}</span>
                    </a>
                </div>

                {{-- Right Topbar: Business Schedule & OEM Authorization Badge (Configurable in Dashboard) --}}
                <div class="hidden sm:flex items-center gap-4 text-xs">
                    @if (! empty($topbarRightText))
                        <span class="text-white/85 font-medium">{{ $topbarRightText }}</span>
                    @else
                        <div class="flex items-center gap-1.5 text-white/75">
                            <x-icon name="clock" class="w-3.5 h-3.5 text-brand-accent" />
                            <span>{{ $officeHours }}</span>
                        </div>
                        <span class="text-white/20" aria-hidden="true">•</span>
                        <div class="flex items-center gap-1.5 text-emerald-300 font-semibold">
                            <x-icon name="shield-check" class="w-3.5 h-3.5 text-emerald-400" />
                            <span>Authorized OEM &amp; AMC Partner</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Tier 2: Crisp Sticky Main Navbar --}}
    <div class="bg-white/95 backdrop-blur-md border-b border-border-hairline shadow-[0_1px_2px_rgba(16,0,99,0.03)]">
        <div class="max-w-[1520px] mx-auto px-3 sm:px-6 lg:px-8 h-16 lg:h-[72px] flex items-center justify-between gap-2 sm:gap-4 lg:gap-6">
            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="shrink-0 min-w-0 rounded-md focus-visible:outline-offset-4" aria-label="{{ $companyName }} Home">
                <x-ui.brand-logo variant="dark" :logo-path="$logoPath" :company-name="$companyName" />
            </a>

            {{-- Primary Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-6 xl:gap-8" aria-label="Primary navigation">
                <a
                    href="{{ route('home') }}"
                    class="relative py-2 text-sm font-medium transition-colors {{ $isHome ? 'text-brand-primary font-semibold' : 'text-ink-secondary hover:text-brand-primary' }}"
                >
                    Home
                    @if ($isHome)
                        <span class="absolute inset-x-0 -bottom-[1px] h-0.5 rounded-full bg-brand-accent"></span>
                    @endif
                </a>

                {{-- Products + Dynamic Categories Dropdown --}}
                <div class="relative" data-products-dropdown>
                    <div class="flex items-center gap-1">
                        <a
                            href="{{ route('products.index') }}"
                            class="relative py-2 text-sm font-medium transition-colors {{ $isProducts ? 'text-brand-primary font-semibold' : 'text-ink-secondary hover:text-brand-primary' }}"
                        >
                            Products
                            @if ($isProducts)
                                <span class="absolute inset-x-0 -bottom-[1px] h-0.5 rounded-full bg-brand-accent"></span>
                            @endif
                        </a>
                        <button
                            type="button"
                            data-products-trigger
                            aria-expanded="false"
                            aria-haspopup="true"
                            aria-label="Toggle product categories menu"
                            class="p-1 rounded-md text-ink-muted hover:text-brand-primary hover:bg-brand-primary-soft/60 transition-colors cursor-pointer"
                        >
                            <x-icon name="chevron-down" class="w-4 h-4" />
                        </button>
                    </div>

                    {{-- Dynamic Categories Mega-Dropdown --}}
                    <div
                        data-products-menu
                        class="hidden absolute left-1/2 -translate-x-1/2 top-full pt-3 w-[min(540px,calc(100vw-2rem))] z-50"
                    >
                        <div class="bg-white rounded-xl border border-border-hairline shadow-(--shadow-card-hover) overflow-hidden">
                            <div class="px-5 py-3 bg-surface-subtle/70 border-b border-border-hairline flex items-center justify-between">
                                <span class="text-xs font-semibold uppercase tracking-[0.08em] text-ink-muted">
                                    Product Categories
                                </span>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-brand-primary hover:text-brand-primary-hover">
                                    <span>View All Products</span>
                                    <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                                </a>
                            </div>

                            <div class="p-3 grid grid-cols-2 gap-1.5">
                                @forelse ($navCategories as $category)
                                    <a
                                        href="{{ route('products.index', ['category' => $category->slug]) }}"
                                        class="group flex items-start gap-3 p-2.5 rounded-lg hover:bg-brand-primary-soft/60 transition-colors"
                                    >
                                        <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-surface-subtle text-brand-primary group-hover:bg-brand-primary group-hover:text-white transition-colors">
                                            <x-icon :name="$category->icon ?: 'layers'" class="w-4 h-4" />
                                        </span>
                                        <span class="min-w-0">
                                            <span class="block text-sm font-medium text-ink-primary group-hover:text-brand-primary truncate">
                                                {{ $category->name }}
                                            </span>
                                            @if ($category->short_description)
                                                <span class="block text-xs text-ink-muted line-clamp-1 mt-0.5">
                                                    {{ $category->short_description }}
                                                </span>
                                            @endif
                                        </span>
                                    </a>
                                @empty
                                    <div class="col-span-2 px-3 py-4 text-sm text-ink-muted text-center">
                                        No active categories yet.
                                    </div>
                                @endforelse
                            </div>

                            <div class="px-5 py-3 bg-brand-primary text-white flex items-center justify-between">
                                <span class="text-xs text-white/85">Need custom hardware or enterprise integration?</span>
                                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-brand-accent hover:underline">
                                    <span>Talk to Engineering</span>
                                    <x-icon name="arrow-up-right" class="w-3.5 h-3.5" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <a
                    href="{{ route('gallery.index') }}"
                    class="relative py-2 text-sm font-medium transition-colors {{ $isGallery ? 'text-brand-primary font-semibold' : 'text-ink-secondary hover:text-brand-primary' }}"
                >
                    Gallery
                    @if ($isGallery)
                        <span class="absolute inset-x-0 -bottom-[1px] h-0.5 rounded-full bg-brand-accent"></span>
                    @endif
                </a>

                <a
                    href="{{ route('company.profile') }}"
                    class="relative py-2 text-sm font-medium transition-colors {{ $isCompanyProfile ? 'text-brand-primary font-semibold' : 'text-ink-secondary hover:text-brand-primary' }}"
                >
                    Company Profile
                    @if ($isCompanyProfile)
                        <span class="absolute inset-x-0 -bottom-[1px] h-0.5 rounded-full bg-brand-accent"></span>
                    @endif
                </a>

                <a
                    href="{{ route('portfolio.index') }}"
                    class="relative py-2 text-sm font-medium transition-colors {{ $isPortfolio ? 'text-brand-primary font-semibold' : 'text-ink-secondary hover:text-brand-primary' }}"
                >
                    Portfolio
                    @if ($isPortfolio)
                        <span class="absolute inset-x-0 -bottom-[1px] h-0.5 rounded-full bg-brand-accent"></span>
                    @endif
                </a>

                <a
                    href="{{ route('contact.index') }}"
                    class="relative py-2 text-sm font-medium transition-colors {{ $isContact ? 'text-brand-primary font-semibold' : 'text-ink-secondary hover:text-brand-primary' }}"
                >
                    Contact
                    @if ($isContact)
                        <span class="absolute inset-x-0 -bottom-[1px] h-0.5 rounded-full bg-brand-accent"></span>
                    @endif
                </a>
            </nav>

            {{-- Right Actions (Search + Login/Dashboard + Request Quote CTA, Zero Cart) --}}
            <div class="flex items-center gap-1.5 sm:gap-2.5 shrink-0">
                <button
                    type="button"
                    data-search-toggle
                    aria-expanded="false"
                    aria-label="Search products"
                    class="inline-flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-lg border border-border-hairline bg-white text-ink-secondary hover:border-brand-primary/40 hover:text-brand-primary transition-colors cursor-pointer"
                >
                    <x-icon name="search" class="w-4 h-4" />
                </button>

                @auth
                    <x-ui.button :href="route('admin.dashboard')" variant="outline" size="sm" class="sm:px-4 sm:py-2.5 sm:text-sm">
                        <x-icon name="layout-dashboard" class="hidden min-[380px]:block w-3.5 h-3.5 sm:w-4 sm:h-4 text-brand-primary" />
                        <span>Dashboard</span>
                    </x-ui.button>
                @else
                    <x-ui.button :href="route('admin.login')" variant="outline" size="sm" class="sm:px-4 sm:py-2.5 sm:text-sm">
                        <x-icon name="log-in" class="hidden min-[380px]:block w-3.5 h-3.5 sm:w-4 sm:h-4 text-brand-primary" />
                        <span>Login</span>
                    </x-ui.button>
                @endauth

                <div class="hidden sm:block">
                    <x-ui.button :href="route('contact.index')" variant="primary" size="md">
                        <span>{{ $ctaText }}</span>
                        <x-icon name="arrow-up-right" class="w-4 h-4 text-brand-accent" />
                    </x-ui.button>
                </div>

                {{-- Mobile Menu Toggle --}}
                <button
                    type="button"
                    data-mobile-open
                    aria-expanded="false"
                    aria-label="Open navigation menu"
                    class="lg:hidden inline-flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-lg border border-border-hairline bg-white text-ink-primary hover:border-brand-primary/40 hover:text-brand-primary transition-colors cursor-pointer"
                >
                    <x-icon name="menu" class="w-5 h-5" />
                </button>
            </div>
        </div>

        {{-- Expandable Quick Search Bar --}}
        <div data-search-panel class="hidden border-t border-border-hairline bg-surface-subtle/70">
            <div class="max-w-[1520px] mx-auto px-3 sm:px-6 lg:px-8 py-3 sm:py-3.5">
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-2 sm:gap-2.5">
                    <div class="relative flex-1 min-w-0">
                        <span class="pointer-events-none absolute inset-y-0 left-3 sm:left-3.5 flex items-center text-ink-muted">
                            <x-icon name="search" class="w-4 h-4" />
                        </span>
                        <input
                            type="search"
                            name="q"
                            value="{{ request('q') }}"
                            data-search-input
                            placeholder="Search hardware, model, SKU, RFID, barcode..."
                            class="w-full h-10 sm:h-11 pl-9 sm:pl-10 pr-3 sm:pr-4 rounded-lg border border-border-hairline bg-white text-sm text-ink-primary placeholder:text-ink-muted focus:border-brand-primary focus:outline-none"
                        />
                    </div>
                    <x-ui.button type="submit" variant="primary" size="md" class="h-10 sm:h-11 px-3.5 sm:px-5 shrink-0">
                        Search
                    </x-ui.button>
                    <button
                        type="button"
                        data-search-close
                        aria-label="Close search"
                        class="inline-flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-lg border border-border-hairline bg-white text-ink-secondary hover:text-ink-primary cursor-pointer"
                    >
                        <x-icon name="x" class="w-4 h-4" />
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Mobile & Tablet Slide-Over Drawer --}}
    <div data-mobile-drawer class="hidden fixed inset-0 z-50 lg:hidden" role="dialog" aria-modal="true" aria-label="Mobile navigation">
        <div data-mobile-close class="fixed inset-0 bg-slate-950/50 backdrop-blur-xs"></div>

        <div class="fixed inset-y-0 right-0 w-full max-w-[85vw] sm:max-w-sm h-dvh bg-white shadow-2xl flex flex-col justify-between overflow-y-auto">
            <div>
                <div class="px-4 sm:px-5 h-16 border-b border-border-hairline flex items-center justify-between">
                    <a href="{{ route('home') }}" class="shrink-0">
                        <x-ui.brand-logo variant="dark" :logo-path="$logoPath" :company-name="$companyName" />
                    </a>
                    <button
                        type="button"
                        data-mobile-close
                        aria-label="Close navigation menu"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-border-hairline text-ink-secondary hover:text-brand-primary cursor-pointer"
                    >
                        <x-icon name="x" class="w-5 h-5" />
                    </button>
                </div>

                <nav class="p-4 space-y-1" aria-label="Mobile navigation links">
                    <a
                        href="{{ route('home') }}"
                        class="flex items-center justify-between px-3.5 py-3 rounded-lg text-sm font-medium {{ $isHome ? 'bg-brand-primary-soft text-brand-primary font-semibold' : 'text-ink-primary hover:bg-surface-subtle' }}"
                    >
                        <span>Home</span>
                        <x-icon name="chevron-right" class="w-4 h-4 text-ink-muted" />
                    </a>

                    <div class="rounded-lg {{ $isProducts ? 'bg-brand-primary-soft/50' : '' }}">
                        <div class="flex items-center justify-between">
                            <a
                                href="{{ route('products.index') }}"
                                class="flex-1 px-3.5 py-3 text-sm font-medium {{ $isProducts ? 'text-brand-primary font-semibold' : 'text-ink-primary' }}"
                            >
                                Products
                            </a>
                            <button
                                type="button"
                                data-mobile-products-toggle
                                aria-expanded="false"
                                aria-label="Expand product categories"
                                class="p-3 text-ink-secondary hover:text-brand-primary cursor-pointer"
                            >
                                <x-icon name="chevron-down" data-mobile-products-icon class="w-4 h-4 transition-transform duration-200" />
                            </button>
                        </div>

                        <div data-mobile-products-list class="hidden px-3 pb-3 space-y-1">
                            @foreach ($navCategories as $category)
                                <a
                                    href="{{ route('products.index', ['category' => $category->slug]) }}"
                                    class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-medium text-ink-secondary hover:bg-white hover:text-brand-primary transition-colors"
                                >
                                    <x-icon :name="$category->icon ?: 'layers'" class="w-3.5 h-3.5 text-brand-primary" />
                                    <span>{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a
                        href="{{ route('gallery.index') }}"
                        class="flex items-center justify-between px-3.5 py-3 rounded-lg text-sm font-medium {{ $isGallery ? 'bg-brand-primary-soft text-brand-primary font-semibold' : 'text-ink-primary hover:bg-surface-subtle' }}"
                    >
                        <span>Deployments Gallery</span>
                        <x-icon name="chevron-right" class="w-4 h-4 text-ink-muted" />
                    </a>

                    <a
                        href="{{ route('company.profile') }}"
                        class="flex items-center justify-between px-3.5 py-3 rounded-lg text-sm font-medium {{ $isCompanyProfile ? 'bg-brand-primary-soft text-brand-primary font-semibold' : 'text-ink-primary hover:bg-surface-subtle' }}"
                    >
                        <span>Company Profile</span>
                        <x-icon name="chevron-right" class="w-4 h-4 text-ink-muted" />
                    </a>

                    <a
                        href="{{ route('portfolio.index') }}"
                        class="flex items-center justify-between px-3.5 py-3 rounded-lg text-sm font-medium {{ $isPortfolio ? 'bg-brand-primary-soft text-brand-primary font-semibold' : 'text-ink-primary hover:bg-surface-subtle' }}"
                    >
                        <span>Portfolio &amp; Cases</span>
                        <x-icon name="chevron-right" class="w-4 h-4 text-ink-muted" />
                    </a>

                    <a
                        href="{{ route('contact.index') }}"
                        class="flex items-center justify-between px-3.5 py-3 rounded-lg text-sm font-medium {{ $isContact ? 'bg-brand-primary-soft text-brand-primary font-semibold' : 'text-ink-primary hover:bg-surface-subtle' }}"
                    >
                        <span>Contact</span>
                        <x-icon name="chevron-right" class="w-4 h-4 text-ink-muted" />
                    </a>
                </nav>
            </div>

            <div class="p-5 border-t border-border-hairline bg-surface-subtle/60 space-y-4">
                <div class="space-y-2 text-xs text-ink-secondary">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $mobile) }}" class="flex items-center gap-2 hover:text-brand-primary">
                        <x-icon name="phone" class="w-4 h-4 text-brand-primary" />
                        <span>{{ $mobile }}</span>
                    </a>
                    <a href="mailto:{{ $email }}" class="flex items-center gap-2 hover:text-brand-primary">
                        <x-icon name="mail" class="w-4 h-4 text-brand-primary" />
                        <span>{{ $email }}</span>
                    </a>
                    <div class="flex items-center gap-2 text-ink-muted">
                        <x-icon name="clock" class="w-4 h-4 text-brand-primary" />
                        <span>{{ $officeHours }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    @auth
                        <x-ui.button :href="route('admin.dashboard')" variant="outline" size="md" class="w-full">
                            <x-icon name="layout-dashboard" class="w-4 h-4 text-brand-primary" />
                            <span>Dashboard</span>
                        </x-ui.button>
                    @else
                        <x-ui.button :href="route('admin.login')" variant="outline" size="md" class="w-full">
                            <x-icon name="log-in" class="w-4 h-4 text-brand-primary" />
                            <span>Login</span>
                        </x-ui.button>
                    @endauth

                    <x-ui.button :href="route('contact.index')" variant="accent" size="md" class="w-full">
                        <span>{{ $ctaText }}</span>
                        <x-icon name="arrow-up-right" class="w-4 h-4" />
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</header>
