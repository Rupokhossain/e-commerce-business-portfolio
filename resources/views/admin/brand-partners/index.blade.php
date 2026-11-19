<x-layouts.admin
    title="Brand Partners"
    subtitle="Manage global OEM technology partners displayed in the homepage sliding marquee"
>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <p class="text-xs text-ink-muted">
                {{ $partners->total() }} OEM technology partners
            </p>

            <a
                href="{{ route('admin.brand-partners.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-accent text-brand-primary font-bold text-xs hover:bg-brand-accent/90 transition-colors shadow-xs"
            >
                <x-icon name="plus" class="w-4 h-4" />
                <span>Add Brand Partner</span>
            </a>
        </div>

        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($partners->isEmpty())
                <div class="p-12 text-center text-ink-muted">
                    <x-icon name="award" class="w-12 h-12 mx-auto text-ink-muted/30 mb-3" />
                    <h3 class="text-sm font-bold text-ink-primary">No brand partners found</h3>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 w-14 sm:w-28">Logo</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5">Brand &amp; Specialty</th>
                                <th class="hidden md:table-cell px-5 py-3.5">Website</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Order</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Status</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($partners as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 whitespace-nowrap">
                                        <div class="h-8 w-12 sm:h-10 sm:w-24 rounded-lg border border-border-hairline p-0.5 sm:p-1.5 bg-white flex items-center justify-center overflow-hidden">
                                            @if ($item->logo)
                                                <img src="{{ asset($item->logo) }}" alt="" class="h-full w-full object-contain" />
                                            @else
                                                <span class="text-[9px] sm:text-[10px] font-bold text-ink-muted">{{ $item->name }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 min-w-0">
                                        <div class="font-bold text-ink-primary leading-snug">{{ $item->name }}</div>
                                        <div class="text-[11px] text-ink-muted flex flex-wrap items-center gap-1.5 mt-0.5">
                                            <span>{{ $item->specialty ?: 'OEM Hardware' }}</span>
                                            @if ($item->is_active)
                                                <span class="sm:hidden inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-emerald-50 text-emerald-700">Active</span>
                                            @else
                                                <span class="sm:hidden inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-rose-50 text-rose-700">Hidden</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="hidden md:table-cell px-5 py-3.5 text-ink-secondary whitespace-nowrap">
                                        @if ($item->website_url)
                                            <a href="{{ $item->website_url }}" target="_blank" class="text-brand-primary hover:underline flex items-center gap-1">
                                                <span class="truncate max-w-[160px]">{{ $item->website_url }}</span>
                                                <x-icon name="external-link" class="w-3 h-3 text-ink-muted" />
                                            </a>
                                        @else
                                            <span class="text-ink-muted">—</span>
                                        @endif
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
                                            href="{{ route('admin.brand-partners.edit', $item) }}"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="Edit Partner"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('admin.brand-partners.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Partner"
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

                @if ($partners->hasPages())
                    <div class="px-5 py-3 border-t border-border-hairline bg-surface-canvas">
                        {{ $partners->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
