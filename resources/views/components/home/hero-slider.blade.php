@props([
    'slides' => collect(),
])

@if ($slides->isNotEmpty())
    <section
        data-hero-slider
        data-autoplay-ms="5000"
        tabindex="0"
        aria-roledescription="carousel"
        aria-label="Featured solutions showcase"
        class="relative w-full overflow-hidden group focus:outline-none touch-pan-y select-none"
    >
        {{-- Horizontal Slide Track --}}
        <div
            data-hero-track
            class="flex w-full transition-transform duration-700 ease-[cubic-bezier(0.22,1,0.36,1)] will-change-transform"
        >
            @foreach ($slides as $index => $slide)
                <div
                    data-hero-slide
                    role="group"
                    aria-roledescription="slide"
                    aria-label="Slide {{ $index + 1 }} of {{ $slides->count() }}: {{ $slide->title }}"
                    class="w-full aspect-[16/10] sm:aspect-[21/9] lg:aspect-[12/5] min-h-[220px] sm:min-h-0 shrink-0 relative overflow-hidden"
                >
                    <img
                        src="{{ $slide->image_url }}"
                        alt="{{ $slide->title }}"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                        draggable="false"
                        class="w-full h-full object-cover object-center block select-none"
                    />

                    {{-- Optional Text Overlay (Only when toggled on from Admin for plain photo banners) --}}
                    @if ($slide->show_overlay)
                        <div class="absolute inset-0 bg-gradient-to-r from-[#100063]/90 via-[#100063]/70 to-[#100063]/20 flex items-center">
                            <div class="max-w-7xl w-full mx-auto px-4 sm:px-8 lg:px-10 py-3 sm:py-8">
                                <div class="max-w-2xl space-y-1.5 sm:space-y-3 lg:space-y-4">
                                    @if ($slide->eyebrow)
                                        <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-brand-accent text-xs font-semibold uppercase tracking-[0.08em]">
                                            {{ $slide->eyebrow }}
                                        </span>
                                    @endif

                                    <h1 class="text-base sm:text-3xl lg:text-5xl font-bold tracking-tight text-white leading-[1.15]">
                                        {{ $slide->title }}
                                    </h1>

                                    @if ($slide->subtitle)
                                        <p class="hidden sm:block text-sm lg:text-base text-white/85 leading-relaxed max-w-xl line-clamp-2">
                                            {{ $slide->subtitle }}
                                        </p>
                                    @endif

                                    @if ($slide->cta_text && $slide->link_url)
                                        <div class="pt-0.5 sm:pt-2 flex items-center gap-3">
                                            <x-ui.button :href="$slide->link_url" variant="accent" size="sm" class="sm:h-10 sm:px-4 sm:text-sm">
                                                <span>{{ $slide->cta_text }}</span>
                                                <x-icon name="arrow-right" class="w-3.5 h-3.5 sm:w-4 sm:h-4" />
                                            </x-ui.button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if ($slides->count() > 1)
            {{-- Previous / Next Controls --}}
            <button
                type="button"
                data-hero-prev
                aria-label="Previous slide"
                class="hidden sm:inline-flex items-center justify-center absolute left-2 sm:left-3 lg:left-4 top-1/2 -translate-y-1/2 h-8 w-8 md:h-9 md:w-9 lg:h-10 lg:w-10 rounded-full bg-brand-primary/70 text-white border border-white/25 backdrop-blur-sm opacity-0 group-hover:opacity-100 focus-visible:opacity-100 hover:bg-brand-primary hover:border-brand-accent hover:text-brand-accent transition-all duration-200 cursor-pointer z-10"
            >
                <x-icon name="chevron-left" class="w-4 h-4 lg:w-5 lg:h-5" />
            </button>

            <button
                type="button"
                data-hero-next
                aria-label="Next slide"
                class="hidden sm:inline-flex items-center justify-center absolute right-2 sm:right-3 lg:right-4 top-1/2 -translate-y-1/2 h-8 w-8 md:h-9 md:w-9 lg:h-10 lg:w-10 rounded-full bg-brand-primary/70 text-white border border-white/25 backdrop-blur-sm opacity-0 group-hover:opacity-100 focus-visible:opacity-100 hover:bg-brand-primary hover:border-brand-accent hover:text-brand-accent transition-all duration-200 cursor-pointer z-10"
            >
                <x-icon name="chevron-right" class="w-4 h-4 lg:w-5 lg:h-5" />
            </button>

            {{-- Bottom Pill Indicators --}}
            <div class="absolute bottom-2 sm:bottom-3 lg:bottom-4 left-1/2 -translate-x-1/2 z-10 flex items-center gap-1.5 sm:gap-2 px-2 py-1 sm:px-3 sm:py-1.5 rounded-full bg-brand-primary/70 backdrop-blur-sm border border-white/20">
                @foreach ($slides as $index => $slide)
                    <button
                        type="button"
                        data-hero-dot="{{ $index }}"
                        aria-label="Go to slide {{ $index + 1 }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        class="h-1 sm:h-1.5 rounded-full transition-all duration-300 cursor-pointer {{ $index === 0 ? 'w-4 sm:w-6 bg-brand-accent' : 'w-1.5 sm:w-2 bg-white/45 hover:bg-white/80' }}"
                    ></button>
                @endforeach
            </div>

            {{-- Subtle Auto-advance Progress Bar --}}
            <div class="absolute inset-x-0 bottom-0 h-[2px] bg-black/10 z-10 pointer-events-none">
                <div data-hero-progress class="h-full w-0 bg-brand-accent transition-none"></div>
            </div>
        @endif
    </section>
@endif
