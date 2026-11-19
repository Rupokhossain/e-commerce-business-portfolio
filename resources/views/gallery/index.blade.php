@php
    $galleryBadge = $siteSettings['gallery_badge'] ?? 'Verified On-Site Implementations';
    $galleryTitle = $siteSettings['gallery_title'] ?? 'Field Deployments & Solutions Gallery';
    $gallerySubtitle = $siteSettings['gallery_subtitle'] ?? 'Visual documentation and operational case studies of industrial barcode printing, dock-door RAIN RFID portals, biometric speed gates, and smart POS retail rollouts engineered across Bangladesh.';
@endphp

<x-layouts.app
    title="Field Deployments &amp; Project Gallery"
    description="Explore real-world barcode, RAIN RFID, biometric access, and POS hardware deployments across factories, warehouses, and retail chains in Bangladesh."
>
    {{-- Header Banner --}}
    <section class="bg-white border-b border-border-hairline py-8 sm:py-10">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <nav class="flex items-center gap-2 text-xs text-ink-muted" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-ink-primary font-semibold">Field Deployments Gallery</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                        <span>{{ $galleryBadge }}</span>
                    </span>
                    <h1 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-ink-primary">
                        {{ $galleryTitle }}
                    </h1>
                    <p class="mt-2 max-w-3xl text-xs sm:text-sm text-ink-secondary leading-relaxed">
                        {{ $gallerySubtitle }}
                    </p>
                </div>

                <div class="shrink-0 flex items-center gap-2 text-xs font-bold px-3.5 py-2 rounded-xl bg-surface-canvas border border-border-hairline text-brand-primary shadow-2xs">
                    <x-icon name="check-circle-2" class="w-4 h-4 text-emerald-600" />
                    <span>{{ $items->total() }} Verified Deployments</span>
                </div>
            </div>

            {{-- Filter Tabs by Project Type / Industry --}}
            @if ($types->isNotEmpty())
                <div class="pt-2 flex items-center gap-2 overflow-x-auto pb-1">
                    <a
                        href="{{ route('gallery.index') }}"
                        class="shrink-0 px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold border transition-all {{ $activeType === '' ? 'bg-brand-primary text-white border-brand-primary shadow-xs' : 'bg-surface-canvas text-ink-secondary border-border-hairline hover:border-brand-primary/40 hover:text-brand-primary' }}"
                    >
                        All Implementations
                    </a>

                    @foreach ($types as $type)
                        <a
                            href="{{ route('gallery.index', ['type' => $type]) }}"
                            class="shrink-0 px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold border transition-all {{ $activeType === $type ? 'bg-brand-primary text-white border-brand-primary shadow-xs' : 'bg-surface-canvas text-ink-secondary border-border-hairline hover:border-brand-primary/40 hover:text-brand-primary' }}"
                        >
                            {{ $type }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Main Gallery Content (Alternating Left-Image / Right-Image Split Row Showcase) --}}
    <section class="py-8 sm:py-12 bg-surface-canvas">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

            @if ($items->isEmpty())
                <div class="rounded-2xl border border-border-hairline bg-white p-12 text-center space-y-3">
                    <x-icon name="image" class="w-12 h-12 text-ink-muted/40 mx-auto" />
                    <h3 class="text-base font-bold text-ink-primary">No deployments found in this category</h3>
                    <p class="text-xs text-ink-secondary">Select another category or browse all verified deployments.</p>
                    <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-primary hover:underline">
                        <span>View all implementations</span>
                        <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                    </a>
                </div>
            @else
                <div class="space-y-6 sm:space-y-8">
                    @foreach ($items as $index => $project)
                        @php
                            // Alternating pattern:
                            // Even index (0, 2, 4...) -> Left Image (order 1), Right Text (order 2)
                            // Odd index (1, 3, 5...)  -> Right Image (order 2), Left Text (order 1)
                            $isEven = ($index % 2 === 0);
                        @endphp

                        <article data-gallery-card class="reveal-on-scroll bg-white rounded-3xl border border-border-hairline p-5 sm:p-6 lg:p-7 shadow-(--shadow-card) hover:shadow-(--shadow-card-hover) hover:border-brand-primary/35 transition-all duration-300">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
                                
                                {{-- IMAGE COLUMN (Alternates: Left on even, Right on odd on desktop) --}}
                                <div class="lg:col-span-5 {{ $isEven ? 'lg:order-1' : 'lg:order-2' }}">
                                    <div class="relative aspect-[16/11] sm:aspect-[16/10] w-full rounded-2xl overflow-hidden bg-surface-subtle border border-border-hairline shadow-2xs group cursor-zoom-in">
                                        @if ($project->image_url)
                                            <img
                                                src="{{ $project->image_url }}"
                                                alt="{{ $project->title }}"
                                                data-lightbox-src="{{ $project->image_url }}"
                                                data-lightbox-title="{{ $project->title }}"
                                                data-lightbox-sub="{{ $project->client_name }} • {{ $project->location }}"
                                                loading="lazy"
                                                class="w-full h-full object-cover object-center group-hover:scale-[1.03] transition-transform duration-500 ease-out"
                                                title="Click to view full image popup"
                                            />

                                            {{-- Enlarge Hover Button --}}
                                            <button
                                                type="button"
                                                data-lightbox-src="{{ $project->image_url }}"
                                                data-lightbox-title="{{ $project->title }}"
                                                data-lightbox-sub="{{ $project->client_name }} • {{ $project->location }}"
                                                class="absolute bottom-3 right-3 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-black/75 hover:bg-black text-white text-xs font-semibold shadow-md backdrop-blur-xs transition-opacity opacity-90 sm:opacity-0 group-hover:opacity-100 cursor-pointer"
                                                title="Click to enlarge image"
                                            >
                                                <x-icon name="maximize" class="w-3.5 h-3.5" />
                                                <span>Enlarge Photo</span>
                                            </button>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-brand-primary-soft/50 text-brand-primary/40">
                                                <x-icon name="image" class="w-12 h-12" />
                                            </div>
                                        @endif

                                        {{-- Top-Left Industry Sector Tag --}}
                                        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-brand-primary/95 text-white text-[11px] font-bold shadow-xs">
                                                {{ $project->industry }}
                                            </span>
                                        </div>

                                        {{-- Top-Right Location Tag --}}
                                        @if ($project->location)
                                            <div class="absolute top-3 right-3">
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-white/95 text-ink-primary border border-border-hairline text-[11px] font-semibold shadow-xs">
                                                    <x-icon name="map-pin" class="w-3 h-3 text-brand-primary" />
                                                    <span>{{ $project->location }}</span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- TEXT & DETAILS COLUMN (Alternates: Right on even, Left on odd on desktop) --}}
                                <div class="lg:col-span-7 space-y-4 {{ $isEven ? 'lg:order-2' : 'lg:order-1' }}">
                                    
                                    {{-- Meta Header Line: Implementation Type & Client Details --}}
                                    <div class="flex flex-wrap items-center justify-between gap-2 text-xs border-b border-border-hairline/80 pb-2.5">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-brand-primary-soft text-brand-primary font-bold">
                                                <x-icon name="building-2" class="w-3.5 h-3.5 shrink-0" />
                                                <span>{{ $project->client_name }}</span>
                                            </span>
                                            <span class="text-ink-muted hidden sm:inline">•</span>
                                            <span class="text-[11px] font-semibold text-ink-secondary hidden sm:inline">
                                                Implementation Type: <strong class="text-brand-primary">{{ $project->industry }}</strong>
                                            </span>
                                        </div>

                                        @if ($project->deployed_at)
                                            <span class="text-[11px] text-ink-muted flex items-center gap-1">
                                                <x-icon name="calendar" class="w-3 h-3" />
                                                <span>{{ $project->deployed_at }}</span>
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Project Title --}}
                                    <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold text-ink-primary tracking-tight leading-snug">
                                        {{ $project->title }}
                                    </h2>

                                    {{-- Project Overview / Description --}}
                                    @if ($project->summary ?? $project->description)
                                        <div class="space-y-1">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-ink-muted">Project Overview:</span>
                                            <p class="text-xs sm:text-[13px] text-ink-secondary leading-relaxed">
                                                {{ $project->summary ?? $project->description }}
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Product Function & Capabilities (Highlighted Highlight Box) --}}
                                    @if ($project->challenge_solution ?? $project->solution)
                                        <div class="rounded-2xl bg-surface-subtle/80 border border-border-hairline p-3.5 sm:p-4 text-xs space-y-1 shadow-2xs">
                                            <div class="text-brand-primary font-bold inline-flex items-center gap-1.5 text-xs">
                                                <x-icon name="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0" />
                                                <span>Product Function &amp; Operational Capabilities:</span>
                                            </div>
                                            <p class="text-ink-secondary leading-relaxed pt-0.5">
                                                {{ $project->challenge_solution ?? $project->solution }}
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Hardware & Equipment Deployed --}}
                                    @if (! empty($project->hardware_used))
                                        <div class="space-y-1.5 pt-1">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-ink-muted">Hardware &amp; Equipment:</span>
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach ($project->hardware_used as $tech)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-surface-canvas border border-border-hairline text-xs font-semibold text-ink-primary shadow-2xs">
                                                        <x-icon name="cpu" class="w-3 h-3 text-brand-primary" />
                                                        <span>{{ $tech }}</span>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Outcome Metric & Action Bar --}}
                                    <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-border-hairline/80">
                                        @if ($project->results_metric)
                                            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-xl">
                                                <x-icon name="check-circle-2" class="w-3.5 h-3.5 text-emerald-600 shrink-0" />
                                                <span><strong class="font-semibold text-ink-muted uppercase tracking-wider text-[10px] mr-1">Measurable Outcome:</strong> {{ $project->results_metric }}</span>
                                            </div>
                                        @endif

                                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 w-full sm:w-auto">
                                            <x-ui.button
                                                :href="route('contact.index', ['subject' => 'Quote Inquiry: ' . $project->title])"
                                                variant="primary"
                                                size="sm"
                                                class="shadow-2xs text-xs justify-center w-full sm:w-auto"
                                            >
                                                <span>Request Similar Integration Quote</span>
                                                <x-icon name="arrow-up-right" class="w-3.5 h-3.5 text-brand-accent" />
                                            </x-ui.button>

                                            <a
                                                href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['contact_mobile'] ?? '+8801730066010') }}"
                                                class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-border-hairline bg-surface-canvas hover:bg-white text-xs font-bold text-ink-primary hover:text-brand-primary transition-colors shadow-2xs w-full sm:w-auto"
                                                title="Technical Consultation Helpline"
                                            >
                                                <x-icon name="phone" class="w-3.5 h-3.5 text-brand-primary" />
                                                <span>Technical Consultation</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($items->hasPages())
                    <div class="pt-6">
                        {{ $items->links() }}
                    </div>
                @endif
            @endif

        </div>
    </section>
</x-layouts.app>
