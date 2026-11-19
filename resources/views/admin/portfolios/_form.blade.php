<div class="space-y-6">
    <div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-ink-muted">Case Study Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Title --}}
            <div class="md:col-span-2">
                <label for="title" class="block text-xs font-bold text-ink-primary mb-1">Deployment Project Title *</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $portfolio->title) }}"
                    required
                    placeholder="e.g. Automated UHF RFID Carton Verification Gates across 6 Loading Bays"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block text-xs font-bold text-ink-primary mb-1">URL Slug</label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old('slug', $portfolio->slug) }}"
                    placeholder="automated-uhf-rfid-carton-verification-gates"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            {{-- Client Name --}}
            <div>
                <label for="client_name" class="block text-xs font-bold text-ink-primary mb-1">Client / Factory Name *</label>
                <input
                    type="text"
                    name="client_name"
                    id="client_name"
                    value="{{ old('client_name', $portfolio->client_name) }}"
                    required
                    placeholder="e.g. Apex Export Knitwear Ltd."
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            {{-- Industry --}}
            <div>
                <label for="industry" class="block text-xs font-bold text-ink-primary mb-1">Industry Sector *</label>
                <input
                    type="text"
                    name="industry"
                    id="industry"
                    list="industry-options"
                    value="{{ old('industry', $portfolio->industry) }}"
                    required
                    placeholder="e.g. Corporate & Boardroom, Education & Smart Campus"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
                <datalist id="industry-options">
                    <option value="Corporate & Boardroom">Corporate &amp; Boardroom</option>
                    <option value="Corporate & Finance">Corporate &amp; Finance</option>
                    <option value="Architecture & Engineering">Architecture &amp; Engineering</option>
                    <option value="Education & Smart Campus">Education &amp; Smart Campus</option>
                    <option value="Garments & RMG">Garments &amp; RMG</option>
                    <option value="Warehousing & Logistics">Warehousing &amp; Logistics</option>
                    <option value="Retail & POS">Retail &amp; POS</option>
                    <option value="Corporate & Security">Corporate &amp; Security</option>
                    <option value="Hospital & Healthcare">Hospital &amp; Healthcare</option>
                    <option value="Bank & Corporate">Bank &amp; Corporate</option>
                </datalist>
            </div>

            {{-- Location --}}
            <div>
                <label for="location" class="block text-xs font-bold text-ink-primary mb-1">Deployment Location</label>
                <input
                    type="text"
                    name="location"
                    id="location"
                    value="{{ old('location', $portfolio->location) }}"
                    placeholder="e.g. Gazipur, Dhaka"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            {{-- Results Metric --}}
            <div>
                <label for="results_metric" class="block text-xs font-bold text-ink-primary mb-1">Results Metric / Badge</label>
                <input
                    type="text"
                    name="results_metric"
                    id="results_metric"
                    value="{{ old('results_metric', $portfolio->results_metric) }}"
                    placeholder="e.g. 85% Faster Dispatch, 4,200+ Daily Passes"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            {{-- Hardware Used text --}}
            <div>
                @php
                    $hardwareText = old('hardware_used_text', is_array($portfolio->hardware_used) ? implode(', ', $portfolio->hardware_used) : '');
                @endphp
                <label for="hardware_used_text" class="block text-xs font-bold text-ink-primary mb-1">Hardware Used (Comma-separated)</label>
                <input
                    type="text"
                    name="hardware_used_text"
                    id="hardware_used_text"
                    value="{{ $hardwareText }}"
                    placeholder="e.g. Impinj R700, Chainway C72, Zebra ZT411"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            {{-- Summary --}}
            <div class="md:col-span-2">
                <label for="summary" class="block text-xs font-bold text-ink-primary mb-1">Case Study Summary / Implementation Story</label>
                <textarea
                    name="summary"
                    id="summary"
                    rows="3"
                    placeholder="e.g. 65-inch 4K UHD smart interactive flat panel mounted on heavy-duty mobile caster stand..."
                    class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary"
                >{{ old('summary', $portfolio->summary) }}</textarea>
            </div>

            {{-- Product Function & Capabilities (challenge_solution) --}}
            <div class="md:col-span-2">
                <label for="challenge_solution" class="block text-xs font-bold text-ink-primary mb-1">Product Function &amp; Key Capabilities (Displayed on Gallery Card)</label>
                <textarea
                    name="challenge_solution"
                    id="challenge_solution"
                    rows="3"
                    placeholder="e.g. Eliminates meeting setup delays with anti-glare touch glass, 20-point multi-touch writing, wireless BYOD casting, split-screen review, and instant QR export..."
                    class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary"
                >{{ old('challenge_solution', $portfolio->challenge_solution) }}</textarea>
                <p class="text-[11px] text-ink-muted mt-1">This text appears highlighted in the client gallery under &quot;Product Function &amp; Operational Capabilities&quot;.</p>
            </div>
        </div>
    </div>

    {{-- Media & Publishing --}}
    <div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-ink-muted">Photo &amp; Display Settings</h3>

        {{-- Current Image Preview if available --}}
        @if ($portfolio->image_url)
            <div class="p-3.5 rounded-xl bg-surface-canvas border border-border-hairline flex items-center gap-4">
                <div class="h-20 w-28 rounded-lg overflow-hidden border border-border-hairline bg-white shrink-0 shadow-2xs">
                    <img
                        src="{{ $portfolio->image_url }}"
                        alt="{{ $portfolio->title }}"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div class="space-y-1">
                    <div class="text-xs font-bold text-ink-primary">Current Deployment Photo</div>
                    <div class="text-[11px] font-mono text-ink-muted break-all">{{ $portfolio->image }}</div>
                    <div class="text-[11px] text-emerald-700 font-semibold">Active &amp; displayed on public gallery card</div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="image_file" class="block text-xs font-bold text-ink-primary mb-1">Upload New Photo (JPG, PNG, WebP)</label>
                <input
                    type="file"
                    name="image_file"
                    id="image_file"
                    accept="image/*"
                    class="w-full text-xs text-ink-secondary file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary file:text-white cursor-pointer"
                />
                <p class="text-[11px] text-ink-muted mt-1">Recommended size: 1200x800px or 16:10 aspect ratio</p>
            </div>

            <div>
                <label for="image" class="block text-xs font-bold text-ink-primary mb-1">Or Existing Image Path / URL</label>
                <input
                    type="text"
                    name="image"
                    id="image"
                    value="{{ old('image', $portfolio->image) }}"
                    placeholder="e.g. storage/portfolios/photo.jpg or images/slides/slide-1.jpg"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>

            <div>
                <label for="sort_order" class="block text-xs font-bold text-ink-primary mb-1">Display Sort Order</label>
                <input
                    type="number"
                    name="sort_order"
                    id="sort_order"
                    min="0"
                    value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}"
                    class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
                />
            </div>
        </div>

        <div class="flex items-center gap-6 pt-3 border-t border-border-hairline">
            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', $portfolio->is_active))
                    class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4"
                />
                <span class="text-xs font-bold text-ink-primary">Live on Portfolio Page</span>
            </label>

            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    @checked(old('is_featured', $portfolio->is_featured))
                    class="rounded border-border-hairline text-brand-accent focus:ring-brand-accent h-4 w-4"
                />
                <span class="text-xs font-bold text-ink-primary">Featured Showcase</span>
            </label>
        </div>
    </div>
</div>
