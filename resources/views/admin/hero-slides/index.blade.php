<x-layouts.admin
    title="Hero Slides"
    subtitle="Manage high-impact homepage slider banners and marketing messages"
>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <p class="text-xs text-ink-muted">
                {{ $slides->total() }} slider banners configured
            </p>

            <a
                href="{{ route('admin.hero-slides.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-accent text-brand-primary font-bold text-xs hover:bg-brand-accent/90 transition-colors shadow-xs"
            >
                <x-icon name="plus" class="w-4 h-4" />
                <span>Add Hero Slide</span>
            </a>
        </div>

        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($slides->isEmpty())
                <div class="p-12 text-center text-ink-muted">
                    <x-icon name="images" class="w-12 h-12 mx-auto text-ink-muted/30 mb-3" />
                    <h3 class="text-sm font-bold text-ink-primary">No hero slides found</h3>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 w-18 sm:w-28">Banner Preview</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5">Heading &amp; Eyebrow</th>
                                <th class="hidden md:table-cell px-5 py-3.5">CTA Button</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Order</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Status</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($slides as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 whitespace-nowrap">
                                        <div class="h-9 w-16 sm:h-12 sm:w-24 rounded-lg border border-border-hairline bg-surface-subtle overflow-hidden">
                                            @if ($item->image_path)
                                                <img src="{{ asset($item->image_path) }}" alt="" class="h-full w-full object-cover" />
                                            @else
                                                <div class="h-full w-full flex items-center justify-center text-[10px] text-ink-muted">No image</div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 min-w-0">
                                        <div class="font-bold text-ink-primary leading-snug">{{ $item->title }}</div>
                                        <div class="flex flex-wrap items-center gap-1.5 mt-0.5">
                                            @if ($item->eyebrow)
                                                <span class="text-[10px] font-bold text-brand-primary uppercase tracking-wider">{{ $item->eyebrow }}</span>
                                            @endif
                                            @if ($item->is_active)
                                                <span class="sm:hidden inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-emerald-50 text-emerald-700">Active</span>
                                            @else
                                                <span class="sm:hidden inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-rose-50 text-rose-700">Hidden</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="hidden md:table-cell px-5 py-3.5 whitespace-nowrap">
                                        <div class="font-semibold text-ink-primary">{{ $item->cta_text ?: '—' }}</div>
                                        <div class="text-[11px] text-ink-muted font-mono">{{ $item->link_url ?: '—' }}</div>
                                    </td>

                                    <td class="hidden sm:table-cell px-5 py-3.5 text-center font-mono text-xs text-ink-secondary whitespace-nowrap">
                                        {{ $item->sort_order }}
                                    </td>

                                    <td class="hidden sm:table-cell px-5 py-3.5 text-center whitespace-nowrap">
                                        @if ($item->is_active)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700">
                                                Hidden
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right whitespace-nowrap space-x-0.5 sm:space-x-1">
                                        <a
                                            href="{{ route('admin.hero-slides.edit', $item) }}"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="Edit Slide"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('admin.hero-slides.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Slide"
                                            >
                                                <x-icon name="trash-2" class="w-4 h-4" />
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($slides->hasPages())
                    <div class="px-5 py-3 border-t border-border-hairline bg-surface-canvas">
                        {{ $slides->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
