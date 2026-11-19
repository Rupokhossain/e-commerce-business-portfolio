<x-layouts.admin
    title="Client Inquiries & RFQs"
    subtitle="Manage inbound quotation requests, inquiries and sales leads"
>
    <div class="space-y-6">
        {{-- TOP STATS & FILTER TABS --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            {{-- Status Tabs --}}
            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0">
                <a
                    href="{{ route('admin.inquiries.index') }}"
                    class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition-colors {{ empty($status) ? 'bg-brand-primary text-white border-brand-primary shadow-xs' : 'bg-white text-ink-secondary border-border-hairline hover:bg-surface-canvas' }}"
                >
                    All ({{ $counts['all'] }})
                </a>
                <a
                    href="{{ route('admin.inquiries.index', ['status' => 'new']) }}"
                    class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition-colors {{ $status === 'new' ? 'bg-amber-500 text-white border-amber-500 shadow-xs' : 'bg-white text-ink-secondary border-border-hairline hover:bg-surface-canvas' }}"
                >
                    New ({{ $counts['new'] }})
                </a>
                <a
                    href="{{ route('admin.inquiries.index', ['status' => 'in_progress']) }}"
                    class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition-colors {{ $status === 'in_progress' ? 'bg-blue-600 text-white border-blue-600 shadow-xs' : 'bg-white text-ink-secondary border-border-hairline hover:bg-surface-canvas' }}"
                >
                    In Progress ({{ $counts['in_progress'] }})
                </a>
                <a
                    href="{{ route('admin.inquiries.index', ['status' => 'closed']) }}"
                    class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition-colors {{ $status === 'closed' ? 'bg-emerald-600 text-white border-emerald-600 shadow-xs' : 'bg-white text-ink-secondary border-border-hairline hover:bg-surface-canvas' }}"
                >
                    Closed ({{ $counts['closed'] }})
                </a>
            </div>

            {{-- Search Box --}}
            <form action="{{ route('admin.inquiries.index') }}" method="GET" class="flex items-center gap-2">
                @if ($status)
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <div class="relative w-full sm:w-64">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search client, phone..."
                        class="w-full pl-9 pr-3 py-1.5 rounded-xl border border-border-hairline bg-white text-xs focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                    />
                    <x-icon name="search" class="w-4 h-4 text-ink-muted absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                </div>
                <button type="submit" class="px-3 py-1.5 rounded-xl bg-brand-primary text-white text-xs font-semibold hover:bg-brand-primary/95 transition-colors">
                    Filter
                </button>
            </form>
        </div>

        {{-- INQUIRIES TABLE --}}
        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($inquiries->isEmpty())
                <div class="p-12 text-center text-ink-muted">
                    <x-icon name="inbox" class="w-12 h-12 mx-auto text-ink-muted/30 mb-3" />
                    <h3 class="text-sm font-bold text-ink-primary">No inquiries found</h3>
                    <p class="text-xs text-ink-secondary mt-1">There are no client quote requests matching the selected filter.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3.5">Client &amp; Contact</th>
                                <th class="hidden sm:table-cell px-5 py-3.5">Subject / Hardware</th>
                                <th class="hidden lg:table-cell px-5 py-3.5">Message Snippet</th>
                                <th class="hidden sm:table-cell px-5 py-3.5">Status</th>
                                <th class="hidden md:table-cell px-5 py-3.5">Received</th>
                                <th class="px-2.5 sm:px-5 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($inquiries as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    {{-- Client & Contact --}}
                                    <td class="px-2.5 sm:px-5 py-3.5 sm:py-4 min-w-0">
                                        <div class="font-bold text-ink-primary text-xs sm:text-sm truncate">{{ $item->name }}</div>
                                        @if ($item->company_name)
                                            <div class="text-[10px] sm:text-[11px] font-medium text-brand-primary truncate">{{ $item->company_name }}</div>
                                        @endif
                                        <div class="text-[10px] sm:text-[11px] text-ink-muted mt-0.5 flex items-center gap-1">
                                            <x-icon name="phone" class="w-3 h-3 text-ink-muted shrink-0" />
                                            <span class="truncate">{{ $item->phone }}</span>
                                        </div>

                                        {{-- Mobile Embedded Info (Subject, Status, Time) --}}
                                        <div class="sm:hidden mt-1.5 space-y-1">
                                            <div class="text-[10px] font-semibold text-ink-primary truncate">
                                                {{ $item->subject ?: 'Quotation Request' }}
                                                @if ($item->product)
                                                    <span class="text-brand-primary">({{ $item->product->name }})</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                @php
                                                    $statusClasses = [
                                                        'new' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                        'in_progress' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                        'closed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center px-1.5 py-0.2 rounded-full text-[9px] font-bold border {{ $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-800' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                </span>
                                                <span class="text-[10px] text-ink-muted/80">• {{ $item->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Subject / Hardware --}}
                                    <td class="hidden sm:table-cell px-5 py-4 min-w-[160px]">
                                        <div class="font-semibold text-ink-primary">{{ $item->subject ?: 'Quotation Request' }}</div>
                                        @if ($item->product)
                                            <a
                                                href="{{ route('products.show', $item->product->slug) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-1 text-[11px] text-brand-primary hover:underline font-medium mt-0.5"
                                            >
                                                <x-icon name="package" class="w-3 h-3" />
                                                <span class="truncate max-w-[170px]">{{ $item->product->name }}</span>
                                                <x-icon name="external-link" class="w-2.5 h-2.5 text-ink-muted" />
                                            </a>
                                        @else
                                            <span class="text-[11px] text-ink-muted">General Contact Form</span>
                                        @endif
                                    </td>

                                    {{-- Snippet --}}
                                    <td class="hidden lg:table-cell px-5 py-4 max-w-[260px]">
                                        <p class="text-xs text-ink-secondary line-clamp-2 leading-relaxed">
                                            {{ $item->message }}
                                        </p>
                                    </td>

                                    {{-- Status --}}
                                    <td class="hidden sm:table-cell px-5 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'new' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                'in_progress' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'closed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-800' }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>
                                    </td>

                                    {{-- Received Date --}}
                                    <td class="hidden md:table-cell px-5 py-4 text-ink-muted whitespace-nowrap text-[11px]">
                                        <div>{{ $item->created_at->format('M d, Y') }}</div>
                                        <div class="text-[10px] text-ink-muted/80">{{ $item->created_at->diffForHumans() }}</div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-2.5 sm:px-5 py-3.5 sm:py-4 text-right whitespace-nowrap space-x-1">
                                        <a
                                            href="{{ route('admin.inquiries.show', $item) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-brand-primary text-white hover:bg-brand-primary/90 transition-colors"
                                        >
                                            <span>Details</span>
                                            <x-icon name="chevron-right" class="w-3 h-3" />
                                        </a>

                                        <form action="{{ route('admin.inquiries.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Inquiry"
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

                {{-- Pagination --}}
                @if ($inquiries->hasPages())
                    <div class="px-5 py-3 border-t border-border-hairline bg-surface-canvas">
                        {{ $inquiries->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
