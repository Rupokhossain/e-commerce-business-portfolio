@props([
    'products' => collect(),
])

@php
    $enabled = ($siteSettings['home_products_enabled'] ?? '1') === '1';
    $eyebrow = $siteSettings['home_products_eyebrow'] ?? 'Featured Hardware';
    $title = $siteSettings['home_products_title'] ?? 'Enterprise Systems & Auto-ID Equipment';
    $subtitle = $siteSettings['home_products_subtitle'] ?? 'Genuine printers, scanners, RFID readers, biometric terminals, and retail POS hardware ready for corporate deployment.';
    $ctaText = $siteSettings['home_products_cta_text'] ?? 'View More Products';
@endphp

@if ($enabled && $products->isNotEmpty())
    <section data-home-products class="py-12 sm:py-16 lg:py-20 bg-white border-b border-border-hairline/70">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5">
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
                    <div class="hidden lg:block shrink-0">
                        <x-ui.button :href="route('products.index')" variant="outline" size="md">
                            <span>{{ $ctaText }}</span>
                            <x-icon name="arrow-right" class="w-4 h-4 text-brand-primary" />
                        </x-ui.button>
                    </div>
                @endif
            </div>

            {{-- Featured Product Cards Grid --}}
            <div class="mt-8 sm:mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">
                @foreach ($products as $product)
                    <x-product.card :product="$product" />
                @endforeach
            </div>

            {{-- View More CTA --}}
            @if ($ctaText)
                <div class="mt-10 text-center">
                    <x-ui.button :href="route('products.index')" variant="primary" size="lg">
                        <span>{{ $ctaText }}</span>
                        <x-icon name="arrow-right" class="w-4 h-4 text-brand-accent" />
                    </x-ui.button>
                </div>
            @endif
        </div>
    </section>
@endif
