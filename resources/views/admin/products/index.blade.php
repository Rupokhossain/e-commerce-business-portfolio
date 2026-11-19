<x-layouts.admin
    title="Products Catalog"
    subtitle="Manage B2B hardware, specifications, datasheets and availability"
>
    <div class="space-y-6">
        {{-- Top Bar: Search, Category Filter, and Add Button (Mobile-First Layout) --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row sm:items-center gap-2 flex-1 w-full sm:max-w-3xl">
                {{-- Search Input --}}
                <div class="relative w-full sm:flex-1 sm:min-w-[180px]">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search product, brand, SKU..."
                        class="w-full pl-9 pr-3 py-2 rounded-xl border border-border-hairline bg-white text-xs focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary shadow-xs"
                    />
                    <x-icon name="search" class="w-4 h-4 text-ink-muted absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                </div>

                {{-- Category and Status Filter Row on Mobile --}}
                <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 w-full sm:w-auto">
                    {{-- Category Filter --}}
                    <select
                        name="category_id"
                        class="w-full sm:w-auto rounded-xl border border-border-hairline bg-white px-3 py-2 text-xs focus:outline-none focus:border-brand-primary shadow-xs"
                    >
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected($categoryId == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    {{-- Status Filter --}}
                    <select
                        name="status"
                        class="w-full sm:w-auto rounded-xl border border-border-hairline bg-white px-3 py-2 text-xs focus:outline-none focus:border-brand-primary shadow-xs"
                    >
                        <option value="">All Statuses</option>
                        <option value="featured" @selected($status === 'featured')>Featured Only</option>
                        <option value="inactive" @selected($status === 'inactive')>Inactive Only</option>
                    </select>
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit" class="flex-1 sm:flex-initial px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-semibold hover:bg-brand-primary/95 transition-colors shadow-xs text-center cursor-pointer">
                        Filter
                    </button>
                    @if ($search || $categoryId || $status)
                        <a href="{{ route('admin.products.index') }}" class="px-3 py-2 rounded-xl border border-border-hairline bg-white text-ink-secondary text-xs font-semibold hover:text-brand-primary transition-colors shadow-xs text-center">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-4 py-2.5 sm:py-2 rounded-xl bg-brand-accent text-brand-primary font-bold text-xs hover:bg-brand-accent/90 transition-colors shadow-xs shrink-0"
            >
                <x-icon name="plus" class="w-4 h-4" />
                <span>Add Product</span>
            </a>
        </div>

        {{-- Products Table --}}
        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($products->isEmpty())
                <div class="p-12 text-center text-ink-muted">
                    <x-icon name="package" class="w-12 h-12 mx-auto text-ink-muted/30 mb-3" />
                    <h3 class="text-sm font-bold text-ink-primary">No products found</h3>
                    <p class="text-xs text-ink-secondary mt-1">Try adjusting your filters or click "Add Product" to create one.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3.5">Product &amp; Category</th>
                                <th class="hidden sm:table-cell px-5 py-3.5">Brand &amp; Model</th>
                                <th class="hidden md:table-cell px-5 py-3.5">Stock Status</th>
                                <th class="hidden lg:table-cell px-5 py-3.5 text-center">Featured</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Active</th>
                                <th class="px-2.5 sm:px-5 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($products as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    {{-- Product Name & Category --}}
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 min-w-0 sm:min-w-[220px]">
                                        <div class="flex items-center gap-2.5 sm:gap-3">
                                            @if ($item->image)
                                                <button
                                                    type="button"
                                                    data-lightbox-src="{{ $item->image_url }}"
                                                    data-lightbox-title="{{ $item->name }}"
                                                    data-lightbox-sub="{{ $item->category->name ?? 'Hardware' }}{{ $item->model_number ? ' · Model: ' . $item->model_number : '' }}"
                                                    class="h-10 w-10 sm:h-11 sm:w-11 rounded-lg border border-border-hairline bg-surface-subtle p-1 shrink-0 flex items-center justify-center overflow-hidden hover:border-brand-primary cursor-zoom-in transition-all group shadow-2xs"
                                                    title="Click to zoom in on image"
                                                >
                                                    <img src="{{ $item->image_url }}" alt="" class="h-full w-full object-contain group-hover:scale-110 transition-transform" />
                                                </button>
                                            @else
                                                <div class="h-10 w-10 sm:h-11 sm:w-11 rounded-lg border border-border-hairline bg-surface-subtle p-1 shrink-0 flex items-center justify-center overflow-hidden">
                                                    <x-icon name="package" class="w-5 h-5 text-ink-muted" />
                                                </div>
                                            @endif
                                            <div class="min-w-0 flex-1">
                                                <div class="font-bold text-ink-primary truncate max-w-[200px] sm:max-w-[260px]">{{ $item->name }}</div>
                                                <div class="text-[11px] text-ink-muted flex items-center gap-1.5 mt-0.5">
                                                    <span>{{ $item->category->name ?? 'Unassigned' }}</span>
                                                    @if ($item->sku)
                                                        <span>•</span>
                                                        <span class="font-mono text-[10px]">SKU: {{ $item->sku }}</span>
                                                    @endif
                                                </div>

                                                {{-- Mobile-only Brand & Stock Badges --}}
                                                <div class="sm:hidden flex flex-wrap items-center gap-1.5 mt-1">
                                                    @if ($item->brand)
                                                        <span class="text-[10px] font-semibold text-brand-primary">{{ $item->brand }}</span>
                                                    @endif
                                                    @if ($item->model_number)
                                                        <span class="text-[10px] font-mono text-ink-muted">[{{ $item->model_number }}]</span>
                                                    @endif
                                                    @if ($item->availability_status === 'in_stock')
                                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-800">In Stock</span>
                                                    @elseif ($item->availability_status === 'on_request')
                                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-blue-100 text-blue-800">On Request</span>
                                                    @endif
                                                    @if ($item->is_featured)
                                                        <span class="text-[9px] font-bold text-amber-600">★</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Brand & Model (Desktop/Tablet) --}}
                                    <td class="hidden sm:table-cell px-5 py-3.5 whitespace-nowrap">
                                        <div class="font-semibold text-ink-primary">{{ $item->brand ?: '—' }}</div>
                                        <div class="text-[11px] text-ink-muted font-mono">{{ $item->model_number ?: '—' }}</div>
                                    </td>

                                    {{-- Stock Status (Desktop/Tablet) --}}
                                    <td class="hidden md:table-cell px-5 py-3.5 whitespace-nowrap">
                                        @if ($item->availability_status === 'in_stock')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> In Stock
                                            </span>
                                        @elseif ($item->availability_status === 'on_request')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                                <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> On Request
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                                Discontinued
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Featured (Desktop) --}}
                                    <td class="hidden lg:table-cell px-5 py-3.5 text-center whitespace-nowrap">
                                        @if ($item->is_featured)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                ★ Home
                                            </span>
                                        @else
                                            <span class="text-ink-muted text-xs">—</span>
                                        @endif
                                    </td>

                                    {{-- Active Status (Desktop/Tablet) --}}
                                    <td class="hidden sm:table-cell px-5 py-3.5 text-center whitespace-nowrap">
                                        @if ($item->is_active)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700">
                                                Live
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700">
                                                Hidden
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions (Always visible, thumb-friendly) --}}
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right whitespace-nowrap space-x-0.5 sm:space-x-1">
                                        <a
                                            href="{{ route('products.show', $item->slug) }}"
                                            target="_blank"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="View Public Page"
                                        >
                                            <x-icon name="eye" class="w-4 h-4" />
                                        </a>

                                        <a
                                            href="{{ route('admin.products.edit', $item) }}"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="Edit Product"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Product"
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

                @if ($products->hasPages())
                    <div class="px-5 py-3 border-t border-border-hairline bg-surface-canvas">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
