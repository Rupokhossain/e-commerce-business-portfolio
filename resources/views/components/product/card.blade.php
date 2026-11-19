@props([
    'product',
])

@php
    $whatsappHref = $product->whatsappInquiryUrl($siteSettings['whatsapp_number'] ?? null);
@endphp

<article class="reveal-on-scroll group bg-white rounded-xl border border-border-hairline shadow-(--shadow-card) hover:shadow-lg hover:border-brand-primary/40 transition-[box-shadow,border-color] duration-300 ease-out flex flex-col overflow-hidden">
    {{-- Product Image Stage --}}
    <a
        href="{{ route('products.show', $product->slug) }}"
        class="relative aspect-[4/3] w-full bg-[#F8FAFC] border-b border-border-hairline/70 p-1 overflow-hidden flex items-center justify-center"
    >
        @if ($product->image_url)
            <img
                src="{{ $product->image_url }}"
                alt="{{ $product->name }}"
                loading="lazy"
                class="w-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-300 ease-out"
            />
        @else
            <div class="w-full h-full flex items-center justify-center bg-brand-primary-soft/50 text-brand-primary/60">
                <x-icon name="package" class="w-12 h-12" />
            </div>
        @endif

        @if ($product->brand)
            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-0.5 rounded-full bg-white/95 backdrop-blur-xs border border-border-hairline text-[11px] font-semibold text-brand-primary shadow-xs">
                {{ $product->brand }}
            </span>
        @endif

        <span class="absolute top-3 right-3 inline-flex items-center px-2.5 py-0.5 rounded-full border text-[11px] font-semibold tracking-wide shadow-xs {{ $product->availability_classes }}">
            {{ $product->availability_label }}
        </span>
    </a>

    {{-- Card Content --}}
    <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between gap-2 text-[11px] font-medium text-ink-muted">
                <span class="truncate uppercase tracking-wider text-brand-primary/75 font-semibold">
                    {{ $product->category?->name ?? 'Hardware' }}
                </span>
                @if ($product->model_number)
                    <span class="shrink-0 font-medium text-ink-muted">
                        {{ $product->model_number }}
                    </span>
                @endif
            </div>

            <h3 class="mt-1.5 text-sm sm:text-base font-semibold text-ink-primary group-hover:text-brand-primary transition-colors leading-snug line-clamp-2">
                <a href="{{ route('products.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>

            @if ($product->short_description)
                <p class="mt-1.5 text-xs sm:text-[13px] text-ink-secondary leading-relaxed line-clamp-2">
                    {{ $product->short_description }}
                </p>
            @endif
        </div>

        {{-- B2B Actions: View Details + Direct WhatsApp Inquiry (Zero Cart / Zero Order) --}}
        <div class="mt-4 pt-3.5 border-t border-border-hairline/70 flex items-center gap-2">
            <a
                href="{{ route('products.show', $product->slug) }}"
                class="flex-1 inline-flex items-center justify-center gap-1.5 h-9 px-3 rounded-lg bg-brand-primary text-white hover:bg-brand-primary-hover text-xs font-semibold transition-colors"
            >
                <span>View Details</span>
                <x-icon name="arrow-right" class="w-3.5 h-3.5 text-brand-accent" />
            </a>

            @if ($whatsappHref)
                <a
                    href="{{ $whatsappHref }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Inquire about {{ $product->name }} on WhatsApp"
                    title="Inquire on WhatsApp"
                    class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-colors"
                >
                    <x-icon name="message-circle" class="w-4 h-4" />
                </a>
            @endif
        </div>
    </div>
</article>
