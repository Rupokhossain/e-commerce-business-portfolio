@php
    $companyName = $siteSettings['company_name'] ?? 'Proud Rock Limited';
    $estYear = $siteSettings['company_est_year'] ?? '2018';
    $affiliateName = $siteSettings['company_affiliate_name'] ?? 'AUTOROMO';
    $affiliateYear = $siteSettings['company_affiliate_year'] ?? '2017';
    $productsCount = $siteSettings['company_products_count'] ?? '50+';
    $legalStatus = $siteSettings['company_legal_status'] ?? 'Limited liability company registered in Bangladesh';
    $profileHeadline = $siteSettings['company_profile_headline'] ?? 'Customization and Integration Services for Software & Hardware';
    $profileSubheadline = $siteSettings['company_profile_subheadline'] ?? 'Specializing in Office & Factory Automation Systems and Systems Integration Across Bangladesh.';
    $profileStory = $siteSettings['company_profile_story'] ?? 'PROUD ROCK LIMITED was formed in the year 2018. It is a limited liability company registered in Bangladesh. Our affiliate “AUTOROMO” has been active since 2017. The company provides customization and integration services for software and hardware, with a focus on system integration. Our expertise lies in the development of office and factory automation systems, encompassing over 50 products, including supporting software.';
    $teamSummary = $siteSettings['company_team_summary'] ?? 'We are a team of highly dedicated and committed packaging professionals with rich experience in varied industry segments using barcoding technologies.';
    $hotline247 = $siteSettings['contact_support_24_7'] ?? '+880 1673-638094';
    $salesPhone = $siteSettings['contact_hotline_business'] ?? '+880 1712-806237';
    $corporateEmail = $siteSettings['contact_email'] ?? 'info@proudrock.com.bd';
    $telSupportHref = 'tel:' . preg_replace('/[^0-9+]/', '', $hotline247);
    $telSalesHref = 'tel:' . preg_replace('/[^0-9+]/', '', $salesPhone);
    $waRaw = preg_replace('/\D+/', '', (string) ($siteSettings['whatsapp_number'] ?? '8801712806237'));
    $waHref = $waRaw !== '' ? 'https://wa.me/' . $waRaw . '?text=' . rawurlencode('Hello Proud Rock Limited, I would like to inquire about enterprise hardware and automation.') : null;
@endphp

<x-layouts.app
    title="Company Profile"
    description="Learn about Proud Rock Limited (Est. 2018, affiliate AUTOROMO since 2017), our 50+ office and factory automation systems, global OEM hardware principles, and packaging professionals in Bangladesh."
>
    {{-- About Company & Capabilities (Corporate Profile & Engineering Capabilities) --}}
    <section class="py-8 sm:py-12 lg:py-14 bg-white border-b border-border-hairline">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 space-y-8 sm:space-y-10">
            {{-- Clean Breadcrumb Navigation --}}
            <nav class="flex items-center gap-2 text-xs text-ink-muted reveal-on-scroll" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-ink-primary font-medium">Company Profile</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
                {{-- Left Text Profile --}}
                <div class="lg:col-span-7 space-y-5 reveal-on-scroll">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-bold uppercase tracking-wider">
                        Who We Are · Corporate Background
                    </span>

                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-ink-primary leading-tight">
                        {{ $siteSettings['company_profile_headline'] ?? 'Customization & System Integration for Software & Hardware' }}
                    </h2>

                    <div class="space-y-4 text-sm sm:text-base text-ink-secondary leading-relaxed">
                        <p class="font-medium text-ink-primary">
                            <strong>{{ $companyName }}</strong> was formed in the year {{ $estYear }}. It is a limited liability company registered in Bangladesh. Our affiliate <strong>“{{ $affiliateName }}”</strong> has been active since {{ $affiliateYear }}.
                        </p>

                        <p>
                            The company provides customization and integration services for software and hardware, with a focus on system integration. Our expertise lies in the development of office and factory automation systems, encompassing over 50 products, including supporting software. Our key offerings include barcode labels, thermal transfer ribbons, label printers, gray fabric marking labels and solutions, attendance and access control systems, CCTV, interactive flat panel displays, RFID scanners, and barcode scanners, Building Management System, Networking etc.
                        </p>

                        <div class="p-4 sm:p-5 rounded-2xl bg-surface-canvas border-l-4 border-brand-accent text-xs sm:text-sm leading-relaxed flex items-start gap-3 shadow-2xs">
                            <span class="p-2 rounded-xl bg-brand-accent/20 text-brand-primary shrink-0 mt-0.5">
                                <x-icon name="award" class="w-4 h-4 text-brand-primary" />
                            </span>
                            <p class="text-ink-secondary">
                                <strong class="text-ink-primary font-bold">Packaging &amp; Barcode Expertise:</strong> We are a team of highly dedicated and committed packaging professionals with rich experience in varied industry segments using barcoding technologies.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Right Visual Stage (Clean Uncluttered Image) --}}
                <div class="lg:col-span-5 reveal-on-scroll stagger-2">
                    <div class="relative rounded-3xl overflow-hidden border border-border-hairline shadow-lg bg-surface-subtle p-2 hover-float group">
                        <img
                            src="{{ asset('images/categories/amc-support-services.jpg') }}"
                            alt="Proud Rock Limited Technical Diagnostic & Packaging Lab Dhaka"
                            class="rounded-2xl w-full h-[360px] sm:h-[420px] lg:h-[460px] object-cover object-center transition-transform duration-500 group-hover:scale-[1.02]"
                        />
                    </div>
                </div>
            </div>

            {{-- 8 Core Offerings & Solutions Spectrum (From Client Official Profile) --}}
            <div class="pt-6 space-y-6">
                <div class="reveal-on-scroll">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-bold uppercase tracking-wider">
                        Key Offerings &amp; Automation Systems
                    </span>
                    <h3 class="mt-2 text-xl sm:text-2xl font-bold tracking-tight text-ink-primary">
                        Office &amp; Factory Automation Systems &amp; Solutions
                    </h3>
                    <p class="text-xs sm:text-sm text-ink-muted mt-1 max-w-3xl">
                        Comprehensive hardware composition, specialized consumables, and software integration across industrial Bangladesh.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- 1. Barcode Labels & Ribbons --}}
                    <div class="reveal-on-scroll hover-float stagger-1 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="tag" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">Barcode Labels &amp; Ribbons</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            Thermal transfer ribbons (Wax, Resin, Wax-Resin) and certified barcode labels for factory packaging lines.
                        </p>
                    </div>

                    {{-- 2. Label Printers --}}
                    <div class="reveal-on-scroll hover-float stagger-2 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="printer" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">Label Printers</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            High-volume industrial barcode printers, desktop label stations, and mobile thermal receipt printers.
                        </p>
                    </div>

                    {{-- 3. Gray Fabric Marking Solutions --}}
                    <div class="reveal-on-scroll hover-float stagger-3 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-emerald-600 text-white">
                            <x-icon name="layers" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">Gray Fabric Marking Solutions</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            Specialized textile marking labels and solutions engineered for harsh textile dye, washing, and RMG workflows.
                        </p>
                    </div>

                    {{-- 4. Attendance & Access Control --}}
                    <div class="reveal-on-scroll hover-float stagger-4 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="shield-check" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">Attendance &amp; Access Control</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            Visible-light facial recognition, biometric fingerprint terminals, and optical flap barrier turnstiles.
                        </p>
                    </div>

                    {{-- 5. CCTV & Surveillance --}}
                    <div class="reveal-on-scroll hover-float stagger-1 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="video" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">CCTV &amp; Surveillance</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            High-resolution enterprise IP cameras, NVR recording ecosystems, and factory floor monitoring security.
                        </p>
                    </div>

                    {{-- 6. Interactive Flat Panel Displays --}}
                    <div class="reveal-on-scroll hover-float stagger-2 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="monitor" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">Interactive Flat Panels (IFPD)</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            4K multi-touch interactive displays, corporate boardroom smart boards, and digital presentation stations.
                        </p>
                    </div>

                    {{-- 7. RFID & Barcode Scanners --}}
                    <div class="reveal-on-scroll hover-float stagger-3 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="scan" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">RFID &amp; Barcode Scanners</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            Long-range RAIN UHF RFID readers, rugged warehouse handhelds, and omnidirectional 2D retail scanners.
                        </p>
                    </div>

                    {{-- 8. BMS & Networking --}}
                    <div class="reveal-on-scroll hover-float stagger-4 p-5 rounded-2xl bg-surface-canvas border border-border-hairline space-y-2.5">
                        <span class="inline-flex p-2.5 rounded-xl bg-brand-primary text-white">
                            <x-icon name="cpu" class="w-5 h-5" />
                        </span>
                        <h4 class="text-sm font-bold text-ink-primary">BMS &amp; Networking</h4>
                        <p class="text-xs text-ink-secondary leading-relaxed">
                            Integrated Building Management Systems (BMS), structured optical cabling, enterprise routing, and server racks.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Dual-Direction Logo Marquee Showcase: Global OEM Principles & Enterprise Clients (100% Full Width) --}}
    @php
        $brandMarquee = $brandPartners;
        while ($brandMarquee->isNotEmpty() && $brandMarquee->count() < 16) {
            $brandMarquee = $brandMarquee->concat($brandPartners);
        }

        $clientMarquee = $principleClients;
        while ($clientMarquee->isNotEmpty() && $clientMarquee->count() < 16) {
            $clientMarquee = $clientMarquee->concat($principleClients);
        }
    @endphp

    <section class="py-12 sm:py-16 bg-surface-canvas border-b border-border-hairline overflow-hidden w-full">
        {{-- Section Heading (Standard Container Alignment) --}}
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 mb-6 sm:mb-8 reveal-on-scroll">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-bold uppercase tracking-wider">
                        <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                        <span>Authorized OEM Partners &amp; Principle Clients</span>
                    </span>
                    <h2 class="mt-2.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-ink-primary">
                        Global Hardware Principles &amp; Enterprise Deployments
                    </h2>
                    <p class="mt-1.5 text-sm text-ink-secondary max-w-3xl leading-relaxed">
                        Proud Rock Limited bridges the world's most trusted Auto-ID, RAIN RFID, biometric, and POS equipment manufacturers with Bangladesh's premier industrial factories, supermarkets, and corporate campuses.
                    </p>
                </div>

                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-brand-primary hover:underline self-start md:self-auto shrink-0"
                >
                    <span>Explore All Partner Hardware</span>
                    <x-icon name="arrow-right" class="w-4 h-4" />
                </a>
            </div>
        </div>

        {{-- 100% FULL-WIDTH DUAL-DIRECTION MARQUEE SLIDERS (Edge to Edge) --}}
        <div class="w-full space-y-6 pt-1">
            {{-- Track 1: Global OEM Brand Partners (Full Width, Sliding Left) --}}
            @if ($brandPartners->isNotEmpty())
                <div class="space-y-2.5">
                    <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between reveal-on-scroll">
                        <span class="text-xs font-bold uppercase tracking-wider text-ink-muted flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-brand-primary"></span>
                            <span>Track 1 • Global Hardware Principles We Distribute &amp; Support</span>
                        </span>
                        <span class="text-[11px] text-ink-muted hidden sm:inline">← Sliding Left</span>
                    </div>

                    <div class="brand-marquee-wrapper relative w-full overflow-hidden py-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 w-12 sm:w-28 bg-gradient-to-r from-surface-canvas to-transparent z-10" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute inset-y-0 right-0 w-12 sm:w-28 bg-gradient-to-l from-surface-canvas to-transparent z-10" aria-hidden="true"></div>

                        <div class="brand-marquee-track">
                            @foreach (['first', 'second'] as $copy)
                                <div
                                    class="flex items-center gap-4 sm:gap-5 pr-4 sm:pr-5 shrink-0"
                                    @if ($copy === 'second') aria-hidden="true" @endif
                                >
                                    @foreach ($brandMarquee as $brand)
                                        <a
                                            href="{{ route('products.index', ['brand' => $brand->name]) }}"
                                            @if ($copy === 'second') tabindex="-1" @endif
                                            aria-label="{{ $brand->name }}"
                                            class="group shrink-0 w-[200px] sm:w-[240px] lg:w-[260px] h-[78px] sm:h-[88px] rounded-2xl border border-border-hairline bg-white px-5 py-3 shadow-[0_1px_3px_rgba(15,23,42,0.03)] hover:border-brand-primary/40 hover:shadow-(--shadow-card) transition-all duration-200 flex items-center justify-center cursor-pointer"
                                        >
                                            @if ($brand->logo_url)
                                                <img
                                                    src="{{ $brand->logo_url }}"
                                                    alt="{{ $brand->name }}"
                                                    loading="lazy"
                                                    class="max-h-11 sm:max-h-12 w-auto max-w-full object-contain object-center transition-transform duration-300 group-hover:scale-105"
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
                </div>
            @endif

            {{-- Track 2: Principle Corporate & Factory Clients (Full Width, Sliding Right in Reverse) --}}
            @if ($principleClients->isNotEmpty())
                <div class="space-y-2.5 pt-1">
                    <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between reveal-on-scroll">
                        <span class="text-xs font-bold uppercase tracking-wider text-ink-muted flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                            <span>Track 2 • Principle Clients &amp; Factory Implementations in Bangladesh</span>
                        </span>
                        <span class="text-[11px] text-ink-muted hidden sm:inline">Sliding Right →</span>
                    </div>

                    <div class="client-marquee-wrapper relative w-full overflow-hidden py-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 w-12 sm:w-28 bg-gradient-to-r from-surface-canvas to-transparent z-10" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute inset-y-0 right-0 w-12 sm:w-28 bg-gradient-to-l from-surface-canvas to-transparent z-10" aria-hidden="true"></div>

                        <div class="client-marquee-track">
                            @foreach (['first', 'second'] as $copy)
                                <div
                                    class="flex items-center gap-4 sm:gap-5 pr-4 sm:pr-5 shrink-0"
                                    @if ($copy === 'second') aria-hidden="true" @endif
                                >
                                    @foreach ($clientMarquee as $client)
                                        <div
                                            @if ($copy === 'second') tabindex="-1" @endif
                                            class="group shrink-0 w-[200px] sm:w-[240px] lg:w-[260px] h-[78px] sm:h-[88px] rounded-2xl border border-border-hairline bg-white px-5 py-3 shadow-[0_1px_3px_rgba(15,23,42,0.03)] hover:border-emerald-600/40 hover:shadow-(--shadow-card) transition-all duration-200 flex items-center justify-center cursor-default"
                                            title="{{ $client->name }} • {{ $client->sector }}"
                                        >
                                            @if ($client->logo_url)
                                                <img
                                                    src="{{ $client->logo_url }}"
                                                    alt="{{ $client->name }}"
                                                    loading="lazy"
                                                    class="max-h-11 sm:max-h-12 w-auto max-w-full object-contain object-center transition-transform duration-300 group-hover:scale-105"
                                                />
                                            @else
                                                <span class="text-sm sm:text-base font-extrabold tracking-tight text-ink-primary">
                                                    {{ $client->name }}
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- 4. Executive Contact & Consultation Call-to-Action --}}
    <section class="py-12 sm:py-16 bg-surface-canvas">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal-on-scroll hover-float rounded-3xl bg-brand-primary text-white p-8 sm:p-12 lg:p-14 shadow-xl relative overflow-hidden">
                <div class="max-w-3xl space-y-4 relative z-10">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                        Proud Rock Limited
                    </h2>

                    <p class="text-sm sm:text-base text-white/80 max-w-2xl leading-relaxed">
                        15+ Years of barcoding, packaging, and factory automation expertise across Bangladesh. Get in touch with our engineering team for instant corporate quotations and technical consultations.
                    </p>

                    <div class="pt-3 flex flex-wrap items-center gap-3 sm:gap-4">
                        <x-ui.button :href="route('contact.index')" variant="secondary" size="lg" class="shadow-md">
                            <span>Request Corporate Quotation</span>
                            <x-icon name="arrow-up-right" class="w-4 h-4 text-brand-primary" />
                        </x-ui.button>

                        @if ($waHref)
                            <a
                                href="{{ $waHref }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm shadow-md transition-all hover:scale-[1.02]"
                            >
                                <x-icon name="whatsapp" class="w-5 h-5 text-white" />
                                <span>WhatsApp Inquiry</span>
                            </a>
                        @endif

                        <a
                            href="{{ $telSupportHref }}"
                            class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs sm:text-sm font-semibold transition-colors"
                        >
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>24/7 Active Hotline: {{ $hotline247 }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

