<x-layouts.admin
    title="Field Deployments & Gallery Management"
    subtitle="All active deployments appear directly on the public Field Deployments Gallery (/gallery) and the Home Showcase"
>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-bold">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $portfolios->total() }} Field Deployments</span>
                </span>
                <span class="hidden sm:inline text-xs text-ink-muted">Controlling Field Deployments Gallery (/gallery)</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-2.5 w-full sm:w-auto">
                <a
                    href="{{ route('gallery.index') }}"
                    target="_blank"
                    class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl border border-border-hairline bg-white hover:bg-surface-canvas text-xs font-bold text-ink-primary hover:text-brand-primary transition-colors shadow-2xs w-full sm:w-auto"
                >
                    <x-icon name="eye" class="w-4 h-4 text-brand-primary" />
                    <span>View Live Gallery</span>
                    <x-icon name="arrow-up-right" class="w-3.5 h-3.5 text-ink-muted" />
                </a>

                <a
                    href="{{ route('admin.portfolios.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-brand-primary text-white font-bold text-xs hover:bg-brand-primary/95 transition-colors shadow-xs w-full sm:w-auto"
                >
                    <x-icon name="plus" class="w-4 h-4 text-brand-accent" />
                    <span>Add Deployment Photo &amp; Case</span>
                </a>
            </div>
        </div>

        <div class="rounded-2xl border border-border-hairline bg-white shadow-xs overflow-hidden">
            @if ($portfolios->isEmpty())
                <div class="p-12 text-center text-ink-muted space-y-3">
                    <x-icon name="images" class="w-12 h-12 mx-auto text-ink-muted/30 mb-2" />
                    <h3 class="text-sm font-bold text-ink-primary">No deployments in gallery yet</h3>
                    <p class="text-xs text-ink-muted">Add your verified client deployments, photos, and operational capabilities to showcase in the gallery.</p>
                    <a
                        href="{{ route('admin.portfolios.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-primary text-white font-bold text-xs hover:bg-brand-primary/95 transition-colors"
                    >
                        <x-icon name="plus" class="w-4 h-4 text-brand-accent" />
                        <span>Add First Deployment</span>
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-canvas text-ink-muted font-bold uppercase tracking-wider text-[10px] border-b border-border-hairline">
                            <tr>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 w-14 sm:w-20">Photo</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5">Deployment Title &amp; Client</th>
                                <th class="hidden sm:table-cell px-5 py-3.5">Industry Sector</th>
                                <th class="hidden md:table-cell px-5 py-3.5">Key Metric / Hardware</th>
                                <th class="hidden sm:table-cell px-5 py-3.5 text-center">Gallery Status</th>
                                <th class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-hairline">
                            @foreach ($portfolios as $item)
                                <tr class="hover:bg-surface-canvas/50 transition-colors">
                                    {{-- Photo Thumbnail --}}
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5">
                                        <div class="w-12 h-9 sm:w-16 sm:h-12 rounded-lg bg-surface-subtle border border-border-hairline overflow-hidden shrink-0 shadow-2xs relative group">
                                            @if ($item->image_url)
                                                <img
                                                    src="{{ $item->image_url }}"
                                                    alt="{{ $item->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                                                />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-ink-muted">
                                                    <x-icon name="image" class="w-4 h-4 text-ink-muted/40" />
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Title & Client --}}
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 min-w-0">
                                        <div class="font-bold text-ink-primary hover:text-brand-primary transition-colors leading-snug">
                                            <a href="{{ route('admin.portfolios.edit', $item) }}">
                                                {{ $item->title }}
                                            </a>
                                        </div>
                                        <div class="text-[11px] text-ink-muted flex flex-wrap items-center gap-2 mt-0.5">
                                            <span class="font-semibold text-brand-primary">{{ $item->client_name }}</span>
                                            @if ($item->location)
                                                <span>•</span>
                                                <span class="flex items-center gap-0.5">
                                                    <x-icon name="map-pin" class="w-3 h-3 text-ink-muted" />
                                                    {{ $item->location }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="sm:hidden mt-1.5 flex flex-wrap items-center gap-1.5">
                                            @if ($item->is_active)
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.2 rounded text-[9px] font-bold bg-emerald-50 text-emerald-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    <span>Live</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-rose-50 text-rose-700">
                                                    Hidden
                                                </span>
                                            @endif
                                            @if ($item->is_featured)
                                                <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[9px] font-bold bg-amber-50 text-amber-700">
                                                    Featured
                                                </span>
                                            @endif
                                        </div>
                                        @if ($item->challenge_solution)
                                            <div class="hidden sm:block text-[11px] text-ink-secondary line-clamp-1 mt-1 italic">
                                                {{ Str::limit($item->challenge_solution, 80) }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Industry --}}
                                    <td class="hidden sm:table-cell px-5 py-3.5 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-brand-primary-soft text-brand-primary border border-brand-primary/20">
                                            {{ $item->industry }}
                                        </span>
                                    </td>

                                    {{-- Metric / Hardware --}}
                                    <td class="hidden md:table-cell px-5 py-3.5 whitespace-nowrap">
                                        @if ($item->results_metric)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                                <x-icon name="check-circle-2" class="w-3 h-3 text-emerald-600" />
                                                <span>{{ $item->results_metric }}</span>
                                            </span>
                                        @elseif (! empty($item->hardware_used))
                                            <span class="text-[11px] text-ink-muted font-mono">
                                                {{ implode(', ', array_slice($item->hardware_used, 0, 2)) }}
                                            </span>
                                        @else
                                            <span class="text-ink-muted">—</span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="hidden sm:table-cell px-5 py-3.5 text-center whitespace-nowrap">
                                        @if ($item->is_active)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                <span>Live in Gallery</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700">
                                                Hidden
                                            </span>
                                        @endif
                                        @if ($item->is_featured)
                                            <div class="text-[10px] font-bold text-amber-600 mt-0.5">Featured</div>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-2.5 sm:px-5 py-3 sm:py-3.5 text-right whitespace-nowrap space-x-0.5 sm:space-x-1">
                                        <a
                                            href="{{ route('admin.portfolios.edit', $item) }}"
                                            class="p-1.5 rounded-lg text-ink-muted hover:text-brand-primary hover:bg-surface-canvas transition-colors inline-block"
                                            title="Edit Deployment"
                                        >
                                            <x-icon name="edit" class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('admin.portfolios.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="redirect_to" value="{{ request()->fullUrl() }}" />
                                            <button
                                                type="submit"
                                                class="p-1.5 rounded-lg text-ink-muted hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                                                title="Delete Deployment"
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

                @if ($portfolios->hasPages())
                    <div class="px-5 py-3 border-t border-border-hairline bg-surface-canvas">
                        {{ $portfolios->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.admin>
