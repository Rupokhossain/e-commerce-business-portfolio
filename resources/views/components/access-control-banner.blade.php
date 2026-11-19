@props([
    'context' => 'category', // 'category' or 'details'
])

<div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-8 shadow-(--shadow-card) relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full bg-brand-primary-soft/60 pointer-events-none blur-2xl"></div>
    <div class="absolute -left-10 -bottom-10 w-40 h-40 rounded-full bg-brand-accent/10 pointer-events-none blur-2xl"></div>

    <div class="relative z-10 space-y-5">
        {{-- Header Strip with Brand Partners --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-border-hairline">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary text-white text-xs font-semibold uppercase tracking-wider">
                <x-icon name="shield-check" class="w-3.5 h-3.5 text-brand-accent" />
                <span>Authorized Security Solutions &amp; System Integration</span>
            </div>

            <div class="flex flex-wrap items-center gap-1.5 text-xs text-ink-muted">
                <span class="font-medium text-ink-secondary">Supported Brands:</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">ZKTeco</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">VIRDI</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">Hikvision</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">Onspot</span>
                <span class="px-2 py-0.5 rounded-md bg-surface-subtle font-bold text-ink-primary">NexaKey</span>
            </div>
        </div>

        {{-- Main Client Content Body --}}
        <div class="max-w-4xl space-y-3">
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-ink-primary">
                Reliable Access Control &amp; Biometric Attendance Systems in Bangladesh
            </h2>
            <p class="text-xs sm:text-sm text-ink-secondary leading-relaxed">
                Proud Rock offers reliable access control systems, attendance machines, and fingerprint machines from trusted brands like <strong class="text-ink-primary font-semibold">ZKTeco, VIRDI, Hikvision, Onspot, and NexaKey</strong>. These brands provide a variety of security solutions, including biometric fingerprint verification, face recognition, RFID card access, and employee attendance management systems for offices, factories, schools, hospitals, and commercial spaces. You can compare specifications and the latest access control price in Bangladesh at Proud Rock Ltd. to choose the right security solution for your requirements.
            </p>
        </div>

        {{-- 4 Core Value Assurances --}}
        <div class="pt-2 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 shrink-0">
                    <x-icon name="fingerprint" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">Biometric Finger &amp; Face ID</span>
            </div>

            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 shrink-0">
                    <x-icon name="radio" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">RFID &amp; No-Touch Exit</span>
            </div>

            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-primary-soft text-brand-primary shrink-0">
                    <x-icon name="building-2" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">Offices, Factories &amp; RMG</span>
            </div>

            <div class="p-3 rounded-xl border border-border-hairline/80 bg-surface-canvas flex items-center gap-2.5">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-50 text-purple-600 shrink-0">
                    <x-icon name="wrench" class="w-4 h-4" />
                </span>
                <span class="font-semibold text-ink-primary leading-tight">Full On-Site Installation</span>
            </div>
        </div>

        {{-- Quick CTA Strip --}}
        <div class="pt-3 border-t border-border-hairline flex flex-wrap items-center justify-between gap-3">
            <div class="text-xs text-ink-muted">
                Need single-door EM lock or multi-gate turnstile installation? Talk directly with our security engineers.
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a
                    href="https://wa.me/8801712806237?text={{ urlencode('Hello Proud Rock, I need consultation regarding Access Control and Attendance Machines.') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 text-white font-semibold text-xs hover:bg-emerald-500 transition-colors shadow-xs"
                >
                    <x-icon name="whatsapp" class="w-3.5 h-3.5 fill-current" />
                    <span>WhatsApp Inquiry</span>
                </a>
                <x-ui.button :href="route('contact.index')" variant="outline" size="sm" class="text-xs">
                    Request Quotation
                </x-ui.button>
            </div>
        </div>
    </div>
</div>
