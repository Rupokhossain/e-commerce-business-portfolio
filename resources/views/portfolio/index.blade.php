@php
    $aboutEnabled = ($siteSettings['portfolio_about_enabled'] ?? '1') === '1';
    $aboutEyebrow = $siteSettings['portfolio_about_eyebrow'] ?? 'Welcome to ProudRock Ltd.';
    $aboutTitle = $siteSettings['portfolio_about_title'] ?? 'B2B Hardware, Auto-ID & System Integration Partner in Bangladesh';
    $aboutBadge = $siteSettings['portfolio_about_badge'] ?? '15+ Years Experience';
    $aboutStatValue = $siteSettings['portfolio_about_stat_value'] ?? '500+';
    $aboutStatLabel = $siteSettings['portfolio_about_stat_label'] ?? 'Factories & Corporate Clients';
    $aboutBody1 = $siteSettings['portfolio_about_body_1'] ?? 'ProudRock Ltd. delivers end-to-end workplace automation, Auto-ID hardware, and custom system integration for manufacturing plants, logistics hubs, retail chains, banks, and corporate campuses across Bangladesh.';
    $aboutBody2 = $siteSettings['portfolio_about_body_2'] ?? 'Our solution stack brings together global OEM hardware—including Zebra & TSC barcode systems, Impinj & Chainway RAIN UHF RFID, FingerTec & ZKTeco biometric access & turnstiles, Sunmi & Epson POS, Sensormatic EAS anti-shoplifting systems, plus Arneg & Incold commercial refrigeration—backed by pre-deployment layout design, software integration, and nationwide support.';
    $aboutImage = $siteSettings['portfolio_about_image'] ?: 'images/portfolio-about.jpg';

    $whyEnabled = ($siteSettings['portfolio_why_enabled'] ?? '1') === '1';
    $whyEyebrow = $siteSettings['portfolio_why_eyebrow'] ?? 'Why Choose Us';
    $whyTitle = $siteSettings['portfolio_why_title'] ?? 'Engineered for Continuous Uptime & Measurable ROI';
    $whySummary = $siteSettings['portfolio_why_summary'] ?? 'Corporate hardware only pays off when installation, consumables, and preventive maintenance work as one reliable system.';
    $whyBadge = $siteSettings['portfolio_why_badge'] ?? 'Dedicated Dhaka Engineering Lab & SLA';
    $whyImage = $siteSettings['portfolio_why_image'] ?: 'images/categories/amc-support-services.jpg';

    $whyPillars = [
        [
            'num' => '01',
            'icon' => 'shield-check',
            'title' => 'Genuine OEM Supply',
            'text' => 'Factory-authentic printers, scanners, RFID portals & biometrics backed by full serial warranty.',
        ],
        [
            'num' => '02',
            'icon' => 'sliders-horizontal',
            'title' => 'Site Survey & Layout Plan',
            'text' => 'RF coverage mapping, label sizing, and equipment selection tailored before rollout.',
        ],
        [
            'num' => '03',
            'icon' => 'wrench',
            'title' => 'Turnkey Integration',
            'text' => 'Certified engineers handle ERP/HRMS middleware, cabling, drivers, and operator training.',
        ],
        [
            'num' => '04',
            'icon' => 'headphones',
            'title' => 'Local Spares & AMC SLA',
            'text' => 'Ready Dhaka inventory of printheads, ribbons, batteries & standby loaner hardware.',
        ],
    ];
@endphp

<x-layouts.app title="Portfolio" description="About ProudRock Ltd., why enterprises choose our engineering team, and verified B2B deployments across Bangladesh.">
    {{-- Compact Architectural Page Header --}}
    <section class="bg-white border-b border-border-hairline py-6 sm:py-8">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <nav class="flex items-center gap-2 text-xs text-ink-muted" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-ink-primary font-semibold">Portfolio &amp; Company Profile</span>
            </nav>

            <span class="inline-flex items-center gap-2 self-start sm:self-auto px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold">
                <x-icon name="briefcase" class="w-3.5 h-3.5" />
                <span>{{ $portfolios->total() }} Verified {{ Str::plural('Deployment', $portfolios->total()) }}</span>
            </span>
        </div>
    </section>

    {{-- Section 1: Unique Editorial "Welcome to ProudRock Ltd." Split Showcase --}}
    @if ($aboutEnabled)
        <section data-portfolio-about class="py-12 sm:py-16 lg:py-20 bg-white border-b border-border-hairline/70">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                    {{-- Left Architectural Visual Frame with Unclipped Vertical Indigo Experience Ribbon --}}
                    <div class="lg:col-span-5">
                        <div class="relative pl-12 sm:pl-14 py-4 sm:py-5 pr-2">
                            {{-- Midnight Indigo Architectural Backing Wrapping Top-Left, Left & Bottom-Left --}}
                            <div
                                class="absolute inset-y-0 left-0 w-[68%] rounded-2xl bg-brand-primary shadow-md"
                                aria-hidden="true"
                            >
                                <div class="w-12 sm:w-14 h-full flex items-center justify-center px-1">
                                    <span class="[writing-mode:vertical-rl] rotate-180 text-[11px] sm:text-xs font-bold uppercase tracking-[0.18em] text-brand-accent whitespace-nowrap">
                                        {{ $aboutBadge }}
                                    </span>
                                </div>
                            </div>

                            {{-- Framed Photo --}}
                            <div class="relative overflow-hidden rounded-2xl border border-border-hairline bg-surface-subtle shadow-(--shadow-elevated) aspect-[4/3]">
                                <img
                                    src="{{ asset($aboutImage) }}"
                                    alt="{{ $aboutEyebrow }}"
                                    class="w-full h-full object-cover object-center"
                                />
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-tr from-brand-primary/15 via-transparent to-transparent" aria-hidden="true"></div>
                            </div>

                            {{-- Floating Bottom-Right Client Stat Pill --}}
                            <div class="absolute right-0 sm:right-2 bottom-1 rounded-xl bg-white border border-border-hairline px-4 py-2.5 shadow-lg flex items-center gap-3">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-accent text-brand-primary font-bold shrink-0">
                                    <x-icon name="building-2" class="w-4 h-4" />
                                </span>
                                <div>
                                    <div class="text-sm sm:text-base font-extrabold text-brand-primary leading-none">{{ $aboutStatValue }}</div>
                                    <div class="mt-0.5 text-[11px] font-medium text-ink-secondary whitespace-nowrap">{{ $aboutStatLabel }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Editorial Story & Solution Pillars --}}
                    <div class="lg:col-span-7 space-y-5">
                        <div>
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                                <span>{{ $aboutEyebrow }}</span>
                            </span>

                            <h1 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-ink-primary leading-[1.18]">
                                {{ $aboutTitle }}
                            </h1>
                        </div>

                        <div class="space-y-3.5 text-sm sm:text-[15px] text-ink-secondary leading-relaxed">
                            <p>{{ $aboutBody1 }}</p>
                            <p>{{ $aboutBody2 }}</p>
                        </div>

                        {{-- Crisp Solution Badges Strip --}}
                        <div class="pt-2 grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            @foreach (['Barcode & Auto-ID', 'UHF RFID Portals', 'Biometric & Turnstiles', 'Retail POS & EAS'] as $tag)
                                <div class="flex items-center gap-2 rounded-xl border border-border-hairline bg-surface-canvas px-3 py-2.5 text-xs font-semibold text-brand-primary">
                                    <x-icon name="check-circle-2" class="w-4 h-4 text-brand-accent shrink-0" />
                                    <span class="truncate">{{ $tag }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Section 2: Unique Zig-Zag "Why Choose ProudRock" Engineering Showcase --}}
    @if ($whyEnabled)
        <section data-portfolio-why class="py-12 sm:py-16 lg:py-20 bg-surface-canvas border-b border-border-hairline/70">
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                    {{-- Left: 2x2 Architectural Trust Matrix --}}
                    <div class="lg:col-span-7 order-2 lg:order-1 space-y-6">
                        <div>
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                                <span>{{ $whyEyebrow }}</span>
                            </span>

                            <h2 class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-ink-primary leading-[1.2]">
                                {{ $whyTitle }}
                            </h2>

                            @if ($whySummary)
                                <p class="mt-2.5 text-sm sm:text-[15px] text-ink-secondary leading-relaxed max-w-2xl">
                                    {{ $whySummary }}
                                </p>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($whyPillars as $pillar)
                                <div class="rounded-2xl border border-border-hairline bg-white p-4 sm:p-5 shadow-(--shadow-card) hover:border-brand-primary/35 transition-colors">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-primary-soft text-brand-primary">
                                            <x-icon :name="$pillar['icon']" class="w-4 h-4" />
                                        </span>
                                        <span class="text-xs font-bold tracking-wider text-brand-accent bg-brand-primary px-2 py-0.5 rounded-md">
                                            {{ $pillar['num'] }}
                                        </span>
                                    </div>
                                    <h3 class="mt-3 text-sm sm:text-base font-semibold text-ink-primary">
                                        {{ $pillar['title'] }}
                                    </h3>
                                    <p class="mt-1 text-xs sm:text-[13px] text-ink-secondary leading-relaxed">
                                        {{ $pillar['text'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Right: Clean Framed Engineering Bench Photo with Integrated Indigo Caption Bar --}}
                    <div class="lg:col-span-5 order-1 lg:order-2">
                        <div class="overflow-hidden rounded-2xl border border-border-hairline bg-white shadow-(--shadow-elevated)">
                            <div class="relative aspect-[4/3] bg-surface-subtle overflow-hidden">
                                <img
                                    src="{{ asset($whyImage) }}"
                                    alt="{{ $whyEyebrow }}"
                                    class="w-full h-full object-cover object-center"
                                />
                            </div>

                            <div class="flex items-center justify-between gap-3 bg-brand-primary px-5 py-3.5 text-white border-t-2 border-brand-accent">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-accent text-brand-primary shrink-0">
                                        <x-icon name="award" class="w-4 h-4" />
                                    </span>
                                    <span class="text-xs sm:text-sm font-semibold truncate">{{ $whyBadge }}</span>
                                </div>
                                <span class="shrink-0 text-[11px] font-semibold uppercase tracking-wider text-brand-accent">
                                    OEM Certified
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Section 3: Filterable Client Deployments & Case Studies Grid --}}
    <section data-portfolio-cases class="py-12 sm:py-16 bg-white">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                        <span>Case Studies</span>
                    </span>
                    <h2 class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-ink-primary">
                        Enterprise Rollouts &amp; Case Studies
                    </h2>
                    <p class="mt-1.5 max-w-2xl text-sm text-ink-secondary">
                        Verified barcode, UHF RFID, biometric attendance, turnstile, and retail POS installations delivered by ProudRock engineers.
                    </p>
                </div>
            </div>

            @if ($industries->isNotEmpty())
                <div class="flex items-center gap-2 overflow-x-auto pb-1">
                    <a
                        href="{{ route('portfolio.index') }}"
                        class="shrink-0 px-3.5 py-2 rounded-lg text-xs sm:text-sm font-medium border transition-colors {{ $activeIndustry === '' ? 'bg-brand-primary text-white border-brand-primary' : 'bg-surface-canvas text-ink-secondary border-border-hairline hover:border-brand-primary/40 hover:text-brand-primary' }}"
                    >
                        All Industries
                    </a>

                    @foreach ($industries as $industry)
                        <a
                            href="{{ route('portfolio.index', ['industry' => $industry]) }}"
                            class="shrink-0 px-3.5 py-2 rounded-lg text-xs sm:text-sm font-medium border transition-colors {{ $activeIndustry === $industry ? 'bg-brand-primary text-white border-brand-primary' : 'bg-surface-canvas text-ink-secondary border-border-hairline hover:border-brand-primary/40 hover:text-brand-primary' }}"
                        >
                            {{ $industry }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($portfolios->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-7">
                    @foreach ($portfolios as $project)
                        <article class="reveal-on-scroll bg-white rounded-2xl border border-border-hairline shadow-(--shadow-card) hover:shadow-(--shadow-card-hover) hover:border-brand-primary/35 transition-all duration-300 flex flex-col overflow-hidden">
                            <div class="relative aspect-[16/10] w-full bg-[#F8FAFC] border-b border-border-hairline overflow-hidden group/img">
                                @if ($project->image_url)
                                    <img
                                        src="{{ $project->image_url }}"
                                        alt="{{ $project->title }}"
                                        data-lightbox-src="{{ $project->image_url }}"
                                        data-lightbox-title="{{ $project->title }}"
                                        data-lightbox-sub="{{ $project->client_name }} • {{ $project->industry }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover object-center cursor-zoom-in group-hover/img:scale-[1.03] transition-transform duration-300"
                                        title="Click to view full image"
                                    />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-brand-primary-soft/50 text-brand-primary/50">
                                        <x-icon name="briefcase" class="w-12 h-12" />
                                    </div>
                                @endif

                                <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full bg-brand-primary/95 text-white text-[11px] font-semibold shadow-xs">
                                    {{ $project->industry }}
                                </span>

                                @if ($project->results_metric)
                                    <span class="absolute bottom-3 right-3 inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-brand-accent text-brand-primary text-[11px] font-bold shadow-xs">
                                        <x-icon name="check-circle-2" class="w-3.5 h-3.5" />
                                        <span>{{ $project->results_metric }}</span>
                                    </span>
                                @endif
                            </div>

                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2.5">
                                    <div class="flex flex-wrap items-center gap-2 text-xs text-ink-muted">
                                        <span class="font-semibold text-brand-primary">{{ $project->client_name }}</span>
                                        @if ($project->location)
                                            <span aria-hidden="true">•</span>
                                            <span>{{ $project->location }}</span>
                                        @endif
                                        @if ($project->deployed_at)
                                            <span aria-hidden="true">•</span>
                                            <span>{{ $project->deployed_at }}</span>
                                        @endif
                                    </div>

                                    <h3 class="text-lg font-semibold text-ink-primary leading-snug">
                                        {{ $project->title }}
                                    </h3>

                                    @if ($project->summary)
                                        <p class="text-xs sm:text-sm text-ink-secondary leading-relaxed">
                                            {{ $project->summary }}
                                        </p>
                                    @endif

                                    @if ($project->challenge_solution)
                                        <div class="rounded-xl bg-surface-subtle/65 border border-border-hairline p-3 text-xs text-ink-secondary leading-relaxed">
                                            <strong class="text-ink-primary font-semibold block mb-0.5">Engineering Outcome:</strong>
                                            {{ $project->challenge_solution }}
                                        </div>
                                    @endif
                                </div>

                                <div class="space-y-3 pt-3 border-t border-border-hairline/70">
                                    @if (is_array($project->hardware_used) && ! empty($project->hardware_used))
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($project->hardware_used as $hw)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-brand-primary-soft/60 text-[11px] font-medium text-brand-primary">
                                                    {{ $hw }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <a
                                        href="{{ route('contact.index', ['subject' => 'Similar Project Inquiry: ' . $project->title]) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-primary hover:text-brand-primary-hover transition-colors"
                                    >
                                        <span>Discuss Similar Deployment</span>
                                        <x-icon name="arrow-up-right" class="w-3.5 h-3.5 text-brand-accent" />
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($portfolios->hasPages())
                    <div class="pt-4">
                        {{ $portfolios->links() }}
                    </div>
                @endif
            @else
                <div class="bg-surface-canvas rounded-2xl border border-border-hairline p-10 text-center shadow-(--shadow-card)">
                    <h3 class="text-lg font-semibold text-ink-primary">No case studies found for this industry</h3>
                    <p class="mt-1 text-sm text-ink-secondary">Reset the filter or contact us for sector-specific deployment references.</p>
                    <div class="mt-5">
                        <x-ui.button :href="route('portfolio.index')" variant="outline" size="md">
                            View All Deployments
                        </x-ui.button>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>