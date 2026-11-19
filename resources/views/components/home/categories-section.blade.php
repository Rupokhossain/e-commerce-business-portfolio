@props([
    'categories' => collect(),
])

@php
    $enabled = ($siteSettings['home_categories_enabled'] ?? '1') === '1';
    $layout = $siteSettings['home_categories_layout'] ?? 'marquee';
    $title = $siteSettings['home_categories_title'] ?? 'Solution Categories';
    $ctaText = $siteSettings['home_categories_cta_text'] ?? 'Browse all products';

    // Ensure seamless full-width coverage even on ultra-wide (2K/4K/5K) displays
    $marqueeHalf = $categories->count() < 8 ? $categories->concat($categories) : $categories;
@endphp

@if ($enabled && $categories->isNotEmpty())
    <section
        data-home-categories
        aria-label="{{ $title }}"
        class="py-8 sm:py-10 bg-surface-canvas border-b border-border-hairline/70 overflow-hidden"
    >
        {{-- Clean Header Row --}}
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 mb-5 sm:mb-6 flex items-center justify-between gap-4">
            <h2 class="text-lg sm:text-xl font-semibold tracking-tight text-ink-primary">
                {{ $title }}
            </h2>

            @if ($ctaText)
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-brand-primary hover:text-brand-primary-hover transition-colors shrink-0"
                >
                    <span>{{ $ctaText }}</span>
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            @endif
        </div>

        @if ($layout === 'visual_cards')
            {{-- Optional Static Grid Layout (Selectable from Admin) --}}
            <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5 sm:gap-4">
                @foreach ($categories as $category)
                    <a
                        href="{{ route('products.index', ['category' => $category->slug]) }}"
                        class="group bg-white rounded-xl border border-border-hairline p-2.5 sm:p-3 shadow-(--shadow-card) hover:border-brand-primary/35 hover:shadow-(--shadow-card-hover) hover:-translate-y-0.5 transition-all duration-200 flex flex-col"
                    >
                        <div class="aspect-[3/2] w-full rounded-lg overflow-hidden bg-surface-subtle">
                            @if ($category->image_url)
                                <img
                                    src="{{ $category->image_url }}"
                                    alt="{{ $category->name }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover object-center group-hover:scale-[1.04] transition-transform duration-300"
                                />
                            @else
                                <div class="w-full h-full bg-brand-primary-soft/60 flex items-center justify-center text-brand-primary">
                                    <x-icon :name="$category->icon ?: 'layers'" class="w-8 h-8" />
                                </div>
                            @endif
                        </div>

                        <div class="mt-2.5 px-1 pb-1 text-center text-xs sm:text-[13px] font-medium text-ink-primary group-hover:text-brand-primary transition-colors leading-snug line-clamp-2">
                            {{ $category->name }}
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            {{-- Full-Width Smooth Slow Category Marquee (Image on Top + Centered Title Below) --}}
            <div data-category-marquee class="category-marquee-wrapper relative w-full overflow-hidden py-1">
                <div class="hidden sm:block pointer-events-none absolute inset-y-0 left-0 w-12 lg:w-20 bg-gradient-to-r from-surface-canvas via-surface-canvas/70 to-transparent z-10" aria-hidden="true"></div>
                <div class="hidden sm:block pointer-events-none absolute inset-y-0 right-0 w-12 lg:w-20 bg-gradient-to-l from-surface-canvas via-surface-canvas/70 to-transparent z-10" aria-hidden="true"></div>

                <div class="category-marquee-track">
                    @foreach ([false, true] as $isClone)
                        <div class="flex items-stretch gap-3.5 sm:gap-4 pr-3.5 sm:pr-4 shrink-0" @if ($isClone) aria-hidden="true" @endif>
                            @foreach ($marqueeHalf as $category)
                                <a
                                    href="{{ route('products.index', ['category' => $category->slug]) }}"
                                    @if ($isClone) tabindex="-1" @endif
                                    class="group w-[195px] sm:w-[225px] lg:w-[248px] shrink-0 bg-white rounded-xl border border-border-hairline p-2.5 sm:p-3 shadow-(--shadow-card) hover:border-brand-primary/35 hover:shadow-(--shadow-card-hover) hover:-translate-y-0.5 transition-all duration-200 flex flex-col"
                                >
                                    <div class="aspect-[3/2] w-full rounded-lg overflow-hidden bg-surface-subtle">
                                        @if ($category->image_url)
                                            <img
                                                src="{{ $category->image_url }}"
                                                alt="{{ $isClone ? '' : $category->name }}"
                                                loading="lazy"
                                                draggable="false"
                                                class="w-full h-full object-cover object-center group-hover:scale-[1.04] transition-transform duration-300"
                                            />
                                        @else
                                            <div class="w-full h-full bg-brand-primary-soft/60 flex items-center justify-center text-brand-primary">
                                                <x-icon :name="$category->icon ?: 'layers'" class="w-8 h-8" />
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-2.5 sm:mt-3 px-1 pb-0.5 text-center text-xs sm:text-[13px] font-medium text-ink-primary group-hover:text-brand-primary transition-colors leading-snug line-clamp-2">
                                        {{ $category->name }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endif
