@php
    $phone = $siteSettings['contact_phone'] ?? '+880 1712-806237';
    $mobile = $siteSettings['contact_mobile'] ?? '+880 1673-638094';
    $support247 = $siteSettings['contact_support_24_7'] ?? ($mobile ?: '+880 1673-638094');
    $businessHotline = $siteSettings['contact_hotline_business'] ?? ($phone ?: '+880 1712-806237');
    $supportHoursLabel = $siteSettings['support_hours_label'] ?? '24 Hours · 7 Days Continuous Emergency Helpline';
    $officeHoursLabel = $siteSettings['office_hours_label'] ?? 'Sat – Thu · 9:00 AM – 6:00 PM';
    $email = $siteSettings['contact_email'] ?? 'info@proudrock.com.bd';
    $address = $siteSettings['office_address'] ?? 'Dhaka, Bangladesh';
    $officeHours = $siteSettings['office_hours'] ?? 'Sat – Thu · 9:00 AM – 6:00 PM';
    $telSupportHref = 'tel:' . preg_replace('/[^0-9+]/', '', $support247);
    $telBusinessHref = 'tel:' . preg_replace('/[^0-9+]/', '', $businessHotline);
    $waRaw = preg_replace('/\D+/', '', (string) ($siteSettings['whatsapp_number'] ?? '8801712806237'));
    $waHref = $waRaw !== ''
        ? 'https://wa.me/' . $waRaw . '?text=' . rawurlencode($selectedProduct
            ? "Hello Proud Rock Limited, I want a corporate quote for {$selectedProduct->name}."
            : 'Hello Proud Rock Limited, I would like to inquire about enterprise hardware and automation.')
        : null;
@endphp

<x-layouts.app title="Contact & Quote" description="Contact Proud Rock Limited for corporate B2B hardware quotes, WhatsApp engineering support, or on-site surveys.">
    {{-- Page Header --}}
    <section class="bg-white border-b border-border-hairline py-8 sm:py-12">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 reveal-on-scroll">
            <nav class="flex items-center gap-2 text-xs text-ink-muted mb-3" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-ink-primary font-medium">Contact &amp; Quote</span>
            </nav>

            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-[0.08em]">
                <span class="h-1.5 w-1.5 rounded-full bg-brand-accent" aria-hidden="true"></span>
                <span>B2B Technical Sales</span>
            </span>

            <h1 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-ink-primary">
                Request an Official Corporate Quotation
            </h1>
            <p class="mt-2 max-w-2xl text-sm sm:text-base text-ink-secondary">
                No automated checkout clutter — reach our sales &amp; integration engineers directly by phone, WhatsApp, or official quote form.
            </p>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                {{-- Left Column: Direct Helpline & Corporate Office Details (50% equal width) --}}
                <div class="lg:col-span-6 space-y-6">
                    {{-- 24/7 Support Hotline Card --}}
                    <div class="reveal-on-scroll bg-brand-primary text-white rounded-2xl p-6 sm:p-7 shadow-(--shadow-card) space-y-4 pulse-glow-support">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-bold">
                                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>Active 24 Hours</span>
                            </span>
                            <span class="text-xs text-brand-accent font-semibold">Technical Support</span>
                        </div>

                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-white">
                                24/7 Technical Support Helpline
                            </h2>
                            <p class="mt-1 text-xs text-white/75 leading-relaxed">
                                {{ $supportHoursLabel }}. 24/7 round-the-clock emergency support for critical printhead, RFID portal, or biometric hardware breakdowns.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                            <a
                                href="{{ $telSupportHref }}"
                                class="inline-flex items-center justify-center gap-2.5 h-12 px-4 rounded-xl bg-white text-brand-primary text-sm font-bold shadow-md hover:bg-brand-accent transition-colors"
                            >
                                <x-icon name="phone" class="w-4 h-4 text-brand-primary" />
                                <span>Call 24/7 Helpline</span>
                            </a>

                            @if ($waHref)
                                <a
                                    href="{{ $waHref }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2.5 h-12 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold transition-colors"
                                >
                                    <x-icon name="message-circle" class="w-4 h-4" />
                                    <span>WhatsApp 24/7 Desk</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Corporate Office & Details --}}
                    <div class="reveal-on-scroll stagger-1 bg-white rounded-2xl border border-border-hairline p-6 sm:p-7 shadow-(--shadow-card) space-y-5">
                        <h2 class="text-lg font-bold text-ink-primary">
                            Corporate Office &amp; Direct Contact
                        </h2>

                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-3.5">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-primary-soft text-brand-primary">
                                    <x-icon name="headphones" class="w-4 h-4" />
                                </span>
                                <div>
                                    <div class="text-xs font-medium text-ink-muted">24/7 Helpline Number</div>
                                    <a href="{{ $telSupportHref }}" class="font-bold text-brand-primary hover:underline">{{ $support247 }}</a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-primary-soft text-brand-primary">
                                    <x-icon name="phone" class="w-4 h-4" />
                                </span>
                                <div>
                                    <div class="text-xs font-medium text-ink-muted">Sales Hotline</div>
                                    <a href="{{ $telBusinessHref }}" class="font-bold text-ink-primary hover:underline">{{ $businessHotline }}</a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-primary-soft text-brand-primary">
                                    <x-icon name="mail" class="w-4 h-4" />
                                </span>
                                <div>
                                    <div class="text-xs font-medium text-ink-muted">Corporate Email</div>
                                    <a href="mailto:{{ $email }}" class="font-medium text-brand-primary hover:underline">{{ $email }}</a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-primary-soft text-brand-primary">
                                    <x-icon name="map-pin" class="w-4 h-4" />
                                </span>
                                <div>
                                    <div class="text-xs font-medium text-ink-muted">Corporate Headquarters</div>
                                    <div class="font-medium text-ink-primary">{{ $address }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Validated DB-Backed Corporate Quotation Form (50% equal width) --}}
                <div class="lg:col-span-6">
                    <div class="reveal-on-scroll stagger-1 bg-white rounded-2xl border border-border-hairline p-6 sm:p-8 shadow-(--shadow-card)">
                        <h2 class="text-xl font-bold text-ink-primary">
                            Send Quotation or Site-Survey Request
                        </h2>
                        <p class="mt-1 text-xs sm:text-sm text-ink-secondary">
                            Fill in your organization details and hardware requirements—your inquiry goes straight to our Admin Desk.
                        </p>

                        @if (session('inquiry_submitted'))
                            <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 flex items-start gap-3 text-emerald-900">
                                <x-icon name="check-circle-2" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                                <div class="text-sm font-medium">{{ session('inquiry_submitted') }}</div>
                            </div>
                        @endif

                        @if ($selectedProduct)
                            <div class="mt-5 rounded-xl border border-brand-primary/20 bg-brand-primary-soft/50 p-3.5 flex items-center justify-between gap-3">
                                <div class="text-xs sm:text-sm">
                                    <span class="text-ink-secondary">Requesting quote for:</span>
                                    <strong class="text-brand-primary ml-1">{{ $selectedProduct->name }}</strong>
                                </div>
                                <a href="{{ route('products.show', $selectedProduct->slug) }}" class="text-xs font-semibold text-brand-primary hover:underline shrink-0">
                                    View Specs
                                </a>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="mt-6 space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="inquiry_name" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                        Full Name <span class="text-rose-600">*</span>
                                    </label>
                                    <input
                                        id="inquiry_name"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        required
                                        placeholder="e.g. Tariqul Islam"
                                        class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                                    />
                                    @error('name')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="inquiry_company" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                        Company / Factory Name
                                    </label>
                                    <input
                                        id="inquiry_company"
                                        type="text"
                                        name="company_name"
                                        value="{{ old('company_name') }}"
                                        placeholder="e.g. Apex Knitwear Ltd."
                                        class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                                    />
                                    @error('company_name')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="inquiry_phone" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                        Phone / WhatsApp Number <span class="text-rose-600">*</span>
                                    </label>
                                    <input
                                        id="inquiry_phone"
                                        type="tel"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        required
                                        placeholder="+880 1XXX-XXXXXX"
                                        class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                                    />
                                    @error('phone')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="inquiry_email" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                        Corporate Email
                                    </label>
                                    <input
                                        id="inquiry_email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="procurement@company.com"
                                        class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                                    />
                                    @error('email')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="relative" id="hardware-dropdown-wrapper">
                                    <label for="inquiry_product_id" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                        Hardware / Solution of Interest
                                    </label>

                                    {{-- Native Select (Kept for standard POST submission & test assertions) --}}
                                    <select
                                        id="inquiry_product_id"
                                        name="product_id"
                                        class="sr-only"
                                        tabindex="-1"
                                        aria-hidden="true"
                                    >
                                        <option value="">General Project / Multiple Hardware</option>
                                        @if (isset($groupedProducts) && $groupedProducts->isNotEmpty())
                                            @foreach ($groupedProducts as $categoryName => $prods)
                                                <optgroup label="{{ $categoryName }}">
                                                    @foreach ($prods as $prod)
                                                        @php
                                                            $modelTag = $prod->model_number ? " [{$prod->model_number}]" : '';
                                                        @endphp
                                                        <option
                                                            value="{{ $prod->id }}"
                                                            @selected((int) old('product_id', $selectedProduct?->id) === $prod->id)
                                                        >
                                                            {{ $prod->name }}{{ $modelTag }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        @else
                                            @foreach ($products as $prod)
                                                <option
                                                    value="{{ $prod->id }}"
                                                    @selected((int) old('product_id', $selectedProduct?->id) === $prod->id)
                                                >
                                                    {{ $prod->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    {{-- Custom Trigger (Strictly contained within mobile & desktop width) --}}
                                    @php
                                        $selectedId = (int) old('product_id', $selectedProduct?->id);
                                        $initialProduct = null;
                                        if ($selectedId > 0 && isset($products)) {
                                            $initialProduct = $products->firstWhere('id', $selectedId);
                                        }
                                        $initialLabel = $initialProduct
                                            ? ($initialProduct->name . ($initialProduct->model_number ? " [{$initialProduct->model_number}]" : ''))
                                            : 'General Project / Multiple Hardware';
                                    @endphp
                                    <button
                                        type="button"
                                        id="hardware-dropdown-trigger"
                                        class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary flex items-center justify-between gap-2 text-left focus:border-brand-primary focus:bg-white focus:outline-none transition-colors cursor-pointer select-none"
                                        aria-haspopup="listbox"
                                        aria-expanded="false"
                                    >
                                        <span id="hardware-dropdown-label" class="truncate font-normal min-w-0 flex-1">
                                            {{ $initialLabel }}
                                        </span>
                                        <svg id="hardware-dropdown-chevron" class="w-4 h-4 text-ink-muted shrink-0 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    {{-- Floating Dropdown Menu (Guaranteed to stay within column and phone boundary) --}}
                                    <div
                                        id="hardware-dropdown-menu"
                                        class="hidden absolute left-0 right-0 top-full mt-1.5 z-50 max-h-60 overflow-y-auto rounded-xl border border-border-hairline bg-white shadow-xl py-1 text-xs divide-y divide-border-hairline/60"
                                        role="listbox"
                                    >
                                        <div class="p-1">
                                            <button
                                                type="button"
                                                class="hardware-dropdown-item w-full px-3 py-2 rounded-lg text-left font-medium transition-colors flex items-center justify-between gap-2 cursor-pointer hover:bg-brand-primary-soft hover:text-brand-primary {{ empty($selectedId) ? 'bg-brand-primary-soft/60 text-brand-primary font-bold' : 'text-ink-primary' }}"
                                                data-value=""
                                                data-label="General Project / Multiple Hardware"
                                            >
                                                <span class="truncate">General Project / Multiple Hardware</span>
                                                <span class="hardware-check {{ empty($selectedId) ? '' : 'hidden' }} text-brand-primary font-bold shrink-0">✓</span>
                                            </button>
                                        </div>

                                        @if (isset($groupedProducts) && $groupedProducts->isNotEmpty())
                                            @foreach ($groupedProducts as $categoryName => $prods)
                                                <div class="p-1">
                                                    <div class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-ink-muted bg-surface-subtle/80 rounded-md my-0.5">
                                                        {{ $categoryName }}
                                                    </div>
                                                    @foreach ($prods as $prod)
                                                        @php
                                                            $isSelected = $selectedId === $prod->id;
                                                            $displayName = $prod->name . ($prod->model_number ? " [{$prod->model_number}]" : '');
                                                        @endphp
                                                        <button
                                                            type="button"
                                                            class="hardware-dropdown-item w-full px-3 py-2 rounded-lg text-left transition-colors flex items-center justify-between gap-2 cursor-pointer hover:bg-brand-primary-soft hover:text-brand-primary {{ $isSelected ? 'bg-brand-primary-soft/60 text-brand-primary font-bold' : 'text-ink-primary' }}"
                                                            data-value="{{ $prod->id }}"
                                                            data-label="{{ $displayName }}"
                                                        >
                                                            <span class="truncate" title="{{ $displayName }}">{{ $displayName }}</span>
                                                            <span class="hardware-check {{ $isSelected ? '' : 'hidden' }} text-brand-primary font-bold shrink-0">✓</span>
                                                        </button>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-1">
                                                @foreach ($products as $prod)
                                                    @php
                                                        $isSelected = $selectedId === $prod->id;
                                                    @endphp
                                                    <button
                                                        type="button"
                                                        class="hardware-dropdown-item w-full px-3 py-2 rounded-lg text-left transition-colors flex items-center justify-between gap-2 cursor-pointer hover:bg-brand-primary-soft hover:text-brand-primary {{ $isSelected ? 'bg-brand-primary-soft/60 text-brand-primary font-bold' : 'text-ink-primary' }}"
                                                        data-value="{{ $prod->id }}"
                                                        data-label="{{ $prod->name }}"
                                                    >
                                                        <span class="truncate" title="{{ $prod->name }}">{{ $prod->name }}</span>
                                                        <span class="hardware-check {{ $isSelected ? '' : 'hidden' }} text-brand-primary font-bold shrink-0">✓</span>
                                                    </button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    @error('product_id')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="inquiry_subject" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                        Subject
                                    </label>
                                    <input
                                        id="inquiry_subject"
                                        type="text"
                                        name="subject"
                                        value="{{ old('subject', $prefillSubject) }}"
                                        placeholder="e.g. Bulk RFID Reader Quote"
                                        class="w-full h-11 px-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                                    />
                                    @error('subject')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="inquiry_message" class="block text-xs font-semibold text-ink-primary mb-1.5">
                                    Project Scope, Quantity &amp; Site Location <span class="text-rose-600">*</span>
                                </label>
                                <textarea
                                    id="inquiry_message"
                                    name="message"
                                    rows="4"
                                    required
                                    placeholder="Share required unit quantity, factory/office location, and whether on-site installation or AMC is needed..."
                                    class="w-full p-3.5 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-1">
                                <x-ui.button type="submit" variant="primary" size="lg" class="w-full sm:w-auto h-12 px-7">
                                    <x-icon name="send" class="w-4 h-4 text-brand-accent" />
                                    <span>Submit Quotation Request</span>
                                </x-ui.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Custom Mobile-Safe Dropdown Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('hardware-dropdown-wrapper');
            if (!wrapper) return;

            const trigger = document.getElementById('hardware-dropdown-trigger');
            const menu = document.getElementById('hardware-dropdown-menu');
            const label = document.getElementById('hardware-dropdown-label');
            const chevron = document.getElementById('hardware-dropdown-chevron');
            const select = document.getElementById('inquiry_product_id');
            const items = menu.querySelectorAll('.hardware-dropdown-item');

            function toggleMenu(show) {
                const isHidden = menu.classList.contains('hidden');
                const willShow = typeof show === 'boolean' ? show : isHidden;
                if (willShow) {
                    menu.classList.remove('hidden');
                    trigger.setAttribute('aria-expanded', 'true');
                    if (chevron) chevron.classList.add('rotate-180');
                } else {
                    menu.classList.add('hidden');
                    trigger.setAttribute('aria-expanded', 'false');
                    if (chevron) chevron.classList.remove('rotate-180');
                }
            }

            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMenu();
            });

            items.forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const val = btn.getAttribute('data-value') || '';
                    const text = btn.getAttribute('data-label') || 'General Project / Multiple Hardware';

                    label.textContent = text;
                    select.value = val;
                    select.dispatchEvent(new Event('change', { bubbles: true }));

                    items.forEach(function (other) {
                        const check = other.querySelector('.hardware-check');
                        if (other === btn) {
                            other.classList.add('bg-brand-primary-soft/60', 'text-brand-primary', 'font-bold');
                            if (check) check.classList.remove('hidden');
                        } else {
                            other.classList.remove('bg-brand-primary-soft/60', 'text-brand-primary', 'font-bold');
                            if (check) check.classList.add('hidden');
                        }
                    });

                    toggleMenu(false);
                    trigger.focus();
                });
            });

            document.addEventListener('click', function (e) {
                if (!wrapper.contains(e.target)) {
                    toggleMenu(false);
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                    toggleMenu(false);
                    trigger.focus();
                }
            });
        });
    </script>
</x-layouts.app>