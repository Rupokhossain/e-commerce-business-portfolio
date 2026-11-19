@props([
    'name' => 'layers',
    'class' => 'w-5 h-5',
])

@switch($name)
    @case('phone')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        @break

    @case('mail')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="20" height="16" x="2" y="4" rx="2"/>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
        </svg>
        @break

    @case('clock')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
        </svg>
        @break

    @case('search')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.3-4.3"/>
        </svg>
        @break

    @case('chevron-down')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m6 9 6 6 6-6"/>
        </svg>
        @break

    @case('chevron-right')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m9 18 6-6-6-6"/>
        </svg>
        @break

    @case('chevron-left')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m15 18-6-6 6-6"/>
        </svg>
        @break

    @case('menu')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="4" x2="20" y1="12" y2="12"/>
            <line x1="4" x2="20" y1="6" y2="6"/>
            <line x1="4" x2="20" y1="18" y2="18"/>
        </svg>
        @break

    @case('x')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 6 6 18"/>
            <path d="m6 6 12 12"/>
        </svg>
        @break

    @case('arrow-right')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M5 12h14"/>
            <path d="m12 5 7 7-7 7"/>
        </svg>
        @break

    @case('arrow-up-right')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M7 7h10v10"/>
            <path d="M7 17 17 7"/>
        </svg>
        @break

    @case('scan-barcode')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 7V5a2 2 0 0 1 2-2h2"/>
            <path d="M17 3h2a2 2 0 0 1 2 2v2"/>
            <path d="M21 17v2a2 2 0 0 1-2 2h-2"/>
            <path d="M7 21H5a2 2 0 0 1-2-2v-2"/>
            <path d="M8 7v10"/>
            <path d="M12 7v10"/>
            <path d="M17 7v10"/>
        </svg>
        @break

    @case('radio')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/>
            <path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/>
            <circle cx="12" cy="12" r="2"/>
            <path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/>
            <path d="M19.1 4.9C23 8.8 23 15.1 19.1 19"/>
        </svg>
        @break

    @case('fingerprint')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4"/>
            <path d="M14 13.12c0 2.38 0 6.38-1 8.88"/>
            <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02"/>
            <path d="M2 12a10 10 0 0 1 18-6"/>
            <path d="M2 16h.01"/>
            <path d="M21.8 16c.2-2 .131-5.354 0-6"/>
            <path d="M5 19.5C5.5 18 6 15 6 12a6 6 0 0 1 .34-2"/>
            <path d="M8.65 22c.21-.66.45-1.32.57-2"/>
            <path d="M9 6.8a6 6 0 0 1 9 5.2v2"/>
        </svg>
        @break

    @case('shield-check')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>
            <path d="m9 12 2 2 4-4"/>
        </svg>
        @break

    @case('store')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/>
            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
            <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/>
            <path d="M2 7h20"/>
            <path d="M22 7v3a2 2 0 0 1-2 2a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12a2 2 0 0 1-2-2V7"/>
        </svg>
        @break

    @case('wrench')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
        </svg>
        @break

    @case('map-pin')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/>
            <circle cx="12" cy="10" r="3"/>
        </svg>
        @break

    @case('package')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/>
            <path d="M12 22V12"/>
            <path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/>
            <path d="m7.5 4.27 9 5.15"/>
        </svg>
        @break

    @case('briefcase')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
            <rect width="20" height="14" x="2" y="6" rx="2"/>
        </svg>
        @break

    @case('log-in')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <polyline points="10 17 15 12 10 7"/>
            <line x1="15" x2="3" y1="12" y2="12"/>
        </svg>
        @break

    @case('log-out')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" x2="9" y1="12" y2="12"/>
        </svg>
        @break

    @case('layout-dashboard')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="7" height="9" x="3" y="3" rx="1"/>
            <rect width="7" height="5" x="14" y="3" rx="1"/>
            <rect width="7" height="9" x="14" y="12" rx="1"/>
            <rect width="7" height="5" x="3" y="16" rx="1"/>
        </svg>
        @break

    @case('lock')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        @break

    @case('arrow-left')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m12 19-7-7 7-7"/>
            <path d="M19 12H5"/>
        </svg>
        @break

    @case('award')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
            <circle cx="12" cy="8" r="6"/>
        </svg>
        @break

    @case('building-2')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/>
            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/>
            <path d="M10 6h4"/>
            <path d="M10 10h4"/>
            <path d="M10 14h4"/>
            <path d="M10 18h4"/>
        </svg>
        @break

    @case('headphones')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a9 9 0 0 1 18 0v7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3"/>
        </svg>
        @break

    @case('check-circle-2')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"/>
            <path d="m9 12 2 2 4-4"/>
        </svg>
        @break

    @case('check')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 6 9 17l-5-5"/>
        </svg>
        @break

    @case('message-circle')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
        </svg>
        @break

    @case('whatsapp')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
        </svg>
        @break

    @case('monitor')
    @case('tv')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="20" height="14" x="2" y="3" rx="2"/>
            <line x1="8" x2="16" y1="21" y2="21"/>
            <line x1="12" x2="12" y1="17" y2="21"/>
        </svg>
        @break

    @case('video')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m22 8-6 4 6 4V8Z"/>
            <rect width="14" height="12" x="2" y="6" rx="2"/>
        </svg>
        @break

    @case('graduation-cap')
    @case('school')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
            <path d="M22 10v6"/>
            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
        </svg>
        @break

    @case('presentation')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M2 3h20"/>
            <path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"/>
            <path d="m7 21 5-5 5 5"/>
        </svg>
        @break

    @case('truck')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/>
            <path d="M15 18H9"/>
            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/>
            <circle cx="17" cy="18" r="2"/>
            <circle cx="7" cy="18" r="2"/>
        </svg>
        @break

    @case('external-link')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M15 3h6v6"/>
            <path d="M10 14 21 3"/>
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
        </svg>
        @break

    @case('sliders-horizontal')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="21" x2="14" y1="4" y2="4"/>
            <line x1="10" x2="3" y1="4" y2="4"/>
            <line x1="21" x2="12" y1="12" y2="12"/>
            <line x1="8" x2="3" y1="12" y2="12"/>
            <line x1="21" x2="16" y1="20" y2="20"/>
            <line x1="12" x2="3" y1="20" y2="20"/>
            <line x1="14" x2="14" y1="2" y2="6"/>
            <line x1="8" x2="8" y1="10" y2="14"/>
            <line x1="16" x2="16" y1="18" y2="22"/>
        </svg>
        @break

    @case('file-text')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
            <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
            <path d="M10 9H8"/>
            <path d="M16 13H8"/>
            <path d="M16 17H8"/>
        </svg>
        @break

    @case('tag')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"/>
            <circle cx="7.5" cy="7.5" r=".5" fill="currentColor"/>
        </svg>
        @break

    @case('factory')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/>
            <path d="M17 18h1"/>
            <path d="M12 18h1"/>
            <path d="M7 18h1"/>
        </svg>
        @break

    @case('send')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/>
            <path d="m21.854 2.147-10.94 10.939"/>
        </svg>
        @break

    @case('calendar')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M8 2v4"/>
            <path d="M16 2v4"/>
            <rect width="18" height="18" x="3" y="4" rx="2"/>
            <path d="M3 10h18"/>
        </svg>
        @break

    @case('plus')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M5 12h14"/>
            <path d="M12 5v14"/>
        </svg>
        @break

    @case('edit')
    @case('pencil')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
            <path d="m15 5 4 4"/>
        </svg>
        @break

    @case('trash')
    @case('trash-2')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 6h18"/>
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
            <line x1="10" x2="10" y1="11" y2="17"/>
            <line x1="14" x2="14" y1="11" y2="17"/>
        </svg>
        @break

    @case('inbox')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/>
            <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
        </svg>
        @break

    @case('settings')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
        @break

    @case('images')
    @case('image')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
            <circle cx="9" cy="9" r="2"/>
            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
        </svg>
        @break

    @case('eye')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
        @break

    @case('bell')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
        </svg>
        @break

    @case('activity')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
        </svg>
        @break

    @case('alert-circle')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" x2="12" y1="8" y2="12"/>
            <line x1="12" x2="12.01" y1="16" y2="16"/>
        </svg>
        @break

    @case('users')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        @break

    @case('server')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="20" height="8" x="2" y="2" rx="2" ry="2"/>
            <rect width="20" height="8" x="2" y="14" rx="2" ry="2"/>
            <line x1="6" x2="6.01" y1="6" y2="6"/>
            <line x1="6" x2="6.01" y1="18" y2="18"/>
        </svg>
        @break

    @case('facebook')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
        @break

    @case('linkedin')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
            <rect width="4" height="12" x="2" y="9"/>
            <circle cx="4" cy="4" r="2"/>
        </svg>
        @break

    @case('youtube')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/>
            <polygon points="10 15 15 12 10 9 10 15"/>
        </svg>
        @break

    @case('instagram')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
        </svg>
        @break

    @case('twitter')
    @case('x')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M4 4l11.733 16h4.267l-11.733 -16z"/>
            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
        </svg>
        @break

    @case('whatsapp')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/>
            <path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>
        </svg>
        @break

    @case('globe')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" x2="22" y1="12" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        @break

    @default
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/>
            <path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/>
            <path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>
        </svg>
@endswitch
