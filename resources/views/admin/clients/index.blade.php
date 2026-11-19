<x-layouts.admin
    title="Principle Clients"
    subtitle="Manage factory, enterprise, and corporate client accounts displayed in company profile, logo sliders, and trust showcases"
>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-bold">
                    <x-icon name="building-2" class="w-3.5 h-3.5" />
                    <span>{{ $clients->total() }} Corporate Clients</span>
                </span>
            </div>

            <a
                href="{{ route('admin.clients.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-accent text-brand-primary font-bold text-xs hover:bg-brand-accent/90 transition-colors shadow-xs self-start sm:self-auto"
            >
                <x-icon name="plus" class="w-4 h-4" />
                <span>Add Principle Client</span>
            </a>
        </div>

        {{-- Filters & Search Bar --}}
        <div class="bg-white rounded-2xl border border-border-hairline p-4 shadow-xs">
            <form method="GET" action="{{ route('admin.clients.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                <div class="sm:col-span-8 relative">
                    <x-icon name="search" class="w-4 h-4 text-ink-muted absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search by client name, industry, location, or solution..."
                        class="w-full pl-9.5 pr-4 py-2 rounded-xl border border-border-hairline bg-surface-canvas text-xs focus:outline-hidden focus:border-brand-primary focus:bg-white transition-colors"
                    />
                </div>

                <div class="sm:col-span-4 flex items-center gap-2">
                    <select
                        name="status"
                        class="w-full py-2 px-3 rounded-xl border border-border-hairline bg-surface-canvas text-xs focus:outline-hidden focus:border-brand-primary"
                    >
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active Only</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Hidden Only</option>
                    </select>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-xl bg-brand-primary text-white text-xs font-semibold hover:bg-brand-primary-hover transition-colors shrink-0"
                    >
                        Filter
                    </button>

                    @if (request()->hasAny(['q', 'status']))
                        <a
                            href="{{ route('admin.clients.index') }}"
                            class="p-2 rounded-xl border border-border-hairline text-ink-muted hover:text-ink-primary hover:bg-surface-canvas shrink-0"
                            title="Clear Filters"
                        >
                            <x-icon name="x" class="w-4 h-4" />
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($clients->isEmpty())
                <div class="p-12 text-center text-ink-muted space-y-3">
                    <x-icon name="building-2" class="w-12 h-12 mx-auto text-ink-muted/30" />
                    <h3 class="text-sm font-bold text-ink-primary">No clients found</h3>
                    <p class="text-xs text-ink-muted">Add your first principle client or adjust your search filter.</p>
                    <a
                        href="{{ route('admin.clients.create') }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-brand-primary text-white text-xs font-semibold hover:bg-brand-primary-hover"
                    >
                        <x-icon name="plus" class="w-3.5 h-3.5" />
                        <span>Add Principle Client</span>
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 w-14 sm:w-28">Client Logo</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5">Client Name &amp; Sector</th>
                                <th class="hidden md:table-cell px-5 py-3.5">Location &amp; Solution</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Order</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Status</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($clients as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 whitespace-nowrap">
                                        <div class="h-8 w-12 sm:h-10 sm:w-24 rounded-lg border border-border-hairline p-0.5 sm:p-1 bg-white flex items-center justify-center overflow-hidden">
                                            @if ($item->logo_url)
                                                <img src="{{ $item->logo_url }}" alt="{{ $item->name }}" class="h-full w-full object-contain" />
                                            @else
                                                <span class="text-[9px] sm:text-[10px] font-bold text-brand-primary truncate">{{ $item->name }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 min-w-0">
                                        <div class="font-bold text-ink-primary leading-snug">{{ $item->name }}</div>
                                        <div class="text-[11px] text-ink-muted flex flex-wrap items-center gap-1.5 mt-0.5">
                                            <span>{{ $item->sector ?: 'Industrial & Corporate' }}</span>
                                            @if ($item->badge)
                                                <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-brand-primary-soft text-brand-primary">
                                                    {{ $item->badge }}
                                                </span>
                                            @endif
                                            @if ($item->is_active)
                                                <span class="sm:hidden inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-emerald-50 text-emerald-700">Active</span>
                                            @else
                                                <span class="sm:hidden inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-rose-50 text-rose-700">Hidden</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="hidden md:table-cell px-5 py-3.5 min-w-[220px]">
                                        <div class="text-ink-secondary truncate max-w-xs font-medium">
                                            {{ $item->solution_provided ?: 'Hardware integration & deployment' }}
                                        </div>
                                        @if ($item->location)
                                            <div class="text-[11px] text-ink-muted flex items-center gap-1 mt-0.5">
                                                <x-icon name="map-pin" class="w-3 h-3 text-brand-primary" />
                                                <span>{{ $item->location }}</span>
                                            </div>
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
                                            href="{{ route('admin.clients.edit', $item) }}"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="Edit Client"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>

                                        <form
                                            action="{{ route('admin.clients.destroy', $item) }}"
                                            method="POST"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Client"
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

                @if ($clients->hasPages())
                    <div class="px-5 py-3.5 border-t border-border-hairline bg-surface-canvas">
                        {{ $clients->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
