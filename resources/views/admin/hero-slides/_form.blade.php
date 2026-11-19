<div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Eyebrow --}}
        <div>
            <label for="eyebrow" class="block text-xs font-bold text-ink-primary mb-1">Slide Eyebrow Badge</label>
            <input
                type="text"
                name="eyebrow"
                id="eyebrow"
                value="{{ old('eyebrow', $slide->eyebrow) }}"
                placeholder="e.g. MISSION-CRITICAL AUTOMATION"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- CTA Text --}}
        <div>
            <label for="cta_text" class="block text-xs font-bold text-ink-primary mb-1">Button CTA Text</label>
            <input
                type="text"
                name="cta_text"
                id="cta_text"
                value="{{ old('cta_text', $slide->cta_text) }}"
                placeholder="Explore Solutions"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Title --}}
        <div class="md:col-span-2">
            <label for="title" class="block text-xs font-bold text-ink-primary mb-1">Main Slide Heading *</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $slide->title) }}"
                required
                placeholder="e.g. Bangladesh's Premier B2B Hardware & System Integration Partner"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary font-bold"
            />
        </div>

        {{-- Subtitle --}}
        <div class="md:col-span-2">
            <label for="subtitle" class="block text-xs font-bold text-ink-primary mb-1">Subtitle / Supporting Description</label>
            <textarea
                name="subtitle"
                id="subtitle"
                rows="2"
                placeholder="End-to-end barcode scanning, industrial thermal printing, RAIN UHF RFID gates..."
                class="w-full rounded-xl border border-border-hairline p-3 text-xs leading-relaxed focus:outline-none focus:border-brand-primary"
            >{{ old('subtitle', $slide->subtitle) }}</textarea>
        </div>

        {{-- Link URL --}}
        <div>
            <label for="link_url" class="block text-xs font-bold text-ink-primary mb-1">Button Target Link URL</label>
            <input
                type="text"
                name="link_url"
                id="link_url"
                value="{{ old('link_url', $slide->link_url) }}"
                placeholder="/products"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Sort Order --}}
        <div>
            <label for="sort_order" class="block text-xs font-bold text-ink-primary mb-1">Slide Sort Order</label>
            <input
                type="number"
                name="sort_order"
                id="sort_order"
                min="0"
                value="{{ old('sort_order', $slide->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Image Path / Upload --}}
        <div>
            <label for="image_path" class="block text-xs font-bold text-ink-primary mb-1">Slide Background Image Path</label>
            <input
                type="text"
                name="image_path"
                id="image_path"
                value="{{ old('image_path', $slide->image_path) }}"
                placeholder="images/slides/slide-1.jpg"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        <div>
            <label for="image_file" class="block text-xs font-bold text-ink-primary mb-1">Or Upload Slide Image</label>
            <input
                type="file"
                name="image_file"
                id="image_file"
                accept="image/*"
                class="w-full text-xs text-ink-secondary file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary-soft file:text-brand-primary"
            />
        </div>
    </div>

    @if ($slide->image_path)
        <div class="flex items-center gap-3 pt-2">
            <span class="text-xs text-ink-muted">Slide Preview:</span>
            <div class="h-16 w-32 rounded-lg border border-border-hairline bg-surface-subtle overflow-hidden">
                <img src="{{ asset($slide->image_path) }}" alt="" class="h-full w-full object-cover" />
            </div>
        </div>
    @endif

    <div class="flex items-center gap-6 pt-3 border-t border-border-hairline">
        <label class="flex items-center gap-2 cursor-pointer">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', $slide->is_active))
                class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4"
            />
            <span class="text-xs font-bold text-ink-primary">Active in Hero Slider</span>
        </label>

        <label class="flex items-center gap-2 cursor-pointer">
            <input
                type="checkbox"
                name="show_overlay"
                value="1"
                @checked(old('show_overlay', $slide->show_overlay))
                class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4"
            />
            <span class="text-xs font-bold text-ink-primary">Enable Dark Contrast Overlay</span>
        </label>
    </div>
</div>
