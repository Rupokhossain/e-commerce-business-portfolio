@props([
    'portfolios' => collect(),
])

@php
    $enabled = ($siteSettings['home_portfolio_enabled'] ?? '1') === '1';
    $eyebrow = $siteSettings['home_portfolio_eyebrow'] ?? 'Proven Track Record';
    $title = $siteSettings['home_portfolio_title'] ?? 'Recent Enterprise Deployments';
    $subtitle = $siteSettings['home_portfolio_subtitle'] ?? 'Real-world barcode, RFID, biometric, and security integrations running across leading factories, warehouses, and corporate offices.';
    $ctaText = $siteSettings['home_portfolio_cta_text'] ?? 'Explore Full Portfolio';
@endphp

@if ($enabled && $portfolios->isNotEmpty())
    <section data-home-portfolio class="py-12 sm:py-16 lg:py-20 bg-surface-canvas border-b border-border-hairline/70">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-5">
                <div class="max-w-2xl">
                    @if ($eyebrow)
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                            <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                            <span>{{ $eyebrow }}</span>
                        </span>
                    @endif

                    <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-ink-primary leading-[1.18]">
                        {{ $title }}
                    </h2>

                    @if ($subtitle)
                        <p class="mt-2.5 text-sm sm:text-base text-ink-secondary leading-relaxed">
                            {{ $subtitle }}
                        </p>
                    @endif
                </div>

                @if ($ctaText)
                    <div class="shrink-0">
                        <x-ui.button :href="route('portfolio.index')" variant="outline" size="md">
                            <span>{{ $ctaText }}</span>
                            <x-icon name="arrow-right" class="w-4 h-4 text-brand-primary" />
                        </x-ui.button>
                    </div>
                @endif
            </div>

            <div class="mt-8 sm:mt-10 grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">
                @foreach ($portfolios as $project)
                    <article class="group bg-white rounded-2xl border border-border-hairline shadow-(--shadow-card) hover:shadow-(--shadow-card-hover) hover:border-brand-primary/35 hover:-translate-y-0.5 transition-all duration-200 flex flex-col overflow-hidden">
                        <a href="{{ route('portfolio.index', ['industry' => $project->industry]) }}" class="relative aspect-[16/10] w-full bg-[#F8FAFC] border-b border-border-hairline overflow-hidden block">
                            @if ($project->image_url)
                                <img
                                    src="{{ $project->image_url }}"
                                    alt="{{ $project->title }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover object-center group-hover:scale-[1.03] transition-transform duration-500 ease-out"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-brand-primary-soft/50 text-brand-primary/60">
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
                        </a>

                        <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 text-xs text-ink-muted">
                                    <span class="font-semibold text-brand-primary">{{ $project->client_name }}</span>
                                    @if ($project->location)
                                        <span aria-hidden="true">•</span>
                                        <span>{{ $project->location }}</span>
                                    @endif
                                </div>

                                <h3 class="mt-1.5 text-base sm:text-lg font-semibold text-ink-primary group-hover:text-brand-primary transition-colors leading-snug">
                                    <a href="{{ route('portfolio.index', ['industry' => $project->industry]) }}">
                                        {{ $project->title }}
                                    </a>
                                </h3>

                                @if ($project->summary)
                                    <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed line-clamp-3">
                                        {{ $project->summary }}
                                    </p>
                                @endif
                            </div>

                            @if (is_array($project->hardware_used) && ! empty($project->hardware_used))
                                <div class="mt-4 pt-3.5 border-t border-border-hairline/70 flex flex-wrap gap-1.5">
                                    @foreach (array_slice($project->hardware_used, 0, 3) as $hw)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-surface-subtle text-[11px] font-medium text-ink-secondary">
                                            {{ $hw }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif