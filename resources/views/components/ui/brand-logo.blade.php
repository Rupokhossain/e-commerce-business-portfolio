@props([
    'variant' => 'dark', // 'dark' for light backgrounds, 'light' for dark #100063 backgrounds
    'logoPath' => null,
    'companyName' => 'ProudRock Ltd.',
])

@php
    $primaryInk = $variant === 'light' ? '#FFFFFF' : '#100063';
    $cutoutBg = $variant === 'light' ? '#100063' : '#FFFFFF';

    $hasLogo = ! empty($logoPath);
    $resolvedLogoUrl = null;

    if ($hasLogo) {
        $cleanPath = trim($logoPath);
        if (str_starts_with($cleanPath, 'http://') || str_starts_with($cleanPath, 'https://')) {
            $resolvedLogoUrl = $cleanPath;
        } elseif (str_starts_with($cleanPath, 'storage/') || str_starts_with($cleanPath, 'images/')) {
            $resolvedLogoUrl = asset($cleanPath);
        } else {
            $resolvedLogoUrl = asset('storage/' . ltrim($cleanPath, '/'));
        }
    }
@endphp

@if ($hasLogo && $resolvedLogoUrl)
    <div {{ $attributes->merge(['class' => 'inline-flex items-center select-none']) }}>
        <img
            src="{{ $resolvedLogoUrl }}"
            alt="{{ $companyName }}"
            class="h-8 sm:h-9 max-h-9 w-auto object-contain drop-shadow-2xs"
        />
    </div>
@else
    <div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 sm:gap-2.5 select-none']) }}>
        <svg class="h-7 w-7 sm:h-8 sm:w-8 shrink-0" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path
                d="M6 7H22.5C29.4036 7 34 11.4 34 17.8C34 24.2 29.4036 28.5 22.5 28.5H15V33H6V7Z"
                fill="{{ $primaryInk }}"
            />
            <circle cx="21" cy="17.8" r="5.5" fill="{{ $cutoutBg }}" />
            <path
                d="M19.5 16.5C19.5 14.8 20.9 13.5 22.6 13.5C23.7 13.5 24.6 14 25.1 14.9L34.2 33H26.4L19.9 19.1C19.6 18.4 19.5 17.4 19.5 16.5Z"
                fill="#FFB200"
            />
        </svg>
        <span class="text-base min-[380px]:text-lg sm:text-[22px] font-semibold tracking-tight leading-none lowercase whitespace-nowrap">
            <span style="color: {{ $primaryInk }};">proud</span><span class="text-[#FFB200]">rock ltd.</span>
        </span>
    </div>
@endif
