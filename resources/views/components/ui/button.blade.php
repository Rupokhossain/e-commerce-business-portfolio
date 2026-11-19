@props([
    'variant' => 'primary', // primary, accent, outline, ghost
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center gap-2 font-medium rounded-lg transition-all duration-200 ease-out cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed whitespace-nowrap';

    $variants = [
        'primary' => 'bg-brand-primary text-white hover:bg-brand-primary-hover shadow-xs hover:-translate-y-0.5',
        'accent' => 'bg-brand-accent text-brand-primary font-semibold hover:bg-brand-accent-hover shadow-xs hover:-translate-y-0.5',
        'outline' => 'border border-border-hairline bg-white text-ink-primary hover:border-brand-primary/40 hover:text-brand-primary hover:bg-brand-primary-soft/40',
        'ghost' => 'text-ink-secondary hover:text-brand-primary hover:bg-brand-primary-soft/60',
    ];

    $sizes = [
        'sm' => 'px-3.5 py-2 text-xs',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-6 py-3 text-sm sm:text-base',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
