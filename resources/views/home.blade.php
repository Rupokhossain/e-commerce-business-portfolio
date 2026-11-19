<x-layouts.app title="Home">
    {{-- Full-Width Dynamic Hero Banner Slider --}}
    <x-home.hero-slider :slides="$heroSlides" />

    {{-- Dynamic Trust Metrics & Capability Strip --}}
    <x-home.trust-strip />

    {{-- Dynamic Core Solution Categories Marquee --}}
    <x-home.categories-section :categories="$homeCategories" />

    {{-- Dynamic Featured Products Showcase (Zero Cart / Zero Order) --}}
    <x-home.featured-products :products="$featuredProducts" />

    {{-- Authorized OEM Brand Partners Strip --}}
    <x-home.brand-partners :brands="$brandPartners" />

    {{-- In-House Barcode Label & Thermal Ribbon Manufacturing & Converting Plant --}}
    <x-home.manufacturing-section />

    {{-- Industries Served (Visual Bento Grid, Zero Paragraph Clutter) --}}
    <x-home.industries-section />

    {{-- Direct B2B Consultation & Quote CTA Banner --}}
    <x-home.cta-banner />
</x-layouts.app>