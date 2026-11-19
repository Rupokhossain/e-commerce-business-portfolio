@php
    $enabled = ($siteSettings['home_industries_enabled'] ?? '1') === '1';
    $eyebrow = $siteSettings['home_industries_eyebrow'] ?? 'Industries We Empower';
    $title = $siteSettings['home_industries_title'] ?? 'Serving Diverse Industries';
    $subtitle = $siteSettings['home_industries_subtitle'] ?? 'Built for demanding environments, trusted across Bangladesh’s core enterprise sectors.';

    $industries = [
        [
            'title' => $siteSettings['industry_1_title'] ?? 'Bank & Corporate',
            'image' => 'images/industries/bank.jpg',
            'icon' => 'building-2',
            'category' => 'access-control-biometrics',
            'placement' => 'lg:col-start-1 lg:row-start-1 min-h-[230px] sm:min-h-[260px] lg:min-h-0',
        ],
        [
            'title' => $siteSettings['industry_2_title'] ?? 'Garments & RMG',
            'image' => 'images/industries/garments.jpg',
            'icon' => 'factory',
            'category' => 'barcode-auto-id',
            'placement' => 'lg:col-start-1 lg:row-start-2 min-h-[230px] sm:min-h-[260px] lg:min-h-0',
        ],
        [
            'title' => $siteSettings['industry_3_title'] ?? 'Retail & POS',
            'image' => 'images/industries/retail.jpg',
            'icon' => 'store',
            'category' => 'retail-pos-hardware',
            'placement' => 'sm:col-span-2 lg:col-span-1 lg:col-start-2 lg:row-start-1 lg:row-span-2 min-h-[280px] sm:min-h-[340px] lg:min-h-0',
        ],
        [
            'title' => $siteSettings['industry_4_title'] ?? 'Warehouse & Logistics',
            'image' => 'images/industries/warehouse.jpg',
            'icon' => 'package',
            'category' => 'rfid-systems',
            'placement' => 'lg:col-start-3 lg:row-start-1 min-h-[230px] sm:min-h-[260px] lg:min-h-0',
        ],
        [
            'title' => $siteSettings['industry_5_title'] ?? 'Hospital & Healthcare',
            'image' => 'images/industries/hospital.jpg',
            'icon' => 'shield-check',
            'category' => 'access-control-biometrics',
            'placement' => 'lg:col-start-3 lg:row-start-2 min-h-[230px] sm:min-h-[260px] lg:min-h-0',
        ],
    ];
@endphp

@if ($enabled)
    <section data-home-industries class="py-12 sm:py-16 lg:py-20 bg-surface-canvas border-b border-border-hairline/70">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Centered Architectural Heading --}}
            <div class="max-w-2xl mx-auto text-center">
                @if ($eyebrow)
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                        <span>{{ $eyebrow }}</span>
                    </span>
                @endif

                <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-ink-primary leading-tight">
                    {{ $title }}
                </h2>

                @if ($subtitle)
                    <p class="mt-2.5 text-sm sm:text-base text-ink-secondary">
                        {{ $subtitle }}
                    </p>
                @endif

                <div class="mt-4 flex items-center justify-center gap-3" aria-hidden="true">
                    <span class="h-px w-14 bg-border-hairline"></span>
                    <span class="h-1.5 w-8 rounded-full bg-brand-accent"></span>
                    <span class="h-px w-14 bg-border-hairline"></span>
                </div>
            </div>

            {{-- Organized 5-Tile Bento Grid (Image + Title + Action Arrow Only, Zero Paragraphs) --}}
            <div data-industries-grid class="mt-8 sm:mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 lg:grid-rows-2 gap-4 sm:gap-5 lg:h-[580px]">
                @foreach ($industries as $item)
                    <a
                        href="{{ route('products.index', ['category' => $item['category']]) }}"
                        class="reveal-on-scroll group relative overflow-hidden rounded-2xl border border-border-hairline bg-brand-primary shadow-(--shadow-card) hover:shadow-(--shadow-card-hover) hover:border-brand-primary/40 transition-all duration-300 {{ $item['placement'] }}"
                    >
                        <img
                            src="{{ asset($item['image']) }}"
                            alt="{{ $item['title'] }}"
                            loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-105"
                        />

                        {{-- Deep Gradient Scrim for Razor-Sharp Contrast --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#09003B]/90 via-[#100063]/25 to-black/5 transition-opacity duration-300 group-hover:from-[#100063]/95" aria-hidden="true"></div>

                        {{-- Top Corner Minimal Icon Pill --}}
                        <span class="absolute top-4 left-4 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/15 backdrop-blur-md border border-white/25 text-white shadow-xs">
                            <x-icon :name="$item['icon']" class="w-4 h-4" />
                        </span>

                        {{-- Bottom Title & Action Circle --}}
                        <div class="relative z-10 h-full p-5 sm:p-6 flex items-end justify-between gap-4">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-white leading-snug">
                                    {{ $item['title'] }}
                                </h3>
                                <span class="mt-1.5 block h-0.5 w-8 rounded-full bg-brand-accent transition-all duration-300 group-hover:w-14" aria-hidden="true"></span>
                            </div>

                            <span class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-full bg-white text-brand-primary shadow-md transition-all duration-300 group-hover:bg-brand-accent group-hover:scale-110">
                                <x-icon name="arrow-up-right" class="w-4 h-4 sm:w-5 sm:h-5" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif