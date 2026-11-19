@php
    $enabled = ($siteSettings['trust_strip_enabled'] ?? '1') === '1';

    $metrics = collect([1, 2, 3, 4])
        ->map(fn (int $slot): array => [
            'value' => $siteSettings["trust_metric_{$slot}_value"] ?? null,
            'label' => $siteSettings["trust_metric_{$slot}_label"] ?? null,
            'icon' => $siteSettings["trust_metric_{$slot}_icon"] ?? 'check-circle-2',
        ])
        ->filter(fn (array $item): bool => filled($item['value']) && filled($item['label']))
        ->values();
@endphp

@if ($enabled && $metrics->isNotEmpty())
    <section
        data-trust-strip
        aria-label="Company capabilities and trust metrics"
        class="bg-white border-b border-border-hairline"
    >
        <div class="max-w-[1520px] mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-7">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4 lg:gap-0 lg:divide-x lg:divide-border-hairline">
                @foreach ($metrics as $metric)
                    <div class="flex items-center gap-3 sm:gap-3.5 rounded-xl border border-border-hairline bg-surface-subtle/45 p-3 sm:p-4 lg:rounded-none lg:border-0 lg:bg-transparent lg:px-6 lg:first:pl-0 lg:last:pr-0 lg:py-1">
                        <span class="flex h-9 w-9 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-lg bg-brand-primary-soft text-brand-primary">
                            <x-icon :name="$metric['icon']" class="w-4 h-4 sm:w-5 sm:h-5" />
                        </span>
                        <div class="min-w-0">
                            <div class="text-sm sm:text-lg lg:text-xl font-bold tracking-tight text-brand-primary leading-tight truncate">
                                {{ $metric['value'] }}
                            </div>
                            <div class="mt-0.5 text-[11px] sm:text-xs font-medium text-ink-secondary leading-snug line-clamp-2">
                                {{ $metric['label'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
