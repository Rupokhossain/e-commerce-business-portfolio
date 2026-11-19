<x-layouts.admin
    title="Site Settings & Configuration"
    subtitle="Configure global corporate contact details, WhatsApp gateway, portfolio story and branding"
>
    <div class="w-full max-w-full overflow-x-hidden space-y-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="w-full pb-28 lg:pb-0">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                {{-- LEFT COLUMN (8 cols): All Core Settings Sections --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- 1. Company Identity & Branding --}}
                    <div id="company-identity" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex items-start sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                    <x-icon name="building-2" class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Company Identity &amp; Branding</h3>
                                    <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">Corporate name, slogan and footer profile summary</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                Section 01
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="company_name" class="block text-xs font-bold text-ink-primary mb-1.5">Company Legal Name *</label>
                                <input
                                    type="text"
                                    name="company_name"
                                    id="company_name"
                                    value="{{ old('company_name', $settings['company_name'] ?? 'ProudRock Ltd.') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="company_tagline" class="block text-xs font-bold text-ink-primary mb-1.5">Corporate Tagline / Slogan</label>
                                <input
                                    type="text"
                                    name="company_tagline"
                                    id="company_tagline"
                                    value="{{ old('company_tagline', $settings['company_tagline'] ?? 'Enterprise Automation & Hardware Systems') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <label for="footer_summary" class="block text-xs font-bold text-ink-primary mb-1.5">Footer Corporate Overview &amp; Mission</label>
                                <textarea
                                    name="footer_summary"
                                    id="footer_summary"
                                    rows="3"
                                    class="w-full rounded-xl border border-border-hairline p-4 text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                >{{ old('footer_summary', $settings['footer_summary'] ?? '') }}</textarea>
                                <p class="text-[11px] text-ink-muted mt-1">This text appears across the public footer on every page.</p>
                            </div>
                        </div>

                        {{-- Logo & Favicon Assets (Managed via Dashboard) --}}
                        <div class="pt-5 border-t border-border-hairline space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-ink-muted">Company Logo &amp; Favicon Assets</h4>
                                <span class="text-[11px] text-brand-primary font-semibold">Live Site Branding</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                {{-- Official Logo --}}
                                <div class="p-4 rounded-xl border border-border-hairline bg-surface-canvas/60 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <label class="block text-xs font-bold text-ink-primary">Official Company Logo</label>
                                        <span class="text-[10px] text-ink-muted font-medium">Header &amp; Footer</span>
                                    </div>

                                    @php
                                        $currentLogo = $settings['site_logo'] ?? '';
                                    @endphp

                                    @if (! empty($currentLogo))
                                        <div class="p-3 rounded-xl bg-white border border-border-hairline flex items-center justify-between gap-3 shadow-2xs">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <div class="h-10 w-24 rounded-lg bg-surface-subtle p-1 border border-border-hairline flex items-center justify-center shrink-0">
                                                    <img src="{{ asset($currentLogo) }}" alt="Current Logo" class="max-h-8 max-w-full object-contain" />
                                                </div>
                                                <div class="text-[11px] font-mono text-ink-secondary truncate max-w-[150px]">{{ $currentLogo }}</div>
                                            </div>
                                            <label class="inline-flex items-center gap-1.5 text-xs text-rose-600 font-semibold cursor-pointer hover:underline shrink-0">
                                                <input type="checkbox" name="remove_site_logo" value="1" class="rounded text-rose-600 border-rose-300 h-3.5 w-3.5" />
                                                <span>Remove</span>
                                            </label>
                                        </div>
                                    @else
                                        <div class="p-3 rounded-xl bg-white border border-border-hairline flex items-center gap-2.5 text-xs text-ink-muted">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-brand-primary-soft text-brand-primary text-[10px] font-bold">Default SVG</span>
                                            <span>Using standard Proud Rock corporate SVG logo.</span>
                                        </div>
                                    @endif

                                    <div>
                                        <label for="site_logo_file" class="block text-[11px] font-semibold text-ink-secondary mb-1">Upload New Logo (PNG, SVG, JPG, WebP)</label>
                                        <input
                                            type="file"
                                            name="site_logo_file"
                                            id="site_logo_file"
                                            accept="image/png,image/svg+xml,image/jpeg,image/webp"
                                            class="w-full text-xs text-ink-secondary file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary file:text-white cursor-pointer"
                                        />
                                    </div>

                                    <div>
                                        <label for="site_logo" class="block text-[11px] font-semibold text-ink-muted mb-1">Or Logo File Path / URL</label>
                                        <input
                                            type="text"
                                            name="site_logo"
                                            id="site_logo"
                                            value="{{ old('site_logo', $currentLogo) }}"
                                            placeholder="storage/branding/logo.png"
                                            class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs font-mono focus:outline-none focus:border-brand-primary"
                                        />
                                    </div>
                                </div>

                                {{-- Browser Tab Favicon --}}
                                <div class="p-4 rounded-xl border border-border-hairline bg-surface-canvas/60 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <label class="block text-xs font-bold text-ink-primary">Browser Tab Favicon</label>
                                        <span class="text-[10px] text-ink-muted font-medium">Tab Icon</span>
                                    </div>

                                    @php
                                        $currentFavicon = $settings['site_favicon'] ?? '';
                                    @endphp

                                    @if (! empty($currentFavicon))
                                        <div class="p-3 rounded-xl bg-white border border-border-hairline flex items-center justify-between gap-3 shadow-2xs">
                                            <div class="flex items-center gap-2.5 min-w-0">
                                                <div class="h-8 w-8 rounded-lg bg-surface-subtle p-1 border border-border-hairline flex items-center justify-center shrink-0">
                                                    <img src="{{ asset($currentFavicon) }}" alt="Favicon" class="max-h-6 max-w-6 object-contain" />
                                                </div>
                                                <div class="text-[11px] font-mono text-ink-secondary truncate max-w-[150px]">{{ $currentFavicon }}</div>
                                            </div>
                                            <label class="inline-flex items-center gap-1.5 text-xs text-rose-600 font-semibold cursor-pointer hover:underline shrink-0">
                                                <input type="checkbox" name="remove_site_favicon" value="1" class="rounded text-rose-600 border-rose-300 h-3.5 w-3.5" />
                                                <span>Remove</span>
                                            </label>
                                        </div>
                                    @endif

                                    <div>
                                        <label for="site_favicon_file" class="block text-[11px] font-semibold text-ink-secondary mb-1">Upload Favicon (.ico, .png, .svg)</label>
                                        <input
                                            type="file"
                                            name="site_favicon_file"
                                            id="site_favicon_file"
                                            accept=".ico,image/png,image/svg+xml"
                                            class="w-full text-xs text-ink-secondary file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary file:text-white cursor-pointer"
                                        />
                                    </div>

                                    <div>
                                        <label for="site_favicon" class="block text-[11px] font-semibold text-ink-muted mb-1">Or Favicon Path / URL</label>
                                        <input
                                            type="text"
                                            name="site_favicon"
                                            id="site_favicon"
                                            value="{{ old('site_favicon', $currentFavicon) }}"
                                            placeholder="storage/branding/favicon.ico"
                                            class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs font-mono focus:outline-none focus:border-brand-primary"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Direct Sales, Phone & WhatsApp Gateway --}}
                    <div id="contact-info" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex items-start sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                    <x-icon name="phone" class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Contact, Hotlines &amp; WhatsApp Gateway</h3>
                                    <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">Corporate phone lines, instant WhatsApp quote trigger and office address</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                Section 02
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- 24/7 Support Number --}}
                            <div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50/40 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-emerald-900 flex items-center gap-1.5">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span>24/7 Technical Support Helpline</span>
                                    </span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                        24-Hour Active
                                    </span>
                                </div>
                                <div>
                                    <label for="contact_support_24_7" class="block text-xs font-bold text-ink-primary mb-1">Hotline Number (24/7 Support) *</label>
                                    <input
                                        type="text"
                                        name="contact_support_24_7"
                                        id="contact_support_24_7"
                                        value="{{ old('contact_support_24_7', $settings['contact_support_24_7'] ?? '+880 1673-638094') }}"
                                        class="w-full rounded-xl border border-border-hairline bg-white px-3.5 py-2 text-xs sm:text-sm font-semibold focus:outline-none focus:border-brand-primary"
                                    />
                                </div>
                                <div>
                                    <label for="support_hours_label" class="block text-[11px] font-bold text-ink-muted mb-1">Support Schedule Note</label>
                                    <input
                                        type="text"
                                        name="support_hours_label"
                                        id="support_hours_label"
                                        value="{{ old('support_hours_label', $settings['support_hours_label'] ?? '24 Hours · 7 Days Active Emergency Helpline') }}"
                                        class="w-full rounded-xl border border-border-hairline bg-white px-3 py-1.5 text-xs text-ink-secondary focus:outline-none focus:border-brand-primary"
                                    />
                                </div>
                            </div>

                            {{-- 9 AM - 6 PM Business Hotline --}}
                            <div class="p-4 rounded-xl border border-blue-200 bg-blue-50/40 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-blue-900 flex items-center gap-1.5">
                                        <x-icon name="clock" class="w-3.5 h-3.5 text-blue-600" />
                                        <span>Corporate Sales Line (9 AM – 6 PM)</span>
                                    </span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">
                                        Sales Desk
                                    </span>
                                </div>
                                <div>
                                    <label for="contact_hotline_business" class="block text-xs font-bold text-ink-primary mb-1">Sales Phone / Hotline *</label>
                                    <input
                                        type="text"
                                        name="contact_hotline_business"
                                        id="contact_hotline_business"
                                        value="{{ old('contact_hotline_business', $settings['contact_hotline_business'] ?? '+880 1712-806237') }}"
                                        class="w-full rounded-xl border border-border-hairline bg-white px-3.5 py-2 text-xs sm:text-sm font-semibold focus:outline-none focus:border-brand-primary"
                                    />
                                </div>
                                <div>
                                    <label for="office_hours_label" class="block text-[11px] font-bold text-ink-muted mb-1">Hotline Schedule Note</label>
                                    <input
                                        type="text"
                                        name="office_hours_label"
                                        id="office_hours_label"
                                        value="{{ old('office_hours_label', $settings['office_hours_label'] ?? 'Sat – Thu · 9:00 AM – 6:00 PM') }}"
                                        class="w-full rounded-xl border border-border-hairline bg-white px-3 py-1.5 text-xs text-ink-secondary focus:outline-none focus:border-brand-primary"
                                    />
                                </div>
                            </div>

                            <div>
                                <label for="contact_phone" class="block text-xs font-bold text-ink-primary mb-1.5">Sales Phone (Direct)</label>
                                <input
                                    type="text"
                                    name="contact_phone"
                                    id="contact_phone"
                                    value="{{ old('contact_phone', $settings['contact_phone'] ?? '+880 1712-806237') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="contact_mobile" class="block text-xs font-bold text-ink-primary mb-1.5">Support Hotline (Direct Mobile)</label>
                                <input
                                    type="text"
                                    name="contact_mobile"
                                    id="contact_mobile"
                                    value="{{ old('contact_mobile', $settings['contact_mobile'] ?? '+880 1673-638094') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="whatsapp_number" class="block text-xs font-bold text-ink-primary mb-1.5">
                                    WhatsApp Gateway Number (Digits only, e.g. 8801712806237)
                                </label>
                                <input
                                    type="text"
                                    name="whatsapp_number"
                                    id="whatsapp_number"
                                    value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '8801712806237') }}"
                                    placeholder="8801712806237"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-mono focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                                <p class="text-[11px] text-ink-muted mt-1">Used automatically for 1-click WhatsApp quote links across all products.</p>
                            </div>

                            <div>
                                <label for="contact_email" class="block text-xs font-bold text-ink-primary mb-1.5">Official Corporate Email</label>
                                <input
                                    type="email"
                                    name="contact_email"
                                    id="contact_email"
                                    value="{{ old('contact_email', $settings['contact_email'] ?? 'info@proudrock.com.bd') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="office_hours" class="block text-xs font-bold text-ink-primary mb-1.5">Business / Office Hours</label>
                                <input
                                    type="text"
                                    name="office_hours"
                                    id="office_hours"
                                    value="{{ old('office_hours', $settings['office_hours'] ?? 'Sat – Thu · 9:00 AM – 6:00 PM') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="office_address" class="block text-xs font-bold text-ink-primary mb-1.5">Physical Corporate Address</label>
                                <input
                                    type="text"
                                    name="office_address"
                                    id="office_address"
                                    value="{{ old('office_address', $settings['office_address'] ?? 'Dhaka, Bangladesh') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>
                        </div>
                    </div>

                    {{-- 3. Social Media Channels & Footer Profiles --}}
                    @php
                        $rawSocialLinks = $settings['social_links'] ?? null;
                        $socialList = [];
                        if ($rawSocialLinks !== null) {
                            $decoded = is_string($rawSocialLinks) ? json_decode($rawSocialLinks, true) : $rawSocialLinks;
                            $socialList = is_array($decoded) ? $decoded : [];
                        } else {
                            $socialList = [
                                ['platform' => 'facebook', 'label' => 'Facebook', 'url' => 'https://facebook.com', 'is_active' => true],
                            ];
                        }
                    @endphp

                    <div id="social-media" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex items-start sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                    <x-icon name="globe" class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Social Media Channels &amp; Footer Links</h3>
                                    <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">Add, edit, or delete social media icons displayed in the website footer</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                Section 03
                            </span>
                        </div>

                        <div class="space-y-3" id="social-links-container">
                            @foreach ($socialList as $sIdx => $socialItem)
                                <div class="social-row p-3.5 rounded-xl border border-border-hairline bg-surface-canvas/70 flex flex-col md:flex-row items-stretch md:items-center gap-3">
                                    <div class="w-full md:w-44 shrink-0">
                                        <label class="block text-[10px] font-bold text-ink-muted uppercase mb-1">Platform</label>
                                        <select
                                            name="social_links[{{ $sIdx }}][platform]"
                                            class="w-full rounded-lg border border-border-hairline bg-white px-2.5 py-1.5 text-xs font-semibold focus:outline-none focus:border-brand-primary"
                                        >
                                            @foreach (['facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube', 'instagram' => 'Instagram', 'twitter' => 'X / Twitter', 'whatsapp' => 'WhatsApp', 'globe' => 'Website / Other'] as $pKey => $pLabel)
                                                <option value="{{ $pKey }}" @selected(($socialItem['platform'] ?? '') === $pKey)>{{ $pLabel }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-full md:w-44 shrink-0">
                                        <label class="block text-[10px] font-bold text-ink-muted uppercase mb-1">Display Label</label>
                                        <input
                                            type="text"
                                            name="social_links[{{ $sIdx }}][label]"
                                            value="{{ $socialItem['label'] ?? '' }}"
                                            placeholder="e.g. Official Page"
                                            class="w-full rounded-lg border border-border-hairline bg-white px-3 py-1.5 text-xs focus:outline-none focus:border-brand-primary"
                                        />
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <label class="block text-[10px] font-bold text-ink-muted uppercase mb-1">Target URL *</label>
                                        <input
                                            type="url"
                                            name="social_links[{{ $sIdx }}][url]"
                                            value="{{ $socialItem['url'] ?? '' }}"
                                            placeholder="https://..."
                                            class="w-full rounded-lg border border-border-hairline bg-white px-3 py-1.5 text-xs focus:outline-none focus:border-brand-primary font-mono"
                                        />
                                    </div>

                                    <div class="flex items-center justify-between md:justify-end gap-3 shrink-0 pt-2 md:pt-4">
                                        <label class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink-secondary cursor-pointer">
                                            <input type="hidden" name="social_links[{{ $sIdx }}][is_active]" value="0" />
                                            <input
                                                type="checkbox"
                                                name="social_links[{{ $sIdx }}][is_active]"
                                                value="1"
                                                @checked($socialItem['is_active'] ?? true)
                                                class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-3.5 w-3.5"
                                            />
                                            <span>Active</span>
                                        </label>

                                        <button
                                            type="button"
                                            onclick="this.closest('.social-row').remove()"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                            title="Delete Social Channel"
                                        >
                                            <x-icon name="trash-2" class="w-4 h-4" />
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-2">
                            <button
                                type="button"
                                id="add-social-btn"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-surface-canvas border border-border-hairline hover:border-brand-primary text-xs font-bold text-ink-primary hover:text-brand-primary transition-colors cursor-pointer shadow-2xs"
                            >
                                <x-icon name="plus" class="w-3.5 h-3.5 text-brand-primary" />
                                <span>Add Another Social Link</span>
                            </button>
                        </div>
                    </div>

                    {{-- 4. Header Topbar & Homepage Configuration --}}
                    <div id="header-homepage" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex items-start sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                    <x-icon name="layout-dashboard" class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Header &amp; Homepage Configuration</h3>
                                    <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">Top announcement bar text, header quote button, and catalog limits</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                Section 04
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            <div class="lg:col-span-2">
                                <label for="header_topbar_notice" class="block text-xs font-bold text-ink-primary mb-1.5">Header Topbar Left Announcement Banner</label>
                                <input
                                    type="text"
                                    name="header_topbar_notice"
                                    id="header_topbar_notice"
                                    placeholder="e.g. Authorized B2B Hardware & RFID System Integrator in Bangladesh"
                                    value="{{ old('header_topbar_notice', $settings['header_topbar_notice'] ?? '') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="header_cta_text" class="block text-xs font-bold text-ink-primary mb-1.5">Top CTA Button Label</label>
                                <input
                                    type="text"
                                    name="header_cta_text"
                                    id="header_cta_text"
                                    value="{{ old('header_cta_text', $settings['header_cta_text'] ?? 'Request Quote') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="lg:col-span-2">
                                <label for="header_topbar_right_text" class="block text-xs font-bold text-ink-primary mb-1.5">Topbar Right-Side Text / Status (Fixes Empty Space)</label>
                                <input
                                    type="text"
                                    name="header_topbar_right_text"
                                    id="header_topbar_right_text"
                                    placeholder="e.g. Sat – Thu · 9:00 AM – 6:00 PM • Authorized OEM & AMC Partner"
                                    value="{{ old('header_topbar_right_text', $settings['header_topbar_right_text'] ?? '') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                                <p class="text-[11px] text-ink-muted mt-1">Leave blank to display standard Office Hours and Authorized OEM Partner badge.</p>
                            </div>

                            <div>
                                <label for="home_products_limit" class="block text-xs font-bold text-ink-primary mb-1.5">Homepage Featured Products Count</label>
                                <input
                                    type="number"
                                    name="home_products_limit"
                                    id="home_products_limit"
                                    min="1"
                                    max="24"
                                    value="{{ old('home_products_limit', $settings['home_products_limit'] ?? '8') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>
                        </div>
                    </div>

                    {{-- 5. Deployments Gallery Settings --}}
                    <div id="gallery-settings" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-start sm:items-center justify-between sm:justify-start gap-2.5 min-w-0">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                        <x-icon name="images" class="w-5 h-5" />
                                    </div>
                                    <div>
                                        <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Field Deployments Gallery (/gallery)</h3>
                                        <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">Public gallery headline, badge and introductory narrative</p>
                                    </div>
                                </div>
                                <span class="sm:hidden shrink-0 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                    Section 05
                                </span>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="hidden sm:inline-block shrink-0 text-[11px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                    Section 05
                                </span>
                                <a
                                    href="{{ route('admin.portfolios.index') }}"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-2 sm:py-1.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary/95 transition-colors shadow-2xs w-full sm:w-auto"
                                >
                                    <x-icon name="plus" class="w-3.5 h-3.5 text-brand-accent" />
                                    <span>Manage Deployments &amp; Photos</span>
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="gallery_badge" class="block text-xs font-bold text-ink-primary mb-1.5">Gallery Eyebrow Badge</label>
                                <input
                                    type="text"
                                    name="gallery_badge"
                                    id="gallery_badge"
                                    value="{{ old('gallery_badge', $settings['gallery_badge'] ?? 'Verified On-Site Implementations') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="gallery_title" class="block text-xs font-bold text-ink-primary mb-1.5">Gallery Main Headline</label>
                                <input
                                    type="text"
                                    name="gallery_title"
                                    id="gallery_title"
                                    value="{{ old('gallery_title', $settings['gallery_title'] ?? 'Field Deployments & Solutions Gallery') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <label for="gallery_subtitle" class="block text-xs font-bold text-ink-primary mb-1.5">Gallery Narrative &amp; Subtitle</label>
                                <textarea
                                    name="gallery_subtitle"
                                    id="gallery_subtitle"
                                    rows="2"
                                    class="w-full rounded-xl border border-border-hairline p-4 text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                >{{ old('gallery_subtitle', $settings['gallery_subtitle'] ?? 'Visual documentation and operational case studies of industrial barcode printing, dock-door RAIN RFID portals, biometric speed gates, and smart POS retail rollouts engineered across Bangladesh.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 6. Portfolio Editorial Section Settings --}}
                    <div id="portfolio-editorial" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex items-start sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                    <x-icon name="briefcase" class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Portfolio Page Editorial Showcase</h3>
                                    <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">About Us storytelling section, experience ribbon, and client trust metrics</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                Section 06
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="portfolio_about_eyebrow" class="block text-xs font-bold text-ink-primary mb-1.5">About Section Eyebrow</label>
                                <input
                                    type="text"
                                    name="portfolio_about_eyebrow"
                                    id="portfolio_about_eyebrow"
                                    value="{{ old('portfolio_about_eyebrow', $settings['portfolio_about_eyebrow'] ?? 'Welcome to ProudRock Ltd.') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="portfolio_about_badge" class="block text-xs font-bold text-ink-primary mb-1.5">Vertical Experience Ribbon Badge</label>
                                <input
                                    type="text"
                                    name="portfolio_about_badge"
                                    id="portfolio_about_badge"
                                    value="{{ old('portfolio_about_badge', $settings['portfolio_about_badge'] ?? '15+ Years Experience') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <label for="portfolio_about_title" class="block text-xs font-bold text-ink-primary mb-1.5">About Section Main Heading</label>
                                <input
                                    type="text"
                                    name="portfolio_about_title"
                                    id="portfolio_about_title"
                                    value="{{ old('portfolio_about_title', $settings['portfolio_about_title'] ?? '') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="portfolio_about_stat_value" class="block text-xs font-bold text-ink-primary mb-1.5">Client Stat Number</label>
                                <input
                                    type="text"
                                    name="portfolio_about_stat_value"
                                    id="portfolio_about_stat_value"
                                    value="{{ old('portfolio_about_stat_value', $settings['portfolio_about_stat_value'] ?? '500+') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="portfolio_about_stat_label" class="block text-xs font-bold text-ink-primary mb-1.5">Client Stat Label</label>
                                <input
                                    type="text"
                                    name="portfolio_about_stat_label"
                                    id="portfolio_about_stat_label"
                                    value="{{ old('portfolio_about_stat_label', $settings['portfolio_about_stat_label'] ?? 'Factories & Corporate Clients') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="portfolio_why_title" class="block text-xs font-bold text-ink-primary mb-1.5">Why Choose Us Section Heading</label>
                                <input
                                    type="text"
                                    name="portfolio_why_title"
                                    id="portfolio_why_title"
                                    value="{{ old('portfolio_why_title', $settings['portfolio_why_title'] ?? '') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="portfolio_why_badge" class="block text-xs font-bold text-ink-primary mb-1.5">Engineering Lab Caption Badge</label>
                                <input
                                    type="text"
                                    name="portfolio_why_badge"
                                    id="portfolio_why_badge"
                                    value="{{ old('portfolio_why_badge', $settings['portfolio_why_badge'] ?? 'Dedicated Dhaka Engineering Lab & SLA') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>
                        </div>
                    </div>

                    {{-- 7. Company Profile, History & Automation Spectrum --}}
                    <div id="company-profile-settings" class="scroll-mt-24 rounded-2xl border border-border-hairline bg-white p-4 sm:p-6 lg:p-7 shadow-xs space-y-5">
                        <div class="flex items-start sm:items-center justify-between gap-3 border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="p-2 rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                    <x-icon name="shield-check" class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-ink-primary leading-tight">Company Profile &amp; Automation Spectrum</h3>
                                    <p class="text-[11px] sm:text-xs text-ink-muted leading-snug">Official corporate history, affiliate Autoromo credentials, and 50+ automation solutions</p>
                                </div>
                            </div>
                            <span class="shrink-0 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider px-2 sm:px-2.5 py-0.5 rounded-full bg-surface-canvas text-ink-muted border border-border-hairline whitespace-nowrap">
                                Section 07
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            <div>
                                <label for="company_est_year" class="block text-xs font-bold text-ink-primary mb-1.5">Company Formed Year *</label>
                                <input
                                    type="text"
                                    name="company_est_year"
                                    id="company_est_year"
                                    placeholder="e.g. 2018"
                                    value="{{ old('company_est_year', $settings['company_est_year'] ?? '2018') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="company_affiliate_name" class="block text-xs font-bold text-ink-primary mb-1.5">Affiliate / Sister Concern</label>
                                <input
                                    type="text"
                                    name="company_affiliate_name"
                                    id="company_affiliate_name"
                                    placeholder="e.g. AUTOROMO"
                                    value="{{ old('company_affiliate_name', $settings['company_affiliate_name'] ?? 'AUTOROMO') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="company_affiliate_year" class="block text-xs font-bold text-ink-primary mb-1.5">Affiliate Active Since</label>
                                <input
                                    type="text"
                                    name="company_affiliate_year"
                                    id="company_affiliate_year"
                                    placeholder="e.g. 2017"
                                    value="{{ old('company_affiliate_year', $settings['company_affiliate_year'] ?? '2017') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="md:col-span-2">
                                <label for="company_legal_status" class="block text-xs font-bold text-ink-primary mb-1.5">Legal Registration Status</label>
                                <input
                                    type="text"
                                    name="company_legal_status"
                                    id="company_legal_status"
                                    value="{{ old('company_legal_status', $settings['company_legal_status'] ?? 'Limited liability company registered in Bangladesh') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div>
                                <label for="company_products_count" class="block text-xs font-bold text-ink-primary mb-1.5">Automation Systems Count</label>
                                <input
                                    type="text"
                                    name="company_products_count"
                                    id="company_products_count"
                                    placeholder="e.g. 50+"
                                    value="{{ old('company_products_count', $settings['company_products_count'] ?? '50+') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label for="company_profile_headline" class="block text-xs font-bold text-ink-primary mb-1.5">Profile Page Executive Headline</label>
                                <input
                                    type="text"
                                    name="company_profile_headline"
                                    id="company_profile_headline"
                                    value="{{ old('company_profile_headline', $settings['company_profile_headline'] ?? 'Customization and Integration Services for Software & Hardware') }}"
                                    class="w-full rounded-xl border border-border-hairline px-4 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                />
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label for="company_profile_story" class="block text-xs font-bold text-ink-primary mb-1.5">Company Official Profile &amp; Formation Narrative</label>
                                <textarea
                                    name="company_profile_story"
                                    id="company_profile_story"
                                    rows="4"
                                    class="w-full rounded-xl border border-border-hairline p-4 text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                >{{ old('company_profile_story', $settings['company_profile_story'] ?? '') }}</textarea>
                                <p class="text-[11px] text-ink-muted mt-1">This text is displayed prominently under "Who We Are" on the Company Profile page.</p>
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label for="company_team_summary" class="block text-xs font-bold text-ink-primary mb-1.5">Packaging &amp; Barcode Engineering Team Credo</label>
                                <textarea
                                    name="company_team_summary"
                                    id="company_team_summary"
                                    rows="2"
                                    class="w-full rounded-xl border border-border-hairline p-4 text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                >{{ old('company_team_summary', $settings['company_team_summary'] ?? 'We are a team of highly dedicated and committed packaging professionals with rich experience in varied industry segments using barcoding technologies.') }}</textarea>
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label for="company_key_offerings" class="block text-xs font-bold text-ink-primary mb-1.5">Core Product Offerings Summary List</label>
                                <textarea
                                    name="company_key_offerings"
                                    id="company_key_offerings"
                                    rows="3"
                                    class="w-full rounded-xl border border-border-hairline p-4 text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                                >{{ old('company_key_offerings', $settings['company_key_offerings'] ?? 'Barcode labels, thermal transfer ribbons, label printers, gray fabric marking labels and solutions, attendance and access control systems, CCTV, interactive flat panel displays, RFID scanners, barcode scanners, Building Management System, Networking etc.') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT COLUMN (4 cols): Sticky Publishing Card & Quick Actions --}}
                <div class="lg:col-span-4 space-y-6">

                    {{-- Sticky Action & Save Box --}}
                    <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-xs space-y-5 sticky top-20">
                        <div class="flex items-center justify-between border-b border-border-hairline pb-4">
                            <div class="flex items-center gap-2">
                                <x-icon name="check-circle-2" class="w-4 h-4 text-emerald-600" />
                                <span class="text-xs font-bold uppercase tracking-wider text-ink-primary">Settings Control</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-semibold">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Live Sync
                            </span>
                        </div>

                        <p class="text-xs text-ink-secondary leading-relaxed">
                            সেটিংস সেভ করার সাথে সাথেই তা পুরো ওয়েবসাইটের হেডার, ফুটার, হোয়াটসঅ্যাপ লিঙ্ক এবং পোর্টফোলিও সেকশনে লাইভ আপডেট হবে।
                        </p>

                        <button
                            type="submit"
                            class="w-full py-3.5 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white text-xs sm:text-sm font-bold shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <x-icon name="check" class="w-4 h-4 text-brand-accent" />
                            <span>Save All Settings</span>
                        </button>

                        {{-- Quick Test Links --}}
                        <div class="pt-2 border-t border-border-hairline space-y-2.5">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-ink-muted block">Quick Testing &amp; Preview</span>

                            <a
                                href="{{ route('home') }}"
                                target="_blank"
                                class="w-full flex items-center justify-between p-2.5 rounded-xl border border-border-hairline bg-surface-canvas hover:bg-white text-xs font-semibold text-ink-secondary hover:text-brand-primary transition-colors shadow-2xs"
                            >
                                <span class="flex items-center gap-2">
                                    <x-icon name="globe" class="w-3.5 h-3.5 text-brand-primary" />
                                    <span>View Live Website</span>
                                </span>
                                <x-icon name="external-link" class="w-3 h-3 text-ink-muted" />
                            </a>

                            @php
                                $waDigits = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '8801730066010');
                            @endphp
                            @if ($waDigits)
                                <a
                                    href="https://wa.me/{{ $waDigits }}"
                                    target="_blank"
                                    class="w-full flex items-center justify-between p-2.5 rounded-xl border border-border-hairline bg-surface-canvas hover:bg-white text-xs font-semibold text-ink-secondary hover:text-emerald-700 transition-colors shadow-2xs"
                                >
                                    <span class="flex items-center gap-2">
                                        <x-icon name="message-circle" class="w-3.5 h-3.5 text-emerald-600" />
                                        <span>Test WhatsApp Gateway</span>
                                    </span>
                                    <x-icon name="external-link" class="w-3 h-3 text-ink-muted" />
                                </a>
                            @endif

                            @if (!empty($settings['contact_mobile']))
                                <a
                                    href="tel:{{ $settings['contact_mobile'] }}"
                                    class="w-full flex items-center justify-between p-2.5 rounded-xl border border-border-hairline bg-surface-canvas hover:bg-white text-xs font-semibold text-ink-secondary hover:text-brand-primary transition-colors shadow-2xs"
                                >
                                    <span class="flex items-center gap-2">
                                        <x-icon name="phone" class="w-3.5 h-3.5 text-brand-primary" />
                                        <span>Call Direct Hotline</span>
                                    </span>
                                    <span class="text-[10px] font-mono text-ink-muted">{{ $settings['contact_mobile'] }}</span>
                                </a>
                            @endif
                        </div>

                        {{-- Section Navigation Shortcuts --}}
                        <div class="pt-2 border-t border-border-hairline space-y-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-ink-muted block">Jump to Section</span>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <a href="#company-identity" class="px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium truncate">
                                    1. Identity
                                </a>
                                <a href="#contact-info" class="px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium truncate">
                                    2. Contact
                                </a>
                                <a href="#social-media" class="px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium truncate">
                                    3. Social
                                </a>
                                <a href="#header-homepage" class="px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium truncate">
                                    4. Header
                                </a>
                                <a href="#gallery-settings" class="px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium truncate">
                                    5. Gallery
                                </a>
                                <a href="#portfolio-editorial" class="px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium truncate">
                                    6. Portfolio
                                </a>
                                <a href="#company-profile-settings" class="col-span-2 px-2.5 py-1.5 rounded-lg bg-surface-canvas hover:bg-brand-primary-soft hover:text-brand-primary text-ink-muted transition-colors font-medium text-center">
                                    7. Company Profile &amp; Solutions
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Mobile Floating Bottom Action Bar (Thumb-friendly saving on mobile devices) --}}
            <div class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-border-hairline p-3 shadow-xl pb-[calc(0.75rem+env(safe-area-inset-bottom,0px))]">
                <button
                    type="submit"
                    class="w-full py-3 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white text-xs sm:text-sm font-bold shadow-md flex items-center justify-center gap-2 cursor-pointer transition-all active:scale-[0.99]"
                >
                    <x-icon name="check" class="w-4 h-4 text-brand-accent" />
                    <span>Save All Settings</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-social-btn');
            const container = document.getElementById('social-links-container');

            if (!addBtn || !container) return;

            addBtn.addEventListener('click', function() {
                const nextIdx = container.querySelectorAll('.social-row').length + Date.now();
                const row = document.createElement('div');
                row.className = 'social-row p-3.5 rounded-xl border border-border-hairline bg-surface-canvas/70 flex flex-col md:flex-row items-stretch md:items-center gap-3 animate-fade-in';
                row.innerHTML = `
                    <div class="w-full md:w-44 shrink-0">
                        <label class="block text-[10px] font-bold text-ink-muted uppercase mb-1">Platform</label>
                        <select
                            name="social_links[${nextIdx}][platform]"
                            class="w-full rounded-lg border border-border-hairline bg-white px-2.5 py-1.5 text-xs font-semibold focus:outline-none focus:border-brand-primary"
                        >
                            <option value="facebook">Facebook</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="youtube">YouTube</option>
                            <option value="instagram">Instagram</option>
                            <option value="twitter">X / Twitter</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="globe">Website / Other</option>
                        </select>
                    </div>

                    <div class="w-full md:w-44 shrink-0">
                        <label class="block text-[10px] font-bold text-ink-muted uppercase mb-1">Display Label</label>
                        <input
                            type="text"
                            name="social_links[${nextIdx}][label]"
                            placeholder="e.g. Official Page"
                            class="w-full rounded-lg border border-border-hairline bg-white px-3 py-1.5 text-xs focus:outline-none focus:border-brand-primary"
                        />
                    </div>

                    <div class="flex-1 min-w-0">
                        <label class="block text-[10px] font-bold text-ink-muted uppercase mb-1">Target URL *</label>
                        <input
                            type="url"
                            name="social_links[${nextIdx}][url]"
                            placeholder="https://..."
                            required
                            class="w-full rounded-lg border border-border-hairline bg-white px-3 py-1.5 text-xs focus:outline-none focus:border-brand-primary font-mono"
                        />
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-3 shrink-0 pt-2 md:pt-4">
                        <label class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink-secondary cursor-pointer">
                            <input type="hidden" name="social_links[${nextIdx}][is_active]" value="0" />
                            <input
                                type="checkbox"
                                name="social_links[${nextIdx}][is_active]"
                                value="1"
                                checked
                                class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-3.5 w-3.5"
                            />
                            <span>Active</span>
                        </label>

                        <button
                            type="button"
                            onclick="this.closest('.social-row').remove()"
                            class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                            title="Delete Social Channel"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                <line x1="10" x2="10" y1="11" y2="17"/>
                                <line x1="14" x2="14" y1="11" y2="17"/>
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(row);
                row.querySelector('input[type="url"]').focus();
            });
        });
    </script>
</x-layouts.admin>
