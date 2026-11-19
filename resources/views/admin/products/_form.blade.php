<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start pb-20 lg:pb-0">
    {{-- LEFT COLUMN (8 Columns): Primary Information & Technical Details --}}
    <div class="lg:col-span-8 space-y-6">
        {{-- Card 1: Basic Information --}}
        <div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-5">
            <div class="flex items-center gap-2 border-b border-border-hairline pb-3">
                <x-icon name="package" class="w-4 h-4 text-brand-primary" />
                <h3 class="text-xs font-bold uppercase tracking-wider text-ink-primary">Basic Product Information</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Product Title --}}
                <div class="md:col-span-2">
                    <label for="name" class="block text-xs font-bold text-ink-primary mb-1">Product Title *</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $product->name) }}"
                        required
                        placeholder="e.g. Zebra ZT411 Industrial Barcode Printer"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                    />
                </div>

                {{-- Category Selection & On-the-fly Category Addition --}}
                <div class="md:col-span-2 p-4 rounded-xl bg-surface-canvas border border-border-hairline space-y-3">
                    <div class="flex items-center justify-between">
                        <label for="category_id" class="block text-xs font-bold text-ink-primary">
                            Hardware Category *
                        </label>
                        <span class="text-[11px] text-ink-muted">Choose from list or type a new one below</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-center">
                        <div>
                            <select
                                name="category_id"
                                id="category_id"
                                class="w-full rounded-xl border border-border-hairline bg-white px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                            >
                                <option value="">— Select Existing Category —</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Or Type New Category --}}
                        <div>
                            <input
                                type="text"
                                name="new_category_name"
                                id="new_category_name"
                                value="{{ old('new_category_name') }}"
                                placeholder="+ বা নতুন ক্যাটাগরির নাম লিখুন..."
                                class="w-full rounded-xl border border-dashed border-brand-primary/40 bg-white px-3.5 py-2 text-xs text-brand-primary placeholder:text-ink-muted focus:outline-none focus:border-brand-primary focus:border-solid focus:ring-1 focus:ring-brand-primary"
                            />
                        </div>
                    </div>
                    <p class="text-[11px] text-ink-muted">
                        💡 <strong>টিপস:</strong> উপরের লিস্টে ক্যাটাগরি না পেলে ডানপাশের বক্সে যেকোনো নতুন ক্যাটাগরির নাম লিখলে সেটি স্বয়ংক্রিয়ভাবে তৈরি হয়ে যাবে।
                    </p>
                </div>

                {{-- Brand Name --}}
                <div>
                    <label for="brand" class="block text-xs font-bold text-ink-primary mb-1">Brand Name</label>
                    <input
                        type="text"
                        name="brand"
                        id="brand"
                        value="{{ old('brand', $product->brand) }}"
                        placeholder="e.g. Zebra, TSC, FingerTec, Chainway"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                    />
                </div>

                {{-- Brand Official Website URL (with clear helper text) --}}
                <div>
                    <label for="brand_url" class="block text-xs font-bold text-ink-primary mb-1">
                        Brand Official Website (Optional)
                    </label>
                    <input
                        type="url"
                        name="brand_url"
                        id="brand_url"
                        value="{{ old('brand_url', $product->brand_url) }}"
                        placeholder="https://www.zebra.com"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                    />
                    <p class="text-[10px] text-ink-muted mt-1">
                        গ্লোবাল ম্যানুফ্যাকচারার কোম্পানির নিজস্ব ওয়েবসাইট (যেমন: https://www.zebra.com)। না থাকলে খালি রাখুন।
                    </p>
                </div>

                {{-- Model Number --}}
                <div>
                    <label for="model_number" class="block text-xs font-bold text-ink-primary mb-1">Model Number</label>
                    <input
                        type="text"
                        name="model_number"
                        id="model_number"
                        value="{{ old('model_number', $product->model_number) }}"
                        placeholder="e.g. ZT411"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                    />
                </div>

                {{-- SKU --}}
                <div>
                    <label for="sku" class="block text-xs font-bold text-ink-primary mb-1">SKU Code</label>
                    <input
                        type="text"
                        name="sku"
                        id="sku"
                        value="{{ old('sku', $product->sku) }}"
                        placeholder="e.g. PR-ZB-ZT411"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                    />
                </div>

                {{-- URL Slug --}}
                <div>
                    <label for="slug" class="block text-xs font-bold text-ink-primary mb-1">URL Slug</label>
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug', $product->slug) }}"
                        placeholder="e.g. zebra-zt411-industrial-barcode-printer"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary font-mono"
                    />
                    <p class="text-[10px] text-ink-muted mt-0.5">খালি রাখলে টাইটেল অনুযায়ী অটোমেটিক তৈরি হবে।</p>
                </div>

                {{-- Availability Status --}}
                <div>
                    <label for="availability_status" class="block text-xs font-bold text-ink-primary mb-1">Stock Availability *</label>
                    <select
                        name="availability_status"
                        id="availability_status"
                        required
                        class="w-full rounded-xl border border-border-hairline px-3 py-2 text-xs focus:outline-none focus:border-brand-primary"
                    >
                        <option value="in_stock" @selected(old('availability_status', $product->availability_status) === 'in_stock')>🟢 In Stock (Ready for Dispatch)</option>
                        <option value="on_request" @selected(old('availability_status', $product->availability_status) === 'on_request')>🔵 On Request (Project Import / Lead Time)</option>
                        <option value="discontinued" @selected(old('availability_status', $product->availability_status) === 'discontinued')>⚪ Discontinued</option>
                    </select>
                </div>

                {{-- Sort Order --}}
                <div>
                    <label for="sort_order" class="block text-xs font-bold text-ink-primary mb-1">Display Sort Order</label>
                    <input
                        type="number"
                        name="sort_order"
                        id="sort_order"
                        min="0"
                        value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                        class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                    />
                </div>
            </div>
        </div>

        {{-- Card 2: Features & Descriptions --}}
        <div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-4">
            <div class="flex items-center gap-2 border-b border-border-hairline pb-3">
                <x-icon name="sliders-horizontal" class="w-4 h-4 text-brand-primary" />
                <h3 class="text-xs font-bold uppercase tracking-wider text-ink-primary">Features &amp; Technical Specifications</h3>
            </div>

            {{-- Key Features text area --}}
            <div>
                @php
                    $featuresText = old('key_features_text', is_array($product->key_features) ? implode("\n", $product->key_features) : '');
                @endphp
                <label for="key_features_text" class="block text-xs font-bold text-ink-primary mb-1">
                    Key Highlights (প্রতি লাইনে একটি করে ফিচার লিখুন)
                </label>
                <textarea
                    name="key_features_text"
                    id="key_features_text"
                    rows="4"
                    placeholder="Print width: 4.09 in./104 mm&#10;Print resolution: 203 dpi / 300 dpi&#10;Maximum speed: 14 ips/356 mm per second&#10;Construction: Metal frame and bi-fold metal media cover"
                    class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary font-mono"
                >{{ $featuresText }}</textarea>
                <p class="text-[10px] text-ink-muted mt-1">প্রোডাক্ট ডিটেইলস পেজের ডানপাশে বুলেট টিক পয়েন্ট আকারে প্রদর্শিত হবে।</p>
            </div>

            {{-- Specifications Table text area --}}
            <div>
                @php
                    $specsFormatted = '';
                    if (old('specifications_text') !== null) {
                        $specsFormatted = old('specifications_text');
                    } elseif (is_array($product->specifications)) {
                        $specLines = [];
                        foreach ($product->specifications as $row) {
                            if (is_array($row) && ! empty($row['label']) && ! empty($row['value'])) {
                                $specLines[] = $row['label'] . ': ' . $row['value'];
                            }
                        }
                        $specsFormatted = implode("\n", $specLines);
                    }
                @endphp
                <div class="flex items-center justify-between mb-1">
                    <label for="specifications_text" class="block text-xs font-bold text-ink-primary">
                        Specifications Table (প্রতি লাইনে একটি করে স্পেসিফিকেশন: Label: Value)
                    </label>
                    <span class="text-[11px] text-brand-primary font-semibold">Label: Value ফরম্যাটে লিখুন</span>
                </div>
                <textarea
                    name="specifications_text"
                    id="specifications_text"
                    rows="8"
                    placeholder="Display Size: 86 Inch&#10;Native Resolution: 4K UHD 3840x2160 pixels&#10;Panel Type: IPS&#10;Processor: Quad-core ARM Cortex-A73&#10;RAM: 8GB&#10;Storage: 128GB&#10;Operating System: Android 14.0&#10;Camera: 48MP Built-in&#10;Microphone: 8 Array Mic&#10;Warranty: 3 Years"
                    class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary font-mono"
                >{{ $specsFormatted }}</textarea>
                <p class="text-[10px] text-ink-muted mt-1">
                    💡 <strong>টিপস:</strong> আপনি Word/PDF ফাইল থেকে সরাসরি কপি-পেস্ট করতে পারেন (যেমন: <code>Display Size: 65 Inch</code> বা <code>Country Of Origin - China</code>)। এটি অটোমেটিকভাবে পাবলিক পেজের স্পেসিফিকেশন টেবিলে সুন্দর ২-কলাম আকারে সাজিয়ে প্রদর্শিত হবে।
                </p>
            </div>

            {{-- Short Description --}}
            <div>
                <label for="short_description" class="block text-xs font-bold text-ink-primary mb-1">Short Description (কার্ডে প্রদর্শিত সংক্ষিপ্ত বিবরণ)</label>
                <textarea
                    name="short_description"
                    id="short_description"
                    rows="2"
                    placeholder="Rugged metal-frame 4-inch industrial printer with color touch display for 24/7 manufacturing..."
                    class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary"
                >{{ old('short_description', $product->short_description) }}</textarea>
            </div>

            {{-- Detailed Technical Description --}}
            <div>
                <label for="description" class="block text-xs font-bold text-ink-primary mb-1">Full Technical Overview (Details)</label>
                <textarea
                    name="description"
                    id="description"
                    rows="6"
                    placeholder="বিস্তারিত ডেসক্রিপশন, কানেক্টিভিটি ইন্টারফেস (USB, Serial, Ethernet, Bluetooth), মেমোরি এবং ওয়ারেন্টি সংক্রান্ত তথ্য..."
                    class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary"
                >{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Toggle Details Tab On/Off --}}
            <div class="p-3.5 rounded-xl bg-surface-canvas border border-border-hairline">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="show_details_tab"
                        value="1"
                        @checked(old('show_details_tab', $product->show_details_tab ?? true))
                        class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4 mt-0.5"
                    />
                    <div>
                        <span class="block text-xs font-bold text-ink-primary">
                            Enable "Details" Tab on Public Product Page (Specifications এর পাশে Details অপশন অন/অফ)
                        </span>
                        <span class="block text-[11px] text-ink-muted leading-relaxed">
                            অন রাখলে এবং উপরের ডেসক্রিপশনে কিছু লিখলে পাবলিক পেজে Specifications এর পাশে "Details" ট্যাব প্রদর্শিত হবে। ডেসক্রিপশন না চাইলে বা এটি অফ রাখলে কেবল Specifications টেবিলটি থাকবে।
                        </span>
                    </div>
                </label>
            </div>

            {{-- Datasheet URL --}}
            <div>
                <label for="datasheet_url" class="block text-xs font-bold text-ink-primary mb-1">Datasheet PDF or External Specifications Link</label>
                <input
                    type="text"
                    name="datasheet_url"
                    id="datasheet_url"
                    value="{{ old('datasheet_url', $product->datasheet_url) }}"
                    placeholder="https://example.com/datasheets/zebra-zt411.pdf"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>
        </div>
    </div>

    {{-- RIGHT COLUMN (4 Columns): Publishing, Photo Upload & Guidelines --}}
    <div class="lg:col-span-4 space-y-6">
        {{-- Card 1: Save & Publishing Card --}}
        <div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-5">
            <div class="flex items-center gap-2 border-b border-border-hairline pb-3">
                <x-icon name="check-circle-2" class="w-4 h-4 text-brand-primary" />
                <h3 class="text-xs font-bold uppercase tracking-wider text-ink-primary">Publishing &amp; Status</h3>
            </div>

            <div class="space-y-3">
                <label class="flex items-start gap-3 p-3 rounded-xl border border-border-hairline bg-surface-canvas cursor-pointer hover:border-brand-primary/40 transition-colors">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', $product->is_active))
                        class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4 mt-0.5"
                    />
                    <div>
                        <span class="block text-xs font-bold text-ink-primary">Live on Public Website</span>
                        <span class="block text-[11px] text-ink-muted">প্রোডাক্টটি ওয়েবসাইটে সক্রিয় ও দৃশ্যমান থাকবে</span>
                    </div>
                </label>

                <label class="flex items-start gap-3 p-3 rounded-xl border border-border-hairline bg-surface-canvas cursor-pointer hover:border-brand-accent/40 transition-colors">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        @checked(old('is_featured', $product->is_featured))
                        class="rounded border-border-hairline text-brand-accent focus:ring-brand-accent h-4 w-4 mt-0.5"
                    />
                    <div>
                        <span class="block text-xs font-bold text-ink-primary">Feature on Homepage</span>
                        <span class="block text-[11px] text-ink-muted">হোমপেজের Featured Hardware গ্রিডে প্রদর্শন করবে</span>
                    </div>
                </label>
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary/95 transition-all shadow-md cursor-pointer flex items-center justify-center gap-2"
            >
                <x-icon name="check" class="w-4 h-4 text-brand-accent" />
                <span>{{ $product->exists ? 'Save Product Changes' : 'Create & Publish Product' }}</span>
            </button>

            <div class="flex items-center justify-between pt-2 text-xs">
                <a
                    href="{{ route('admin.products.index') }}"
                    class="text-ink-muted hover:text-ink-primary font-medium"
                >
                    Cancel
                </a>

                @if ($product->exists)
                    <a
                        href="{{ route('products.show', $product->slug) }}"
                        target="_blank"
                        class="inline-flex items-center gap-1 text-brand-primary hover:underline font-semibold"
                    >
                        <span>View Public Page</span>
                        <x-icon name="external-link" class="w-3 h-3" />
                    </a>
                @endif
            </div>
        </div>

        {{-- Card 2: Hardware Photography & Instant Live Preview --}}
        <div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-4">
            <div class="flex items-center gap-2 border-b border-border-hairline pb-3">
                <x-icon name="image" class="w-4 h-4 text-brand-primary" />
                <h3 class="text-xs font-bold uppercase tracking-wider text-ink-primary">Hardware Photography</h3>
            </div>

            {{-- Live Visual Preview Box --}}
            <div>
                <span class="block text-[11px] font-bold text-ink-muted uppercase mb-1.5">Live Image Preview</span>
                <div class="relative w-full aspect-[4/3] rounded-xl border border-border-hairline bg-surface-subtle p-3 flex items-center justify-center overflow-hidden">
                    @php
                        $hasImage = !empty($product->image_url);
                        $previewUrl = $product->image_url ?: '';
                    @endphp

                    <img
                        id="live-preview-img"
                        src="{{ $previewUrl }}"
                        alt="Product Preview"
                        data-lightbox-src="{{ $previewUrl }}"
                        data-lightbox-title="{{ $product->name ?: 'Hardware Image Preview' }}"
                        class="h-full w-full object-contain cursor-zoom-in hover:scale-105 transition-transform {{ $hasImage ? '' : 'hidden' }}"
                        title="Click to view full size popup"
                    />

                    <div id="live-preview-placeholder" class="text-center p-4 text-ink-muted {{ $hasImage ? 'hidden' : '' }}">
                        <x-icon name="image" class="w-10 h-10 mx-auto text-ink-muted/40 mb-1" />
                        <span class="text-xs">No image selected</span>
                    </div>
                </div>
            </div>

            {{-- Upload File --}}
            <div>
                <label for="image_file" class="block text-xs font-bold text-ink-primary mb-1">
                    Upload Image File
                </label>
                <input
                    type="file"
                    name="image_file"
                    id="image_file"
                    accept="image/*"
                    class="w-full text-xs text-ink-secondary file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary-soft file:text-brand-primary hover:file:bg-brand-primary/10 cursor-pointer"
                />
                <p class="text-[10px] text-ink-muted mt-1">PNG, JPG, WebP (Max 4MB). কম্পিউটার থেকে সরাসরি সিলেক্ট করুন।</p>
            </div>

            {{-- Manual Image Path --}}
            <div>
                <label for="image" class="block text-xs font-bold text-ink-primary mb-1">
                    Or Direct Image Path / External URL
                </label>
                <input
                    type="text"
                    name="image"
                    id="image"
                    value="{{ old('image', $product->image) }}"
                    placeholder="e.g. images/products/product-1.jpg"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary font-mono text-[11px]"
                />
            </div>

            {{-- Multiple Gallery Upload (3, 4 or more photos) --}}
            <div class="pt-4 border-t border-border-hairline space-y-3">
                <div class="flex items-center justify-between">
                    <label for="gallery_files" class="block text-xs font-bold text-ink-primary">
                        Additional Gallery Photos (৩-৪টি অতিরিক্ত ছবি)
                    </label>
                    <span class="text-[10px] text-ink-muted">একাধিক ছবি একবারে সিলেক্ট করুন</span>
                </div>

                <input
                    type="file"
                    name="gallery_files[]"
                    id="gallery_files"
                    multiple
                    accept="image/*"
                    class="w-full text-xs text-ink-secondary file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary-soft file:text-brand-primary hover:file:bg-brand-primary/10 cursor-pointer"
                />

                {{-- Existing Gallery Thumbnails --}}
                @php
                    $existingGallery = is_array($product->gallery) ? array_values(array_filter($product->gallery)) : [];
                    $galleryText = old('gallery_urls_text', implode("\n", $existingGallery));
                @endphp

                @if (! empty($existingGallery))
                    <div class="space-y-1.5 pt-1">
                        <span class="text-[11px] font-bold text-ink-secondary block">বর্তমান গ্যালারি ছবিসমূহ ({{ count($existingGallery) }}টি):</span>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach ($existingGallery as $gItem)
                                @php
                                    $gUrl = \App\Models\Product::resolveMediaUrl($gItem);
                                @endphp
                                <div class="aspect-[4/3] rounded-lg border border-border-hairline p-1 bg-surface-subtle overflow-hidden relative group">
                                    <img src="{{ $gUrl }}" alt="Gallery view" class="w-full h-full object-contain" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Gallery Paths/URLs Textarea for fine-tuning --}}
                <div>
                    <label for="gallery_urls_text" class="block text-[11px] font-semibold text-ink-secondary mb-1">
                        Gallery Paths (প্রতি লাইনে একটি ছবির পাথ বা লিংক)
                    </label>
                    <textarea
                        name="gallery_urls_text"
                        id="gallery_urls_text"
                        rows="3"
                        placeholder="storage/products/view-1.jpg&#10;storage/products/view-2.jpg"
                        class="w-full rounded-xl border border-border-hairline p-2.5 text-[11px] leading-relaxed focus:outline-none focus:border-brand-primary font-mono"
                    >{{ $galleryText }}</textarea>
                    <p class="text-[10px] text-ink-muted mt-0.5">নতুন ছবি আপলোড করলে তা স্বয়ংক্রিয়ভাবে গ্যালারিতে যোগ হয়ে যাবে।</p>
                </div>
            </div>
        </div>

        {{-- Card 3: Quick Guidelines --}}
        <div class="rounded-2xl border border-border-hairline bg-surface-canvas p-5 text-xs text-ink-secondary space-y-2.5">
            <h4 class="font-bold text-ink-primary flex items-center gap-1.5">
                <x-icon name="alert-circle" class="w-4 h-4 text-brand-primary" />
                <span>প্রয়োজনীয় গাইডলাইন</span>
            </h4>
            <ul class="list-disc pl-4 space-y-1 text-[11px] text-ink-secondary leading-relaxed">
                <li><strong>Brand Official Website:</strong> এটি কেবল মূল ম্যানুফ্যাকচারার কোম্পানির নিজস্ব ওয়েবসাইট (যেমন: Zebra.com)। আপনার ওয়েবসাইটের লিংক এখানে দেওয়ার দরকার নেই।</li>
                <li><strong>ক্যাটাগরি যুক্ত করা:</strong> আপনি যেকোনো নতুন ক্যাটাগরি সরাসরি টাইপ করতে পারেন, আলাদা করে ক্যাটাগরি পেজে যাওয়ার প্রয়োজন নেই।</li>
                <li><strong>ছবি সেভ হওয়া:</strong> ছবি আপলোড করলে তা স্বয়ংক্রিয়ভাবে সরাসরি সাইটে যুক্ত হবে।</li>
            </ul>
        </div>
    </div>
</div>

{{-- Mobile Sticky Bottom Save Bar --}}
<div class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-border-hairline px-4 py-3 shadow-xl flex items-center justify-between gap-3">
    <div class="flex items-center gap-2 min-w-0">
        <span class="h-2 w-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
        <span class="text-xs font-bold text-ink-primary truncate">{{ $product->exists ? 'Editing Product' : 'New Product' }}</span>
    </div>
    <button
        type="submit"
        class="shrink-0 px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white text-xs font-bold shadow-md flex items-center gap-2 cursor-pointer transition-all"
    >
        <x-icon name="check" class="w-4 h-4 text-brand-accent" />
        <span>{{ $product->exists ? 'Save Changes' : 'Create Product' }}</span>
    </button>
</div>

{{-- Instant JavaScript Live Image Preview Handler --}}
<script>
    (function() {
        const fileInput = document.getElementById('image_file');
        const textInput = document.getElementById('image');
        const previewImg = document.getElementById('live-preview-img');
        const placeholder = document.getElementById('live-preview-placeholder');

        function updatePreview(url) {
            if (url) {
                previewImg.src = url;
                previewImg.setAttribute('data-lightbox-src', url);
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                previewImg.src = '';
                previewImg.removeAttribute('data-lightbox-src');
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        }

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const objectUrl = URL.createObjectURL(e.target.files[0]);
                    updatePreview(objectUrl);
                }
            });
        }

        if (textInput) {
            textInput.addEventListener('input', function(e) {
                const val = e.target.value.trim();
                if (val && !fileInput.files.length) {
                    const finalUrl = val.startsWith('http') ? val : '/' + val.replace(/^\//, '');
                    updatePreview(finalUrl);
                }
            });
        }
    })();
</script>
