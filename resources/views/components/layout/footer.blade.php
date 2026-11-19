@php
    $companyName = $siteSettings['company_name'] ?? 'Proud Rock Limited';
    $logoPath = $siteSettings['site_logo'] ?? null;
    $footerSummary = $siteSettings['footer_summary'] ?? 'PROUD ROCK LIMITED (formed in 2018) provides customization and integration services for software and hardware, with a focus on system integration and 50+ office & factory automation products. Affiliate “AUTOROMO” active since 2017.';
    $phone = $siteSettings['contact_phone'] ?? '+880 1712-806237';
    $mobile = $siteSettings['contact_mobile'] ?? '+880 1673-638094';
    $support247 = $siteSettings['contact_support_24_7'] ?? ($mobile ?: '+880 1673-638094');
    $businessHotline = $siteSettings['contact_hotline_business'] ?? ($phone ?: '+880 1712-806237');
    $email = $siteSettings['contact_email'] ?? 'info@proudrock.com.bd';
    $address = $siteSettings['office_address'] ?? 'Dhaka, Bangladesh';
@endphp

<footer class="bg-brand-primary text-white/85 border-t border-white/10 mt-auto">
    <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="space-y-4">
                <x-ui.brand-logo variant="light" :logo-path="$logoPath" :company-name="$companyName" />
                <p class="text-sm text-white/70 leading-relaxed">
                    {{ $footerSummary }}
                </p>
                <div class="pt-2 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-semibold">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>24/7 Breakdown Support</span>
                    </span>
                </div>

                {{-- Dynamic Social Media Channels (Managed via Dashboard) --}}
                @php
                    $rawSocial = $siteSettings['social_links'] ?? null;
                    $socialLinks = [];
                    if (! empty($rawSocial)) {
                        $decoded = is_string($rawSocial) ? json_decode($rawSocial, true) : $rawSocial;
                        if (is_array($decoded)) {
                            $socialLinks = array_filter($decoded, fn($item) => !empty($item['url']) && ($item['is_active'] ?? true));
                        }
                    }
                @endphp

                @if (! empty($socialLinks))
                    <div class="pt-2">
                        <div class="text-[11px] font-bold uppercase tracking-wider text-brand-accent mb-2">Connect With Us</div>
                        <div class="flex flex-wrap items-center gap-2">
                            @foreach ($socialLinks as $link)
                                @php
                                    $platform = strtolower($link['platform'] ?? 'globe');
                                    $label = $link['label'] ?? ucfirst($platform);
                                    $url = $link['url'] ?? '#';
                                    $iconName = match ($platform) {
                                        'facebook' => 'facebook',
                                        'linkedin' => 'linkedin',
                                        'youtube' => 'youtube',
                                        'instagram' => 'instagram',
                                        'twitter', 'x' => 'twitter',
                                        'whatsapp' => 'whatsapp',
                                        default => 'globe',
                                    };
                                @endphp
                                <a
                                    href="{{ $url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="{{ $label }}"
                                    title="{{ $label }}"
                                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 hover:bg-brand-accent hover:text-brand-primary text-brand-accent hover:border-brand-accent transition-all duration-200 border border-white/15 shadow-2xs hover:scale-110 active:scale-95 group cursor-pointer"
                                >
                                    <x-icon :name="$iconName" class="w-4 h-4 shrink-0 transition-colors" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.08em] text-brand-accent mb-4">Quick Links</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Products Catalog</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition-colors">Deployments Gallery</a></li>
                    <li><a href="{{ route('company.profile') }}" class="hover:text-white transition-colors">Company Profile</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="hover:text-white transition-colors">Portfolio &amp; Cases</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-white transition-colors">Contact &amp; Quotes</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.08em] text-brand-accent mb-4">Solutions</h3>
                <ul class="space-y-2.5 text-sm">
                    @foreach ($navCategories->take(5) as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="hover:text-white transition-colors">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold uppercase tracking-[0.08em] text-brand-accent mb-4">Corporate Helplines</h3>
                <ul class="space-y-3 text-sm text-white/80">
                    <li class="flex items-start gap-2.5">
                        <x-icon name="headphones" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" />
                        <div>
                            <div class="text-[11px] text-emerald-300 font-semibold uppercase tracking-wider">24/7 Technical Support</div>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $support247) }}" class="font-bold text-white hover:text-brand-accent transition-colors">
                                {{ $support247 }}
                            </a>
                        </div>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-icon name="phone" class="w-4 h-4 text-brand-accent shrink-0 mt-0.5" />
                        <div>
                            <div class="text-[11px] text-white/60 uppercase tracking-wider">Sales Hotline (9 AM – 6 PM)</div>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $businessHotline) }}" class="font-medium text-white hover:text-brand-accent transition-colors">
                                {{ $businessHotline }}
                            </a>
                        </div>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <x-icon name="mail" class="w-4 h-4 text-brand-accent shrink-0" />
                        <a href="mailto:{{ $email }}" class="hover:text-white transition-colors">{{ $email }}</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <x-icon name="map-pin" class="w-4 h-4 text-brand-accent shrink-0 mt-0.5" />
                        <span class="text-xs text-white/70">{{ $address }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/60">
            <p>&copy; {{ date('Y') }} {{ $companyName }} All rights reserved.</p>
            <p>B2B Hardware &amp; Systems Showcase</p>
        </div>
    </div>
</footer>
