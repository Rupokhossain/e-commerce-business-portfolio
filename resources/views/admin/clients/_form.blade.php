<div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Name --}}
        <div>
            <label for="name" class="block text-xs font-bold text-ink-primary mb-1">Client / Company Name *</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $client->name) }}"
                required
                placeholder="e.g. Apex Export Knitwear Ltd., Square Pharmaceuticals PLC"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block text-xs font-bold text-ink-primary mb-1">URL Slug (Leave blank to auto-generate)</label>
            <input
                type="text"
                name="slug"
                id="slug"
                value="{{ old('slug', $client->slug) }}"
                placeholder="apex-export-knitwear"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Sector / Industry --}}
        <div>
            <label for="sector" class="block text-xs font-bold text-ink-primary mb-1">Industry / Sector</label>
            <input
                type="text"
                name="sector"
                id="sector"
                value="{{ old('sector', $client->sector) }}"
                placeholder="e.g. Garments & RMG, Supermarket & Retail, FMCG"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Location --}}
        <div>
            <label for="location" class="block text-xs font-bold text-ink-primary mb-1">Factory / Campus Location</label>
            <input
                type="text"
                name="location"
                id="location"
                value="{{ old('location', $client->location) }}"
                placeholder="e.g. Gazipur, Dhaka, Tejgaon Industrial Area"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Badge --}}
        <div>
            <label for="badge" class="block text-xs font-bold text-ink-primary mb-1">Display Badge (Short Tag)</label>
            <input
                type="text"
                name="badge"
                id="badge"
                value="{{ old('badge', $client->badge) }}"
                placeholder="e.g. Export RMG, Pharma Grade, Enterprise Campus"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Website URL --}}
        <div>
            <label for="website_url" class="block text-xs font-bold text-ink-primary mb-1">Client Official Website</label>
            <input
                type="url"
                name="website_url"
                id="website_url"
                value="{{ old('website_url', $client->website_url) }}"
                placeholder="https://www.example.com"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Solution Provided --}}
        <div class="md:col-span-2">
            <label for="solution_provided" class="block text-xs font-bold text-ink-primary mb-1">System Solution Delivered / Hardware Deployed</label>
            <textarea
                name="solution_provided"
                id="solution_provided"
                rows="2"
                placeholder="e.g. UHF RFID Dock-Door Carton Verification Gates across 6 loading bays"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            >{{ old('solution_provided', $client->solution_provided) }}</textarea>
        </div>

        {{-- Logo Path --}}
        <div>
            <label for="logo" class="block text-xs font-bold text-ink-primary mb-1">Logo Image Path or URL</label>
            <input
                type="text"
                name="logo"
                id="logo"
                value="{{ old('logo', $client->logo) }}"
                placeholder="e.g. images/clients/apex.svg or storage/clients/filename.png"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Logo File Upload --}}
        <div>
            <label for="logo_file" class="block text-xs font-bold text-ink-primary mb-1">Or Upload Logo File (SVG, PNG, JPG)</label>
            <input
                type="file"
                name="logo_file"
                id="logo_file"
                accept="image/png,image/jpeg,image/svg+xml,image/webp"
                class="w-full text-xs text-ink-secondary file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary-soft file:text-brand-primary"
            />
        </div>

        {{-- Sort Order --}}
        <div>
            <label for="sort_order" class="block text-xs font-bold text-ink-primary mb-1">Sort Order (Lower numbers appear first)</label>
            <input
                type="number"
                name="sort_order"
                id="sort_order"
                min="0"
                value="{{ old('sort_order', $client->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-hidden focus:border-brand-primary"
            />
        </div>

        {{-- Active Status --}}
        <div class="flex items-center gap-3 pt-4">
            <input
                type="checkbox"
                name="is_active"
                id="is_active"
                value="1"
                {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}
                class="h-4 w-4 rounded-md border-border-hairline text-brand-primary focus:ring-brand-primary"
            />
            <label for="is_active" class="text-xs font-bold text-ink-primary select-none cursor-pointer">
                Publish Client (Visible in Marquee Slider &amp; Company Profile)
            </label>
        </div>
    </div>

    @if ($client->logo_url)
        <div class="flex items-center gap-3 pt-3 border-t border-border-hairline">
            <span class="text-xs font-semibold text-ink-muted">Current Logo Preview:</span>
            <div class="h-14 w-32 rounded-xl border border-border-hairline p-2 bg-white flex items-center justify-center overflow-hidden shadow-2xs">
                <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="h-full w-full object-contain" />
            </div>
        </div>
    @endif
</div>
