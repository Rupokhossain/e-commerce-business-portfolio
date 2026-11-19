@php
    $whatsappNumber = '8801844040004';
    $whatsappText = urlencode('Hello Proud Rock Limited, I would like to inquire about complete barcode solutions (printers, custom label rolls, and thermal ribbons).');
    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . $whatsappText;
@endphp

<section data-home-manufacturing class="py-14 sm:py-20 bg-gradient-to-b from-white via-surface-canvas to-surface-canvas border-b border-border-hairline relative overflow-hidden">
    {{-- Decorative Background Glows --}}
    <div class="pointer-events-none absolute -top-24 left-1/2 -translate-x-1/2 w-full max-w-7xl h-64 bg-gradient-to-r from-brand-primary-soft/40 via-brand-accent/10 to-brand-primary-soft/40 blur-3xl opacity-70" aria-hidden="true"></div>

    <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-border-hairline/80">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                    <span>Complete End-to-End Barcode Ecosystem</span>
                </span>

                <h2 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-ink-primary leading-tight">
                    Barcode Hardware, Custom Labels &amp; Thermal Ribbons
                </h2>

                <p class="mt-2 text-sm sm:text-base text-ink-secondary leading-relaxed">
                    Complete barcode automation under one roof—heavy-duty printers, custom-manufactured label rolls, and premium thermal ribbons.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a
                    href="{{ $whatsappUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-semibold shadow-sm transition-all hover:scale-[1.02]"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>WhatsApp Instant Inquiry</span>
                </a>
            </div>
        </div>

        {{-- 3 Clear Logical Cards: 1. Printers, 2. Labels, 3. Ribbons --}}
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- Pillar 1: Barcode Printers (Hardware) --}}
            <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-(--shadow-card) hover:shadow-lg transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative overflow-hidden rounded-xl bg-surface-canvas aspect-16/10 mb-5 border border-border-hairline/70">
                        <img
                            src="{{ asset('images/manufacturing/image14.png') }}"
                            alt="Industrial and Desktop Barcode Printers"
                            class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border border-emerald-300 bg-[#ecfdf5]/95 backdrop-blur-xs text-[11px] font-semibold text-emerald-700 shadow-xs">
                                In Stock
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-brand-primary font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-brand-accent"></span>
                        <span>Hardware</span>
                    </div>

                    <h3 class="text-xl font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                        Industrial &amp; Desktop Printers
                    </h3>

                    <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                        Authorized enterprise printers engineered for 24/7 demanding factory environments, automated production lines, shipping docks, and retail checkouts.
                    </p>

                    <div class="mt-4 space-y-2 text-xs">
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Leading Brands:</strong> Zebra, TSC, and Printronix OEM lineup</span>
                        </div>
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>High Performance:</strong> Up to 14 ips speed with 203 &amp; 300 DPI</span>
                        </div>
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Heavy-Duty:</strong> Die-cast aluminum chassis with full warranty &amp; AMC</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-border-hairline flex items-center justify-between">
                    <span class="text-xs text-ink-muted">Warranty: Official OEM</span>
                    <a
                        href="{{ route('products.index', ['category' => 'barcode-auto-id']) }}"
                        class="inline-flex items-center gap-1 text-xs font-semibold text-brand-primary hover:text-brand-primary-hover"
                    >
                        <span>View Printer Models</span>
                        <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                    </a>
                </div>
            </div>

            {{-- Pillar 2: Custom Barcode Labels (In-House Media) --}}
            <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-(--shadow-card) hover:shadow-lg transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative overflow-hidden rounded-xl bg-surface-canvas aspect-16/10 mb-5 border border-border-hairline/70">
                        <img
                            src="{{ asset('images/manufacturing/image15.jpeg') }}"
                            alt="Custom Die-Cut Barcode Label Rolls"
                            class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border border-emerald-300 bg-[#ecfdf5]/95 backdrop-blur-xs text-[11px] font-semibold text-emerald-700 shadow-xs">
                                In Stock
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-brand-primary font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-brand-accent"></span>
                        <span>Label Media</span>
                    </div>

                    <h3 class="text-xl font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                        Custom Barcode Label Rolls
                    </h3>

                    <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                        Manufactured in our own slitting plant. Custom die-cut to any dimension with aggressive permanent or removable adhesives for desktop &amp; industrial units.
                    </p>

                    <div class="mt-4 space-y-2 text-xs">
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Thermal Transfer (TT):</strong> Semi-Glossy, Matt Paper, &amp; Tear-Proof PVC</span>
                        </div>
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Direct Thermal (DT):</strong> Top-coated, eco-grade, &amp; smudge resistant</span>
                        </div>
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Any Dimension:</strong> 50×25mm, 100×150mm (4"×6"), 1" &amp; 3" cores</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-border-hairline flex items-center justify-between">
                    <span class="text-xs text-ink-muted">Turnaround: 24-48 Hours</span>
                    <a
                        href="{{ route('products.show', 'custom-barcode-label-rolls') }}"
                        class="inline-flex items-center gap-1 text-xs font-semibold text-brand-primary hover:text-brand-primary-hover"
                    >
                        <span>View Label Specifications</span>
                        <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                    </a>
                </div>
            </div>

            {{-- Pillar 3: Thermal Transfer Ribbons (Inks & Care) --}}
            <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-(--shadow-card) hover:shadow-lg transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative overflow-hidden rounded-xl bg-surface-canvas aspect-16/10 mb-5 border border-border-hairline/70">
                        <img
                            src="{{ asset('images/manufacturing/image16.jpeg') }}"
                            alt="Thermal Transfer Barcode Ribbons"
                            class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border border-emerald-300 bg-[#ecfdf5]/95 backdrop-blur-xs text-[11px] font-semibold text-emerald-700 shadow-xs">
                                In Stock
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-brand-primary font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-brand-accent"></span>
                        <span>Inks &amp; Ribbons</span>
                    </div>

                    <h3 class="text-xl font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                        Thermal Transfer Ribbons
                    </h3>

                    <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                        Formulated with ultra-smooth back-coating to extend printer head life and deliver crisp, high-density optical barcodes across all thermal printers.
                    </p>

                    <div class="mt-4 space-y-2 text-xs">
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Wax Ribbons:</strong> High-speed economy printing on plain &amp; coated paper</span>
                        </div>
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Wax-Resin Ribbons:</strong> Smudge, scratch, and moisture resistance</span>
                        </div>
                        <div class="flex items-start gap-2 text-ink-primary font-medium">
                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                            <span><strong>Full Resin &amp; Wash-Care:</strong> Textile dyeing-proof &amp; chemical proof</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-border-hairline flex items-center justify-between">
                    <span class="text-xs text-ink-muted">Roll Lengths: 74m - 450m</span>
                    <a
                        href="{{ route('products.show', 'thermal-transfer-barcode-ribbons') }}"
                        class="inline-flex items-center gap-1 text-xs font-semibold text-brand-primary hover:text-brand-primary-hover"
                    >
                        <span>View Ribbon Specifications</span>
                        <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
