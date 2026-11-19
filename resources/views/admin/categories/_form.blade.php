<div class="rounded-2xl border border-border-hairline bg-white p-6 shadow-xs space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Name --}}
        <div>
            <label for="name" class="block text-xs font-bold text-ink-primary mb-1">Category Title *</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $category->name) }}"
                required
                placeholder="e.g. Barcode & Auto-ID"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block text-xs font-bold text-ink-primary mb-1">URL Slug (Leave blank to auto-generate)</label>
            <input
                type="text"
                name="slug"
                id="slug"
                value="{{ old('slug', $category->slug) }}"
                placeholder="e.g. barcode-auto-id"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Icon --}}
        <div>
            <label for="icon" class="block text-xs font-bold text-ink-primary mb-1">Lucide Icon Name</label>
            <select
                name="icon"
                id="icon"
                class="w-full rounded-xl border border-border-hairline px-3 py-2 text-xs focus:outline-none focus:border-brand-primary"
            >
                @foreach (['scan-barcode' => 'Barcode Scanner', 'radio' => 'RFID Systems', 'fingerprint' => 'Biometric Access', 'shield-check' => 'Security & EAS', 'store' => 'Retail POS', 'wrench' => 'AMC Support & Service', 'layers' => 'Default Layers'] as $iconKey => $iconLabel)
                    <option value="{{ $iconKey }}" @selected(old('icon', $category->icon) === $iconKey)>
                        {{ $iconLabel }} ({{ $iconKey }})
                    </option>
                @endforeach
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
                value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Short Description --}}
        <div class="md:col-span-2">
            <label for="short_description" class="block text-xs font-bold text-ink-primary mb-1">Short Description</label>
            <input
                type="text"
                name="short_description"
                id="short_description"
                value="{{ old('short_description', $category->short_description) }}"
                placeholder="e.g. Industrial thermal printers, 2D handheld imagers & mobile computers..."
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        {{-- Image Path / Upload --}}
        <div>
            <label for="image" class="block text-xs font-bold text-ink-primary mb-1">Image Path / URL</label>
            <input
                type="text"
                name="image"
                id="image"
                value="{{ old('image', $category->image) }}"
                placeholder="e.g. images/categories/barcode-auto-id.jpg"
                class="w-full rounded-xl border border-border-hairline px-3.5 py-2 text-xs focus:outline-none focus:border-brand-primary"
            />
        </div>

        <div>
            <label for="image_file" class="block text-xs font-bold text-ink-primary mb-1">Or Upload Image</label>
            <input
                type="file"
                name="image_file"
                id="image_file"
                accept="image/*"
                class="w-full text-xs text-ink-secondary file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-primary-soft file:text-brand-primary"
            />
        </div>
    </div>

    {{-- Active Checkbox --}}
    <div class="pt-3 border-t border-border-hairline">
        <label class="flex items-center gap-2 cursor-pointer">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', $category->is_active))
                class="rounded border-border-hairline text-brand-primary focus:ring-brand-primary h-4 w-4"
            />
            <span class="text-xs font-bold text-ink-primary">Category is Active on Website</span>
        </label>
    </div>
</div>
