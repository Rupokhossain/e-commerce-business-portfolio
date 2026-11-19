<div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Name --}}
        <div>
            <label for="name" class="block text-xs font-bold text-ink-primary mb-1">Partner Brand Name *</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $partner->name) }}"
                required
                placeholder="e.g. Chainway, FingerTec, Arneg"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block text-xs font-bold text-ink-primary mb-1">Slug</label>
            <input
                type="text"
                name="slug"
                id="slug"
                value="{{ old('slug', $partner->slug) }}"
                placeholder="chainway"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Specialty --}}
        <div>
            <label for="specialty" class="block text-xs font-bold text-ink-primary mb-1">Specialty / Field</label>
            <input
                type="text"
                name="specialty"
                id="specialty"
                value="{{ old('specialty', $partner->specialty) }}"
                placeholder="e.g. Mobile Computing & RFID Sleds"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Website URL --}}
        <div>
            <label for="website_url" class="block text-xs font-bold text-ink-primary mb-1">Website URL</label>
            <input
                type="url"
                name="website_url"
                id="website_url"
                value="{{ old('website_url', $partner->website_url) }}"
                placeholder="https://www.chainway.net"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Logo Path / Upload --}}
        <div>
            <label for="logo" class="block text-xs font-bold text-ink-primary mb-1">Logo Image Path</label>
            <input
                type="text"
                name="logo"
                id="logo"
                value="{{ old('logo', $partner->logo) }}"
                placeholder="e.g. images/1741167487.jpg"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        <div>
            <label for="logo_file" class="block text-xs font-bold text-ink-primary mb-1">Or Upload Logo File</label>
            <input
                type="file"
                name="logo_file"
                id="logo_file"
                accept="image/*"
                class="w-full text-xs text-ink-secondary file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary-soft file:text-brand-primary"
            />
        </div>

        {{-- Sort Order --}}
        <div>
            <label for="sort_order" class="block text-xs font-bold text-ink-primary mb-1">Display Sort Order</label>
            <input
                type="number"
                name="sort_order"
                id="sort_order"
                min="0"
                value="{{ old('sort_order', $partner->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>
    </div>

    @if ($partner->logo)
        <div class="flex items-center gap-3 pt-2">
            <span class="text-xs text-ink-muted">Logo Preview:</span>
            <div class="h-12 w-28 rounded-lg border border-border-hairline p-2 bg-white flex items-center justify-center overflow-hidden">
                <img src="{{ asset($partner->logo) }}" alt="" class="h-full w-full object-contain" />
            </div>
        </div>
    @endif

    <div class="pt-3 border-t border-border-hairline">
        <label class="flex items-center gap-2 cursor-pointer">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', $partner->is_active))
                class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4"
            />
            <span class="text-xs font-bold text-ink-primary">Show in Marquee Slider on Public Website</span>
        </label>
    </div>
</div>
