@php
    $phone = $siteSettings['contact_hotline_business'] ?? ($siteSettings['contact_mobile'] ?? '+880 1712-806237');
    $telHref = 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
    $whatsappHref = $product->whatsappInquiryUrl($siteSettings['whatsapp_number'] ?? null);
    $galleryUrls = $product->gallery_urls;
    $keyFeatures = is_array($product->key_features) ? array_values(array_filter($product->key_features)) : [];
    $specifications = is_array($product->specifications) ? array_values(array_filter($product->specifications, fn ($row): bool => ! empty($row['label']) && ! empty($row['value']))) : [];
@endphp

<x-layouts.app :title="$product->name" :description="$product->short_description ?: $product->name" :image="$product->image_url">
    <section class="py-6 sm:py-10 bg-surface-canvas">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
            {{-- Breadcrumb --}}
            <nav class="flex flex-wrap items-center gap-1.5 sm:gap-2 text-xs text-ink-muted" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <x-icon name="chevron-right" class="w-3.5 h-3.5 shrink-0" />
                <a href="{{ route('products.index') }}" class="hover:text-brand-primary transition-colors">Products</a>
                @if ($product->category)
                    <x-icon name="chevron-right" class="w-3.5 h-3.5 shrink-0" />
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-brand-primary transition-colors">
                        {{ $product->category->name }}
                    </a>
                @endif
                <x-icon name="chevron-right" class="w-3.5 h-3.5 shrink-0" />
                <span class="text-ink-primary font-medium truncate">{{ $product->name }}</span>
            </nav>

            {{-- Primary 2-Column Product Showcase Card (Zero Add to Cart / Zero Order) --}}
            <div class="bg-white rounded-2xl border border-border-hairline p-4 sm:p-6 lg:p-8 shadow-(--shadow-card)">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-start">
                    {{-- Left Column: Wide, Uncropped Studio Image + Gallery Switcher --}}
                    <div class="lg:col-span-6 space-y-3" data-product-gallery>
                        <div class="w-full h-[320px] sm:h-[420px] lg:h-[480px] rounded-2xl bg-[#F8FAFC] border border-border-hairline p-4 sm:p-6 overflow-hidden flex items-center justify-center relative group">
                            @if (! empty($galleryUrls))
                                <img
                                    src="{{ $galleryUrls[0] }}"
                                    alt="{{ $product->name }}"
                                    data-gallery-main
                                    data-lightbox-src="{{ $galleryUrls[0] }}"
                                    data-lightbox-title="{{ $product->name }}"
                                    data-lightbox-sub="{{ $product->brand ? $product->brand . ' • ' : '' }}{{ $product->model_number ?: 'Enterprise Hardware' }}"
                                    class="max-w-full max-h-full w-auto h-auto mx-auto object-contain object-center rounded-lg cursor-zoom-in transition-all duration-200 group-hover:scale-[1.02]"
                                    title="Click to enlarge view"
                                />
                                <button
                                    type="button"
                                    data-lightbox-src="{{ $galleryUrls[0] }}"
                                    data-lightbox-title="{{ $product->name }}"
                                    data-lightbox-sub="{{ $product->brand ? $product->brand . ' • ' : '' }}{{ $product->model_number ?: 'Enterprise Hardware' }}"
                                    class="absolute bottom-3 right-3 sm:bottom-4 sm:right-4 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black/75 hover:bg-black text-white text-xs font-semibold shadow-md backdrop-blur-xs transition-opacity opacity-90 sm:opacity-0 group-hover:opacity-100 cursor-pointer"
                                    title="Click to enlarge full view"
                                >
                                    <x-icon name="maximize" class="w-3.5 h-3.5" />
                                    <span>Enlarge View</span>
                                </button>
                            @else
                                <x-icon name="package" class="w-16 h-16 text-brand-primary/40" />
                            @endif
                        </div>

                        @if (count($galleryUrls) > 1)
                            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2.5">
                                @foreach ($galleryUrls as $index => $imageUrl)
                                    <button
                                        type="button"
                                        data-gallery-thumb="{{ $imageUrl }}"
                                        aria-label="View product image {{ $index + 1 }}"
                                        class="aspect-[4/3] rounded-xl overflow-hidden border-2 p-1.5 transition-all cursor-pointer bg-white flex items-center justify-center {{ $index === 0 ? 'border-brand-primary ring-2 ring-brand-primary/15' : 'border-border-hairline hover:border-brand-primary/40' }}"
                                    >
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }} view {{ $index + 1 }}" class="max-w-full max-h-full w-auto h-auto object-contain object-center" />
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Right Column: Brand, Title, Highlights, Direct Phone & WhatsApp Inquiry --}}
                    <div class="lg:col-span-6 space-y-5">
                        <div>
                            {{-- Brand + Official Link + Category --}}
                            <div class="flex flex-wrap items-center gap-2.5 text-xs">
                                @if ($product->brand)
                                    <span class="font-semibold uppercase tracking-wider text-brand-primary">
                                        {{ $product->brand }}
                                    </span>
                                @endif

                                @if ($product->brand_url)
                                    <a
                                        href="{{ $product->brand_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-1 text-brand-primary/80 hover:text-brand-primary hover:underline"
                                    >
                                        <span>{{ $product->brand ? $product->brand . ' official site' : 'Brand site' }}</span>
                                        <x-icon name="external-link" class="w-3 h-3" />
                                    </a>
                                @endif

                                @if ($product->category)
                                    <span class="text-border-hairline" aria-hidden="true">•</span>
                                    <a
                                        href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-subtle text-ink-secondary hover:bg-brand-primary-soft hover:text-brand-primary transition-colors font-medium"
                                    >
                                        {{ $product->category->name }}
                                    </a>
                                @endif
                            </div>

                            <h1 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight text-ink-primary leading-tight">
                                {{ $product->name }}
                            </h1>

                            {{-- Availability & Model / SKU Badges --}}
                            <div class="mt-3 flex flex-wrap items-center gap-2.5 text-xs">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md border font-semibold {{ $product->availability_classes }}">
                                    {{ $product->availability_label }}
                                </span>

                                @if ($product->model_number)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-surface-subtle text-ink-secondary font-medium">
                                        Model: <strong class="text-ink-primary font-semibold">{{ $product->model_number }}</strong>
                                    </span>
                                @endif

                                @if ($product->sku)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-surface-subtle text-ink-secondary font-medium">
                                        SKU: <strong class="text-ink-primary font-semibold">{{ $product->sku }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Short Description (if provided) --}}
                        @if ($product->short_description)
                            <p class="text-xs sm:text-sm text-ink-secondary leading-relaxed">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        {{-- Key Features (2-Column Checkmark Grid) --}}
                        @if (! empty($keyFeatures))
                            <div>
                                <h2 class="text-xs font-semibold uppercase tracking-[0.08em] text-ink-muted">
                                    Key Features
                                </h2>
                                <ul class="mt-2.5 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2">
                                    @foreach ($keyFeatures as $feature)
                                        <li class="flex items-start gap-2 text-xs sm:text-sm text-ink-primary">
                                            <x-icon name="check" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Direct Inquire Action Hub: WhatsApp + Direct Phone Call + Formal Quote (Zero Cart) --}}
                        <div class="space-y-2.5 pt-1">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @if ($whatsappHref)
                                    <a
                                        href="{{ $whatsappHref }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold shadow-xs transition-all duration-200 hover:-translate-y-0.5"
                                    >
                                        <x-icon name="message-circle" class="w-4 h-4" />
                                        <span>Inquire on WhatsApp</span>
                                    </a>
                                @endif

                                <a
                                    href="{{ $telHref }}"
                                    class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl border border-brand-primary/30 bg-white hover:bg-brand-primary-soft/60 text-brand-primary text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5"
                                >
                                    <x-icon name="phone" class="w-4 h-4 text-brand-accent" />
                                    <span>Call {{ $phone }}</span>
                                </a>
                            </div>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <x-ui.button :href="route('contact.index', ['product' => $product->slug])" variant="primary" size="lg" class="flex-1 h-11">
                                    <span>Request Official Quotation</span>
                                    <x-icon name="arrow-up-right" class="w-4 h-4 text-brand-accent" />
                                </x-ui.button>

                                @if ($product->datasheet_url)
                                    <a
                                        href="{{ $product->datasheet_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-4 rounded-lg border border-border-hairline bg-surface-subtle/60 hover:bg-white hover:border-brand-primary/35 text-xs sm:text-sm font-medium text-ink-primary transition-colors"
                                    >
                                        <x-icon name="file-text" class="w-4 h-4 text-brand-primary" />
                                        <span>Datasheet</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Social Media & Direct Share Hub --}}
                        @php
                            $currentUrl = url()->current();
                            $shareTitle = $product->name . ' — ' . ($product->brand ?: 'ProudRock Ltd.');
                            $shareEncodedUrl = urlencode($currentUrl);
                            $shareEncodedTitle = urlencode($shareTitle . ' | B2B Hardware & Enterprise Solutions: ');
                        @endphp
                        <div class="pt-3 border-t border-border-hairline/80 space-y-2.5" data-social-share-container>
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-ink-primary flex items-center gap-1.5 uppercase tracking-wider text-[11px]">
                                    <x-icon name="share-2" class="w-3.5 h-3.5 text-brand-primary" />
                                    <span>Share Product</span>
                                </span>
                                <span class="text-[11px] text-ink-muted">Share specifications with team &amp; procurement</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-2">
                                {{-- WhatsApp --}}
                                <a
                                    href="https://api.whatsapp.com/send?text={{ $shareEncodedTitle }}{{ $shareEncodedUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs font-semibold transition-colors"
                                    title="Share on WhatsApp"
                                >
                                    <x-icon name="message-circle" class="w-3.5 h-3.5 text-emerald-600" />
                                    <span>WhatsApp</span>
                                </a>

                                {{-- LinkedIn --}}
                                <a
                                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareEncodedUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-900 border border-blue-200 text-xs font-semibold transition-colors"
                                    title="Share on LinkedIn"
                                >
                                    <x-icon name="linkedin" class="w-3.5 h-3.5 text-blue-700" />
                                    <span>LinkedIn</span>
                                </a>

                                {{-- Facebook --}}
                                <a
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ $shareEncodedUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-900 border border-indigo-200 text-xs font-semibold transition-colors"
                                    title="Share on Facebook"
                                >
                                    <x-icon name="facebook" class="w-3.5 h-3.5 text-indigo-700" />
                                    <span>Facebook</span>
                                </a>

                                {{-- Twitter / X --}}
                                <a
                                    href="https://twitter.com/intent/tweet?text={{ $shareEncodedTitle }}&url={{ $shareEncodedUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-900 border border-slate-200 text-xs font-semibold transition-colors"
                                    title="Share on X"
                                >
                                    <x-icon name="twitter" class="w-3.5 h-3.5 text-slate-700" />
                                    <span>X</span>
                                </a>

                                {{-- Email --}}
                                <a
                                    href="mailto:?subject={{ rawurlencode('Inquiry for ' . $product->name) }}&body={{ rawurlencode("Hello,\n\nPlease review the specifications for this hardware:\n" . $product->name . "\n" . $currentUrl) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-surface-canvas text-ink-primary border border-border-hairline text-xs font-medium transition-colors"
                                    title="Email product link"
                                >
                                    <x-icon name="mail" class="w-3.5 h-3.5 text-ink-secondary" />
                                    <span>Email</span>
                                </a>

                                {{-- 1-Click Copy Link Button --}}
                                <button
                                    type="button"
                                    id="copy-product-link-btn"
                                    data-url="{{ $currentUrl }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-subtle hover:bg-white hover:border-brand-primary text-ink-primary border border-border-hairline text-xs font-semibold transition-colors cursor-pointer"
                                    title="Copy link to clipboard"
                                >
                                    <x-icon name="copy" class="w-3.5 h-3.5 text-brand-primary" />
                                    <span id="copy-btn-text">Copy Link</span>
                                </button>
                            </div>
                        </div>

                        <script>
                            (function() {
                                const btn = document.getElementById('copy-product-link-btn');
                                const textSpan = document.getElementById('copy-btn-text');
                                if (!btn || !textSpan) return;

                                btn.addEventListener('click', async function() {
                                    const url = btn.getAttribute('data-url') || window.location.href;
                                    try {
                                        if (navigator.clipboard && window.isSecureContext) {
                                            await navigator.clipboard.writeText(url);
                                        } else {
                                            const textarea = document.createElement('textarea');
                                            textarea.value = url;
                                            document.body.appendChild(textarea);
                                            textarea.select();
                                            document.execCommand('copy');
                                            document.body.removeChild(textarea);
                                        }
                                        textSpan.textContent = 'Link Copied!';
                                        btn.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
                                        setTimeout(() => {
                                            textSpan.textContent = 'Copy Link';
                                            btn.classList.remove('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
                                        }, 2500);
                                    } catch (err) {
                                        console.error('Failed to copy', err);
                                    }
                                });
                            })();
                        </script>

                        {{-- Bottom Trust Assurances --}}
                        <div class="pt-4 border-t border-border-hairline grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs text-ink-secondary">
                            <div class="flex items-center gap-2">
                                <x-icon name="shield-check" class="w-4 h-4 text-brand-primary shrink-0" />
                                <span>Genuine OEM Hardware</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-icon name="wrench" class="w-4 h-4 text-brand-primary shrink-0" />
                                <span>Local Warranty &amp; Service</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-icon name="truck" class="w-4 h-4 text-brand-primary shrink-0" />
                                <span>Delivery Across BD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Technical Specifications & Details Tabs (Dashboard Controlled) --}}
            @php
                $hasDetailsTab = ($product->show_details_tab ?? true) && ! empty(trim((string) $product->description));
                $hasSpecs = ! empty($specifications);
            @endphp

            @if ($hasSpecs || $hasDetailsTab)
                <div class="bg-white rounded-2xl border border-border-hairline overflow-hidden shadow-(--shadow-card)" data-tabs-container>
                    <div class="bg-surface-subtle/70 border-b border-border-hairline flex flex-wrap items-center justify-between gap-2">
                        @if ($hasSpecs && $hasDetailsTab)
                            {{-- Dual Tabs: Specifications & Details --}}
                            <div class="flex items-stretch" role="tablist" aria-label="Product Information Tabs">
                                <button
                                    type="button"
                                    role="tab"
                                    id="tab-btn-specs"
                                    data-tab-btn="specs"
                                    aria-selected="true"
                                    aria-controls="tab-panel-specs"
                                    class="px-6 sm:px-8 py-3.5 text-xs sm:text-sm font-bold transition-all cursor-pointer bg-brand-primary text-white shadow-xs"
                                >
                                    Specifications
                                </button>
                                <button
                                    type="button"
                                    role="tab"
                                    id="tab-btn-details"
                                    data-tab-btn="details"
                                    aria-selected="false"
                                    aria-controls="tab-panel-details"
                                    class="px-6 sm:px-8 py-3.5 text-xs sm:text-sm font-bold transition-all cursor-pointer bg-transparent text-ink-secondary hover:text-brand-primary hover:bg-white/80 border-l border-border-hairline"
                                >
                                    Details
                                </button>
                            </div>
                        @elseif ($hasSpecs)
                            <div class="px-5 sm:px-7 py-4">
                                <h2 class="text-base sm:text-lg font-semibold text-ink-primary">
                                    Specifications
                                </h2>
                            </div>
                        @else
                            <div class="px-5 sm:px-7 py-4">
                                <h2 class="text-base sm:text-lg font-semibold text-ink-primary">
                                    Details
                                </h2>
                            </div>
                        @endif

                        @if ($product->model_number)
                            <span class="text-xs font-medium text-ink-muted px-5 sm:px-7 py-2">
                                Model: {{ $product->model_number }}
                            </span>
                        @endif
                    </div>

                    {{-- Panel 1: Specifications Table --}}
                    @if ($hasSpecs)
                        <div id="tab-panel-specs" role="tabpanel" aria-labelledby="tab-btn-specs" class="p-4 sm:p-6">
                            <div class="rounded-xl border border-border-hairline overflow-hidden divide-y divide-border-hairline">
                                @foreach ($specifications as $row)
                                    <div class="grid grid-cols-1 sm:grid-cols-[220px_1fr] lg:grid-cols-[260px_1fr]">
                                        <div class="px-4 py-3 bg-surface-subtle/65 text-xs sm:text-sm font-medium text-ink-secondary">
                                            {{ $row['label'] }}
                                        </div>
                                        <div class="px-4 py-3 bg-white text-xs sm:text-sm text-ink-primary">
                                            {{ $row['value'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Panel 2: Details / Description --}}
                    @if ($hasDetailsTab)
                        <div id="tab-panel-details" role="tabpanel" aria-labelledby="tab-btn-details" class="{{ $hasSpecs ? 'hidden' : '' }} p-6 sm:p-8">
                            <div class="max-w-4xl space-y-4 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                    @endif
                </div>

                @if ($hasSpecs && $hasDetailsTab)
                    <script>
                        (function() {
                            const container = document.querySelector('[data-tabs-container]');
                            if (!container) return;

                            const btnSpecs = container.querySelector('[data-tab-btn="specs"]');
                            const btnDetails = container.querySelector('[data-tab-btn="details"]');
                            const panelSpecs = container.querySelector('#tab-panel-specs');
                            const panelDetails = container.querySelector('#tab-panel-details');

                            if (!btnSpecs || !btnDetails || !panelSpecs || !panelDetails) return;

                            function activateTab(tab) {
                                if (tab === 'specs') {
                                    panelSpecs.classList.remove('hidden');
                                    panelDetails.classList.add('hidden');

                                    btnSpecs.className = 'px-6 sm:px-8 py-3.5 text-xs sm:text-sm font-bold transition-all cursor-pointer bg-brand-primary text-white shadow-xs';
                                    btnSpecs.setAttribute('aria-selected', 'true');

                                    btnDetails.className = 'px-6 sm:px-8 py-3.5 text-xs sm:text-sm font-bold transition-all cursor-pointer bg-transparent text-ink-secondary hover:text-brand-primary hover:bg-white/80 border-l border-border-hairline';
                                    btnDetails.setAttribute('aria-selected', 'false');
                                } else {
                                    panelSpecs.classList.add('hidden');
                                    panelDetails.classList.remove('hidden');

                                    btnDetails.className = 'px-6 sm:px-8 py-3.5 text-xs sm:text-sm font-bold transition-all cursor-pointer bg-brand-primary text-white shadow-xs';
                                    btnDetails.setAttribute('aria-selected', 'true');

                                    btnSpecs.className = 'px-6 sm:px-8 py-3.5 text-xs sm:text-sm font-bold transition-all cursor-pointer bg-transparent text-ink-secondary hover:text-brand-primary hover:bg-white/80 border-r border-border-hairline';
                                    btnSpecs.setAttribute('aria-selected', 'false');
                                }
                            }

                            btnSpecs.addEventListener('click', () => activateTab('specs'));
                            btnDetails.addEventListener('click', () => activateTab('details'));
                        })();
                    </script>
                @endif
            @endif

            {{-- Interactive Flat Panel Solution & Room Sizing Guide (shown for IFPD products) --}}
            @if ($product->category && str_contains($product->category->slug, 'interactive'))
                <div class="pt-6 sm:pt-10 border-t border-border-hairline/80">
                    <x-interactive-panel-guide context="details" />
                </div>
            @endif

            {{-- Access Control & Biometrics Security Solution Banner (shown for access control products) --}}
            @if ($product->category && str_contains($product->category->slug, 'access-control'))
                <div class="pt-6 sm:pt-10 border-t border-border-hairline/80">
                    <x-access-control-banner context="details" />
                </div>
            @endif

            {{-- Related Products --}}
            @if ($relatedProducts->isNotEmpty())
                <div class="pt-4">
                    <div class="flex items-center justify-between gap-4 mb-5">
                        <h2 class="text-lg sm:text-xl font-bold tracking-tight text-ink-primary">
                            Related Products
                        </h2>
                        @if ($product->category)
                            <a
                                href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                                class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-brand-primary hover:underline"
                            >
                                <span>Explore {{ $product->category->name }}</span>
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">
                        @foreach ($relatedProducts as $related)
                            <x-product.card :product="$related" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
