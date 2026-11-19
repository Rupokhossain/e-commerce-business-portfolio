<x-layouts.admin
    title="Hardware Categories"
    subtitle="Organize solutions by division: Barcode, RFID, Biometrics, POS, Security & Support"
>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <p class="text-xs text-ink-muted">
                {{ $categories->total() }} active hardware categories
            </p>

            <a
                href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-accent text-brand-primary font-bold text-xs hover:bg-brand-accent/90 transition-colors shadow-xs"
            >
                <x-icon name="plus" class="w-4 h-4" />
                <span>Add Category</span>
            </a>
        </div>

        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($categories->isEmpty())
                <div class="p-12 text-center text-ink-muted">
                    <x-icon name="layers" class="w-12 h-12 mx-auto text-ink-muted/30 mb-3" />
                    <h3 class="text-sm font-bold text-ink-primary">No categories found</h3>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3.5">Category</th>
                                <th class="hidden md:table-cell px-5 py-3.5">Slug</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Products</th>
                                <th class="hidden lg:table-cell px-5 py-3.5 text-center">Sort Order</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Status</th>
                                <th class="px-2.5 sm:px-5 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($categories as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 min-w-0">
                                        <div class="flex items-center gap-2 sm:gap-3">
                                            <span class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-xl bg-brand-primary-soft text-brand-primary shrink-0">
                                                <x-icon :name="$item->icon ?: 'layers'" class="w-3.5 h-3.5 sm:w-5 sm:h-5" />
                                            </span>
                                            <div class="min-w-0 flex-1">
                                                <div class="font-bold text-ink-primary truncate text-xs sm:text-sm">{{ $item->name }}</div>
                                                <div class="text-[10px] sm:text-[11px] text-ink-muted truncate">{{ $item->short_description ?: 'No description' }}</div>
                                                <div class="sm:hidden flex items-center gap-1.5 mt-0.5">
                                                    <span class="text-[10px] text-brand-primary font-semibold">
                                                        {{ $item->products_count }} {{ Str::plural('item', $item->products_count) }}
                                                    </span>
                                                    <span class="text-ink-muted/50 text-[10px]">•</span>
                                                    @if ($item->is_active)
                                                        <span class="inline-flex items-center text-[10px] font-bold text-emerald-700">Active</span>
                                                    @else
                                                        <span class="inline-flex items-center text-[10px] font-bold text-rose-600">Hidden</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="hidden md:table-cell px-5 py-3.5 font-mono text-[11px] text-ink-secondary whitespace-nowrap">
                                        {{ $item->slug }}
                                    </td>

                                    <td class="hidden sm:table-cell px-5 py-3.5 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-surface-canvas border border-border-hairline text-brand-primary">
                                            {{ $item->products_count }} {{ Str::plural('item', $item->products_count) }}
                                        </span>
                                    </td>

                                    <td class="hidden lg:table-cell px-5 py-3.5 text-center font-mono text-xs text-ink-secondary whitespace-nowrap">
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
                                            href="{{ route('admin.categories.edit', $item) }}"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="Edit Category"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('admin.categories.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Category"
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

                @if ($categories->hasPages())
                    <div class="px-5 py-3 border-t border-border-hairline bg-surface-canvas">
                        {{ $categories->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
