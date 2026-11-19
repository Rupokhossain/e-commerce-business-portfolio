<x-layouts.app title="Products">
    {{-- Page Header Banner --}}
    <section class="bg-white border-b border-border-hairline py-8 sm:py-10">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-ink-muted mb-3" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                <span class="text-ink-primary font-medium">Products</span>
                @if ($activeCategory)
                    <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                    <span class="text-brand-primary font-semibold">{{ $activeCategory->name }}</span>
                @endif
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-ink-primary">
                        {{ $activeCategory ? $activeCategory->name : 'All Hardware & Automation Products' }}
                    </h1>
                    <p class="mt-2 max-w-2xl text-sm sm:text-base text-ink-secondary">
                        {{ $activeCategory?->short_description ?: 'Browse genuine B2B hardware, inspect technical specifications, and inquire directly via phone or WhatsApp for corporate quotes.' }}
                    </p>
                </div>

                <span class="inline-flex items-center gap-2 self-start md:self-auto px-3.5 py-1.5 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold">
                    <x-icon name="package" class="w-4 h-4" />
                    <span>{{ $products->total() }} {{ Str::plural('Product', $products->total()) }} Found</span>
                </span>
            </div>
        </div>
    </section>

    {{-- Filter Bar + Product Catalog --}}
    <section class="py-8 sm:py-12">
        <div class="max-w-[1520px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            {{-- Responsive Category Chips --}}
            @if ($categories->isNotEmpty())
                <div class="flex items-center gap-2 overflow-x-auto pb-1">
                    <a
                        href="{{ route('products.index', array_filter(['q' => $searchQuery, 'brand' => $activeBrand, 'sort' => $sort !== 'featured' ? $sort : null])) }}"
                        class="shrink-0 px-3.5 py-2 rounded-lg text-xs sm:text-sm font-medium border transition-colors {{ ! $activeCategory ? 'bg-brand-primary text-white border-brand-primary' : 'bg-white text-ink-secondary border-border-hairline hover:border-brand-primary/40 hover:text-brand-primary' }}"
                    >
                        All Categories
                    </a>
                    @foreach ($categories as $category)
                        <a
                            href="{{ route('products.index', array_filter(['category' => $category->slug, 'q' => $searchQuery, 'brand' => $activeBrand, 'sort' => $sort !== 'featured' ? $sort : null])) }}"
                            class="shrink-0 inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs sm:text-sm font-medium border transition-colors {{ $activeCategory?->id === $category->id ? 'bg-brand-primary text-white border-brand-primary' : 'bg-white text-ink-secondary border-border-hairline hover:border-brand-primary/40 hover:text-brand-primary' }}"
                        >
                            <x-icon :name="$category->icon ?: 'layers'" class="w-3.5 h-3.5 {{ $activeCategory?->id === $category->id ? 'text-brand-accent' : 'text-brand-primary' }}" />
                            <span>{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Access Control & Biometrics Dedicated Client Banner --}}
            @if ($activeCategorySlug === 'access-control-biometrics' || ($activeCategory && str_contains($activeCategory->slug, 'access-control')))
                <x-access-control-banner context="category" />
            @endif

            {{-- Barcode & Auto-ID In-House Manufacturing & Consumables Banner --}}
            @if ($activeCategorySlug === 'barcode-auto-id' || ($activeCategory && str_contains($activeCategory->slug, 'barcode')))
                <x-barcode-manufacturing-banner context="category" />
            @endif

            {{-- Search + Brand + Sort Filter Form --}}
            <form
                action="{{ route('products.index') }}"
                method="GET"
                class="bg-white rounded-xl border border-border-hairline p-4 shadow-(--shadow-card) grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center"
            >
                @if ($activeCategorySlug)
                    <input type="hidden" name="category" value="{{ $activeCategorySlug }}" />
                @endif

                <div class="sm:col-span-2 lg:col-span-5 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-ink-muted">
                        <x-icon name="search" class="w-4 h-4" />
                    </span>
                    <input
                        type="search"
                        name="q"
                        value="{{ $searchQuery }}"
                        placeholder="Search by product name, model, SKU, or brand..."
                        class="w-full h-10 pl-10 pr-3 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary placeholder:text-ink-muted focus:border-brand-primary focus:bg-white focus:outline-none"
                    />
                </div>

                <div class="lg:col-span-3">
                    <select
                        name="brand"
                        aria-label="Filter by brand"
                        class="w-full h-10 px-3 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                    >
                        <option value="">All Brands</option>
                        @foreach ($brands as $brandName)
                            <option value="{{ $brandName }}" @selected($activeBrand === $brandName)>
                                {{ $brandName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="lg:col-span-2">
                    <select
                        name="sort"
                        aria-label="Sort products"
                        class="w-full h-10 px-3 rounded-lg border border-border-hairline bg-surface-canvas text-sm text-ink-primary focus:border-brand-primary focus:bg-white focus:outline-none"
                    >
                        <option value="featured" @selected($sort === 'featured')>Featured</option>
                        <option value="name_asc" @selected($sort === 'name_asc')>Name: A to Z</option>
                        <option value="latest" @selected($sort === 'latest')>Latest Added</option>
                    </select>
                </div>

                <div class="sm:col-span-2 lg:col-span-2 flex items-center gap-2">
                    <x-ui.button type="submit" variant="primary" size="md" class="flex-1 h-10">
                        Apply
                    </x-ui.button>
                    @if ($activeCategorySlug !== '' || $activeBrand !== '' || $searchQuery !== '' || $sort !== 'featured')
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex h-10 px-3 items-center justify-center rounded-lg border border-border-hairline text-xs font-medium text-ink-secondary hover:text-brand-primary hover:border-brand-primary/40 transition-colors"
                        >
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Products Grid --}}
            @if ($products->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5 lg:gap-6">
                    @foreach ($products as $product)
                        <x-product.card :product="$product" />
                    @endforeach
                </div>

                @if ($products->hasPages())
                    <div class="pt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-xl border border-border-hairline p-10 sm:p-14 text-center shadow-(--shadow-card)">
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-primary-soft text-brand-primary">
                        <x-icon name="search" class="w-6 h-6" />
                    </span>
                    <h2 class="mt-4 text-lg font-semibold text-ink-primary">
                        No matching hardware found
                    </h2>
                    <p class="mt-1.5 text-sm text-ink-secondary max-w-md mx-auto">
                        Try clearing a filter or contact our technical sales desk if you are sourcing a specific model.
                    </p>
                    <div class="mt-5 flex flex-wrap items-center justify-center gap-3">
                        <x-ui.button :href="route('products.index')" variant="outline" size="md">
                            Reset All Filters
                        </x-ui.button>
                        <x-ui.button :href="route('contact.index')" variant="primary" size="md">
                            Ask for Custom Sourcing
                        </x-ui.button>
                    </div>
                </div>
            @endif

            {{-- Interactive Flat Panel Solution & Sizing Guide (When Category Selected) --}}
            @if ($activeCategorySlug === 'interactive-flat-panel-displays' || ($activeCategory && str_contains($activeCategory->slug, 'interactive')))
                <div class="pt-8 sm:pt-12 border-t border-border-hairline/80">
                    <x-interactive-panel-guide context="catalog" />
                </div>
            @elseif (! $activeCategory)
                {{-- Quick Discovery Banner for Interactive Displays when browsing all categories --}}
                <div class="rounded-2xl border border-border-hairline bg-gradient-to-r from-brand-primary/5 via-white to-brand-accent/10 p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary text-white text-xs font-semibold mb-2">
                            <x-icon name="monitor" class="w-3.5 h-3.5 text-brand-accent" />
                            <span>Featured Technology Solution</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-ink-primary">
                            Interactive Flat Panel Displays for Classrooms &amp; Boardrooms
                        </h3>
                        <p class="mt-1 text-xs sm:text-sm text-ink-secondary">
                            Explore 65″, 75″, 86″ &amp; 98″ 4K UHD smart whiteboards from BenQ, Hikvision, Dahua, and METZ. Compare room sizes and technology vs projectors.
                        </p>
                    </div>
                    <div class="shrink-0">
                        <x-ui.button
                            :href="route('products.index', ['category' => 'interactive-flat-panel-displays'])"
                            variant="primary"
                            size="md"
                            class="gap-1.5"
                        >
                            <span>View Interactive Panels &amp; Buying Guide</span>
                            <x-icon name="arrow-right" class="w-4 h-4" />
                        </x-ui.button>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
