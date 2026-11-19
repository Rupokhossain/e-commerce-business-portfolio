@php
    $enabled = ($siteSettings['home_cta_enabled'] ?? '1') === '1';
    $eyebrow = $siteSettings['home_cta_eyebrow'] ?? 'Corporate Consultation & Bulk Quotes';
    $title = $siteSettings['home_cta_title'] ?? 'Planning a Factory Rollout, RFID Portal, or Access Control Upgrade?';
    $subtitle = $siteSettings['home_cta_subtitle'] ?? 'Speak directly with our Auto-ID and security engineers for hardware sizing, site survey, unit pricing, and Annual Maintenance Contract (AMC) proposals.';
    $primaryText = $siteSettings['home_cta_primary_text'] ?? 'Request Official Quotation';
    $secondaryText = $siteSettings['home_cta_secondary_text'] ?? 'WhatsApp Engineering Desk';

    $mobile = $siteSettings['contact_mobile'] ?? ($siteSettings['contact_phone'] ?? '+880 1730-066010');
    $telHref = 'tel:' . preg_replace('/[^0-9+]/', '', $mobile);
    $waRaw = preg_replace('/\D+/', '', (string) ($siteSettings['whatsapp_number'] ?? '8801730066010'));
    $waHref = $waRaw !== ''
        ? 'https://wa.me/' . $waRaw . '?text=' . rawurlencode('Hello ProudRock Ltd., we would like to discuss a B2B hardware quote / site consultation.')
        : null;
@endphp

@if ($enabled)
    <section data-home-cta class="py-12 sm:py-16 bg-white">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl bg-brand-primary px-6 py-9 sm:px-10 sm:py-12 lg:px-14 lg:py-14 text-white shadow-(--shadow-elevated)">
                {{-- Subtle Geometric Accent Glow --}}
                <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-brand-accent/20 blur-3xl" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-24 left-1/3 h-56 w-56 rounded-full bg-indigo-400/20 blur-3xl" aria-hidden="true"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <div class="max-w-3xl">
                        @if ($eyebrow)
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-brand-accent text-xs font-semibold uppercase tracking-[0.08em]">
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                                <span>{{ $eyebrow }}</span>
                            </span>
                        @endif

                        <h2 class="mt-4 text-2xl sm:text-3xl lg:text-[34px] font-bold tracking-tight text-white leading-[1.18]">
                            {{ $title }}
                        </h2>

                        @if ($subtitle)
                            <p class="mt-3 text-sm sm:text-base text-white/80 leading-relaxed max-w-2xl">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row lg:flex-col xl:flex-row items-stretch sm:items-center gap-3 shrink-0">
                        <a
                            href="{{ route('contact.index') }}"
                            class="inline-flex items-center justify-center gap-2 h-12 px-6 rounded-xl bg-brand-accent hover:bg-amber-400 text-brand-primary text-sm font-bold shadow-sm transition-all duration-200 hover:-translate-y-0.5"
                        >
                            <span>{{ $primaryText }}</span>
                            <x-icon name="arrow-up-right" class="w-4 h-4" />
                        </a>

                        @if ($waHref)
                            <a
                                href="{{ $waHref }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 h-12 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5"
                            >
                                <x-icon name="message-circle" class="w-4 h-4" />
                                <span>{{ $secondaryText }}</span>
                            </a>
                        @endif

                        <a
                            href="{{ $telHref }}"
                            class="inline-flex items-center justify-center gap-2 h-12 px-5 rounded-xl border border-white/25 bg-white/10 hover:bg-white/15 text-white text-sm font-semibold transition-colors"
                        >
                            <x-icon name="phone" class="w-4 h-4 text-brand-accent" />
                            <span>{{ $mobile }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif