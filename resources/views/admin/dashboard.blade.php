<x-layouts.admin
    title="Dashboard"
    subtitle="Enterprise B2B Hardware & System Integration Management Overview"
>
    <div class="space-y-6 sm:space-y-8">
        {{-- WELCOME & STATS BANNER --}}
        <div class="rounded-2xl bg-brand-primary text-white p-6 sm:p-8 relative overflow-hidden shadow-lg border border-white/10">
            <div class="relative z-10 max-w-2xl space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-brand-accent text-xs font-semibold uppercase tracking-wider">
                    <span class="h-2 w-2 rounded-full bg-brand-accent animate-pulse"></span>
                    <span>ProudRock Central Control</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Welcome back, {{ auth()->user()->name ?? 'Administrator' }}
                </h2>
                <p class="text-xs sm:text-sm text-white/80 leading-relaxed">
                    Monitor enterprise client inquiries, manage B2B hardware catalogs, update live portfolios, and configure site settings across Bangladesh.
                </p>
            </div>

            {{-- Decorative background graphics --}}
            <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-brand-accent/10 blur-3xl pointer-events-none" aria-hidden="true"></div>
            <div class="absolute right-8 top-1/2 -translate-y-1/2 hidden md:block opacity-15 pointer-events-none" aria-hidden="true">
                <x-icon name="layout-dashboard" class="w-48 h-48 text-white" />
            </div>
        </div>

        {{-- PRIMARY KPI STATS GRID (100% Responsive) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            {{-- Stat 1: Inquiries / Leads (Highlighted) --}}
            <a
                href="{{ route('admin.inquiries.index') }}"
                class="group rounded-2xl border border-border-hairline bg-white p-5 shadow-xs hover:shadow-md hover:border-brand-primary/40 transition-all flex flex-col justify-between"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-xs font-semibold text-ink-muted uppercase tracking-wider">Client Inquiries</span>
                        <div class="mt-2 text-2xl sm:text-3xl font-black text-brand-primary">
                            {{ $stats['total_inquiries'] }}
                        </div>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600 group-hover:scale-105 transition-transform">
                        <x-icon name="inbox" class="w-5 h-5" />
                    </span>
                </div>
                <div class="mt-4 pt-3 border-t border-border-hairline flex items-center justify-between text-xs">
                    <span class="font-bold text-amber-600 flex items-center gap-1.5">
                        <span class="h-2 w-2 rounded-full bg-amber-500 animate-ping"></span>
                        {{ $stats['new_inquiries'] }} New RFQ{{ $stats['new_inquiries'] === 1 ? '' : 's' }}
                    </span>
                    <span class="text-ink-muted group-hover:text-brand-primary font-medium flex items-center gap-1">
                        View Leads <x-icon name="arrow-right" class="w-3 h-3" />
                    </span>
                </div>
            </a>

            {{-- Stat 2: Products --}}
            <a
                href="{{ route('admin.products.index') }}"
                class="group rounded-2xl border border-border-hairline bg-white p-5 shadow-xs hover:shadow-md hover:border-brand-primary/40 transition-all flex flex-col justify-between"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-xs font-semibold text-ink-muted uppercase tracking-wider">Total Products</span>
                        <div class="mt-2 text-2xl sm:text-3xl font-black text-ink-primary">
                            {{ $stats['total_products'] }}
                        </div>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 group-hover:scale-105 transition-transform">
                        <x-icon name="package" class="w-5 h-5" />
                    </span>
                </div>
                <div class="mt-4 pt-3 border-t border-border-hairline flex items-center justify-between text-xs">
                    <span class="text-ink-secondary">
                        <strong class="text-emerald-600">{{ $stats['in_stock_products'] }}</strong> In Stock · <strong>{{ $stats['featured_products'] }}</strong> Featured
                    </span>
                    <span class="text-ink-muted group-hover:text-brand-primary font-medium flex items-center gap-1">
                        Catalog <x-icon name="arrow-right" class="w-3 h-3" />
                    </span>
                </div>
            </a>

            {{-- Stat 3: Categories --}}
            <a
                href="{{ route('admin.categories.index') }}"
                class="group rounded-2xl border border-border-hairline bg-white p-5 shadow-xs hover:shadow-md hover:border-brand-primary/40 transition-all flex flex-col justify-between"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-xs font-semibold text-ink-muted uppercase tracking-wider">Hardware Categories</span>
                        <div class="mt-2 text-2xl sm:text-3xl font-black text-ink-primary">
                            {{ $stats['total_categories'] }}
                        </div>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600 group-hover:scale-105 transition-transform">
                        <x-icon name="layers" class="w-5 h-5" />
                    </span>
                </div>
                <div class="mt-4 pt-3 border-t border-border-hairline flex items-center justify-between text-xs">
                    <span class="text-ink-secondary">Auto-ID, RFID, POS, Security</span>
                    <span class="text-ink-muted group-hover:text-brand-primary font-medium flex items-center gap-1">
                        Manage <x-icon name="arrow-right" class="w-3 h-3" />
                    </span>
                </div>
            </a>

            {{-- Stat 4: Portfolios & Partners --}}
            <a
                href="{{ route('admin.portfolios.index') }}"
                class="group rounded-2xl border border-border-hairline bg-white p-5 shadow-xs hover:shadow-md hover:border-brand-primary/40 transition-all flex flex-col justify-between"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-xs font-semibold text-ink-muted uppercase tracking-wider">Verified Cases</span>
                        <div class="mt-2 text-2xl sm:text-3xl font-black text-ink-primary">
                            {{ $stats['total_portfolios'] }}
                        </div>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 group-hover:scale-105 transition-transform">
                        <x-icon name="briefcase" class="w-5 h-5" />
                    </span>
                </div>
                <div class="mt-4 pt-3 border-t border-border-hairline flex items-center justify-between text-xs">
                    <span class="text-ink-secondary">
                        <strong>{{ $stats['total_partners'] }}</strong> Brands · <strong>{{ $stats['total_clients'] }}</strong> Clients
                    </span>
                    <span class="text-ink-muted group-hover:text-brand-primary font-medium flex items-center gap-1">
                        Cases <x-icon name="arrow-right" class="w-3 h-3" />
                    </span>
                </div>
            </a>
        </div>

        {{-- QUICK ACTION SHORTCUTS STRIP --}}
        <div class="rounded-2xl border border-border-hairline bg-white p-5 shadow-xs">
            <h3 class="text-xs font-bold uppercase tracking-wider text-ink-muted mb-3">
                Quick Shortcuts
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <a
                    href="{{ route('admin.products.create') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-border-hairline hover:border-brand-primary/40 bg-surface-canvas hover:bg-brand-primary-soft text-ink-primary hover:text-brand-primary text-xs font-semibold transition-all"
                >
                    <x-icon name="plus" class="w-4 h-4 text-brand-primary" />
                    <span>Add New Product</span>
                </a>

                <a
                    href="{{ route('admin.inquiries.index') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-border-hairline hover:border-brand-primary/40 bg-surface-canvas hover:bg-brand-primary-soft text-ink-primary hover:text-brand-primary text-xs font-semibold transition-all"
                >
                    <x-icon name="inbox" class="w-4 h-4 text-amber-500" />
                    <span>Review Inquiries</span>
                </a>

                <a
                    href="{{ route('admin.portfolios.create') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-border-hairline hover:border-brand-primary/40 bg-surface-canvas hover:bg-brand-primary-soft text-ink-primary hover:text-brand-primary text-xs font-semibold transition-all"
                >
                    <x-icon name="briefcase" class="w-4 h-4 text-emerald-600" />
                    <span>Add Case Study</span>
                </a>

                <a
                    href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl border border-border-hairline hover:border-brand-primary/40 bg-surface-canvas hover:bg-brand-primary-soft text-ink-primary hover:text-brand-primary text-xs font-semibold transition-all"
                >
                    <x-icon name="settings" class="w-4 h-4 text-ink-muted" />
                    <span>Site Settings</span>
                </a>
            </div>
        </div>

        {{-- MAIN TWO-COLUMN SECTION: RECENT INQUIRIES & RECENT PRODUCTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
            {{-- LEFT COLUMN (7 Cols): RECENT CLIENT INQUIRIES --}}
            <div class="lg:col-span-7 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-ink-primary flex items-center gap-2">
                            <x-icon name="inbox" class="w-5 h-5 text-brand-primary" />
                            <span>Recent Client Inquiries &amp; RFQs</span>
                        </h3>
                        <p class="text-xs text-ink-muted">Inbound requests from website visitors &amp; product pages</p>
                    </div>

                    <a
                        href="{{ route('admin.inquiries.index') }}"
                        class="text-xs font-semibold text-brand-primary hover:underline flex items-center gap-1"
                    >
                        <span>View All ({{ $stats['total_inquiries'] }})</span>
                        <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                    </a>
                </div>

                <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
                    @if ($recentInquiries->isEmpty())
                        <div class="p-8 text-center text-ink-muted text-xs sm:text-sm">
                            <x-icon name="inbox" class="w-10 h-10 mx-auto text-ink-muted/40 mb-2" />
                            <p>No client inquiries submitted yet.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                                    <tr>
                                        <th class="px-4 py-3">Client</th>
                                        <th class="hidden sm:table-cell px-4 py-3">Subject / Product</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border-hairline">
                                    @foreach ($recentInquiries as $item)
                                        <tr class="hover:bg-surface-canvas/60 transition-colors">
                                            <td class="px-4 py-3 min-w-[140px]">
                                                <div class="font-bold text-ink-primary">{{ $item->name }}</div>
                                                <div class="text-[11px] text-ink-secondary">{{ $item->company_name ?: $item->phone }}</div>
                                                <div class="sm:hidden text-[10px] text-brand-primary font-medium mt-1 truncate max-w-[170px]">
                                                    {{ $item->product ? $item->product->name : ($item->subject ?: 'Product Quotation') }}
                                                </div>
                                            </td>

                                            <td class="hidden sm:table-cell px-4 py-3 min-w-[180px]">
                                                <div class="font-medium text-ink-primary truncate max-w-[220px]">
                                                    {{ $item->subject ?: 'Product Quotation' }}
                                                </div>
                                                @if ($item->product)
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-brand-primary font-semibold">
                                                        <x-icon name="tag" class="w-3 h-3" />
                                                        <span class="truncate max-w-[160px]">{{ $item->product->name }}</span>
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-ink-muted">General Inquiry</span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3 whitespace-nowrap">
                                                @php
                                                    $statusClasses = [
                                                        'new' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                        'in_progress' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                        'closed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-800' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                                <a
                                                    href="{{ route('admin.inquiries.show', $item) }}"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-brand-primary text-white hover:bg-brand-primary/90 transition-colors"
                                                >
                                                    <span>View</span>
                                                    <x-icon name="chevron-right" class="w-3 h-3" />
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RIGHT COLUMN (5 Cols): RECENT PRODUCTS & SYSTEM OVERVIEW --}}
            <div class="lg:col-span-5 space-y-6">
                {{-- Recent Products --}}
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-ink-primary flex items-center gap-2">
                                <x-icon name="package" class="w-5 h-5 text-brand-primary" />
                                <span>Recent Hardware</span>
                            </h3>
                            <p class="text-xs text-ink-muted">Recently updated catalog items</p>
                        </div>

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="text-xs font-semibold text-brand-primary hover:underline flex items-center gap-1"
                        >
                            <span>All Products</span>
                            <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                        </a>
                    </div>

                    <div class="rounded-2xl border border-border-hairline bg-white shadow-xs divide-y divide-border-hairline overflow-hidden">
                        @if ($recentProducts->isEmpty())
                            <div class="p-6 text-center text-xs text-ink-muted">
                                No products found. <a href="{{ route('admin.products.create') }}" class="text-brand-primary font-bold underline">Add one now</a>.
                            </div>
                        @else
                            @foreach ($recentProducts as $prod)
                                <div class="p-3.5 flex items-center justify-between gap-3 hover:bg-surface-canvas/50 transition-colors">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="h-10 w-10 rounded-lg border border-border-hairline bg-surface-subtle p-1 shrink-0 flex items-center justify-center overflow-hidden">
                                            @if ($prod->image)
                                                <img src="{{ asset($prod->image) }}" alt="" class="h-full w-full object-contain" />
                                            @else
                                                <x-icon name="package" class="w-5 h-5 text-ink-muted" />
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-xs font-bold text-ink-primary truncate">{{ $prod->name }}</div>
                                            <div class="text-[11px] text-ink-muted flex items-center gap-2">
                                                <span>{{ $prod->category->name ?? 'Hardware' }}</span>
                                                @if ($prod->model_number)
                                                    <span>•</span>
                                                    <span class="font-mono text-[10px]">{{ $prod->model_number }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 shrink-0">
                                        <a
                                            href="{{ route('admin.products.edit', $prod) }}"
                                            class="p-1.5 rounded-lg text-ink-secondary hover:text-brand-primary hover:bg-surface-canvas transition-colors"
                                            title="Edit Product"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>
                                        <a
                                            href="{{ route('products.show', $prod->slug) }}"
                                            target="_blank"
                                            class="p-1.5 rounded-lg text-ink-secondary hover:text-brand-primary hover:bg-surface-canvas transition-colors"
                                            title="View Public Details"
                                        >
                                            <x-icon name="eye" class="w-4 h-4" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Category Distribution & System Metrics --}}
                <div class="rounded-2xl border border-border-hairline bg-white p-5 shadow-xs space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-ink-muted flex items-center gap-2">
                        <x-icon name="server" class="w-4 h-4 text-brand-primary" />
                        <span>System Environment &amp; Specs</span>
                    </h4>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-surface-canvas border border-border-hairline">
                            <div class="text-ink-muted text-[10px] uppercase font-bold">PHP Runtime</div>
                            <div class="text-sm font-extrabold text-ink-primary mt-0.5">{{ $systemInfo['php_version'] }}</div>
                        </div>

                        <div class="p-3 rounded-xl bg-surface-canvas border border-border-hairline">
                            <div class="text-ink-muted text-[10px] uppercase font-bold">Framework</div>
                            <div class="text-sm font-extrabold text-ink-primary mt-0.5">Laravel {{ $systemInfo['laravel_version'] }}</div>
                        </div>

                        <div class="p-3 rounded-xl bg-surface-canvas border border-border-hairline">
                            <div class="text-ink-muted text-[10px] uppercase font-bold">Database</div>
                            <div class="text-sm font-extrabold text-ink-primary mt-0.5 capitalize">{{ $systemInfo['database'] }}</div>
                        </div>

                        <div class="p-3 rounded-xl bg-surface-canvas border border-border-hairline">
                            <div class="text-ink-muted text-[10px] uppercase font-bold">Environment</div>
                            <div class="text-sm font-extrabold text-emerald-600 mt-0.5 capitalize">{{ $systemInfo['environment'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
