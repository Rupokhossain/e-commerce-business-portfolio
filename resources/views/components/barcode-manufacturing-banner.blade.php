@props([
    'context' => 'category', // 'category' or 'details'
])

@php
    $whatsappNumber = '8801844040004';
    $whatsappText = urlencode('Hello Proud Rock, I am looking for custom die-cut barcode labels and thermal ribbons for our printers.');
    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . $whatsappText;
@endphp

<div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-8 shadow-(--shadow-card) relative overflow-hidden mb-6">
    {{-- Decorative Background Elements --}}
    <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full bg-brand-primary-soft/60 pointer-events-none blur-2xl"></div>
    <div class="absolute -left-10 -bottom-10 w-40 h-40 rounded-full bg-brand-accent/10 pointer-events-none blur-2xl"></div>

    <div class="relative z-10 space-y-5">
        {{-- Header Strip with Converting Badges --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-border-hairline">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary text-white text-xs font-semibold uppercase tracking-wider">
                <x-icon name="factory" class="w-3.5 h-3.5 text-brand-accent" />
                <span>In-House Converting &amp; Label Manufacturing Plant</span>
            </div>

            <div class="flex flex-wrap items-center gap-1.5 text-xs text-ink-muted">
                <span class="font-medium text-ink-secondary">Supported Printer Lines:</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">Zebra</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">TSC</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">Printronix</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">Honeywell</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">Citizen</span>
            </div>
        </div>

        {{-- Main Client Content Body --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            <div class="lg:col-span-8 space-y-3">
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-ink-primary">
                    Custom Die-Cut Barcode Labels &amp; Thermal Ribbons in Bangladesh
                </h2>
                <p class="text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    At Proud Rock Limited, we produce all types of barcode labels according to your precise dimensions, material needs, and printer specifications. Whether you operate desktop printers with <strong class="text-ink-primary font-semibold">1-inch cores</strong> or heavy-duty industrial units with <strong class="text-ink-primary font-semibold">3-inch cores</strong>, we deliver precision die-cut rolls in <strong class="text-ink-primary font-semibold">Thermal Transfer (TT) Semi-Glossy, Matt Paper, Tear-Proof PVC, and Direct Thermal (DT)</strong>, matched with premium <strong class="text-ink-primary font-semibold">Wax, Wax-Resin, Full Resin, and Wash-Care Ribbons</strong>.
                </p>
            </div>

            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-2.5">
                <button
                    type="button"
                    data-quote-trigger
                    data-product-name="Custom Barcode Label & Ribbon Order"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary-hover text-white text-xs sm:text-sm font-semibold shadow-sm transition-all text-center"
                >
                    <span>Request Custom Size Quote</span>
                    <x-icon name="arrow-right" class="w-4 h-4 text-brand-accent" />
                </button>

                <a
                    href="{{ $whatsappUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs sm:text-sm font-semibold border border-emerald-200 transition-all text-center"
                >
                    <svg class="w-4 h-4 fill-emerald-600" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Instant WhatsApp Sizing Inquiry</span>
                </a>
            </div>
        </div>

        {{-- 4 Core Converting Pillars --}}
        <div class="pt-2 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 shrink-0">
                    <x-icon name="layers" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">Any Die-Cut Size &amp; Material (TT / DT / PVC)</span>
            </div>

            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 shrink-0">
                    <x-icon name="package" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">1" &amp; 3" Core for Desktop &amp; Industrial</span>
            </div>

            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600 shrink-0">
                    <x-icon name="shield-check" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">Wax, Resin &amp; Wash-Care Ribbons</span>
            </div>

            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-50 text-purple-600 shrink-0">
                    <x-icon name="check" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">Textile Dyeing-Proof &amp; Heat-Proof</span>
            </div>
        </div>
    </div>
</div>
