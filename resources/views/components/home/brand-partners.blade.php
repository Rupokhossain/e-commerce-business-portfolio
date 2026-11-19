@props([
    'brands' => collect(),
])

@php
    $enabled = ($siteSettings['home_brands_enabled'] ?? '1') === '1';
    $eyebrow = $siteSettings['home_brands_eyebrow'] ?? 'Authorized OEM Partners';
    $title = $siteSettings['home_brands_title'] ?? 'Global Hardware Brands We Distribute & Support';

    // Ensure seamless full-width coverage even on ultra-wide (2K/4K/5K) screens
    $marqueeHalf = $brands;
    while ($marqueeHalf->isNotEmpty() && $marqueeHalf->count() < 10) {
        $marqueeHalf = $marqueeHalf->concat($brands);
    }
@endphp

@if ($enabled && $brands->isNotEmpty())
    <section
        data-home-brands
        aria-label="{{ $title }}"
        class="py-10 sm:py-12 bg-white border-b border-border-hairline/70 overflow-hidden"
    >
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
                @if ($eyebrow)
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                        <span>{{ $eyebrow }}</span>
                    </span>
                @endif

                <h2 class="mt-2.5 text-xl sm:text-2xl font-bold tracking-tight text-ink-primary">
                    {{ $title }}
                </h2>
            </div>

            <a
                href="{{ route('products.index') }}"
                class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-brand-primary hover:text-brand-primary-hover transition-colors shrink-0"
            >
                <span>Explore All Brands</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        </div>

        {{-- Full-Width Slowly Sliding Brand Partner Logos --}}
        <div class="brand-marquee-wrapper relative w-full overflow-hidden py-2">
            <div class="pointer-events-none absolute inset-y-0 left-0 w-10 sm:w-20 bg-gradient-to-r from-white to-transparent z-10" aria-hidden="true"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-10 sm:w-20 bg-gradient-to-l from-white to-transparent z-10" aria-hidden="true"></div>

            <div class="brand-marquee-track">
                @foreach (['first', 'second'] as $copy)
                    <div
                        class="flex items-center gap-4 sm:gap-5 pr-4 sm:pr-5 shrink-0"
                        @if ($copy === 'second') aria-hidden="true" @endif
                    >
                        @foreach ($marqueeHalf as $brand)
                            <a
                                href="{{ route('products.index', ['brand' => $brand->name]) }}"
                                @if ($copy === 'second') tabindex="-1" @endif
                                aria-label="{{ $brand->name }}"
                                class="group shrink-0 w-[200px] sm:w-[240px] lg:w-[260px] h-[78px] sm:h-[88px] rounded-xl border border-border-hairline bg-white px-5 py-3 shadow-[0_1px_3px_rgba(15,23,42,0.03)] hover:border-brand-primary/35 hover:shadow-(--shadow-card) transition-all duration-200 flex items-center justify-center"
                            >
                                @if ($brand->logo_url)
                                    <img
                                        src="{{ $brand->logo_url }}"
                                        alt="{{ $brand->name }}"
                                        loading="lazy"
                                        class="h-10 sm:h-12 lg:h-14 max-h-[58px] sm:max-h-[66px] w-auto max-w-[85%] object-contain object-center transition-transform duration-300 group-hover:scale-105"
                                    />
                                @else
                                    <span class="text-base sm:text-lg font-extrabold tracking-tight text-brand-primary">
                                        {{ $brand->name }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif