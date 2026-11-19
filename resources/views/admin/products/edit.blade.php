<x-layouts.admin
    title="Edit Product: {{ $product->name }}"
    subtitle="Update specifications, photography and stock availability"
>
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <a
                href="{{ route('admin.products.index') }}"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink-secondary hover:text-brand-primary transition-colors"
            >
                <x-icon name="arrow-left" class="w-4 h-4" />
                <span>Back to Products</span>
            </a>

            <a
                href="{{ route('products.show', $product->slug) }}"
                target="_blank"
                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-border-hairline text-xs font-semibold text-ink-secondary hover:text-brand-primary bg-white transition-colors"
            >
                <x-icon name="eye" class="w-3.5 h-3.5" />
                <span>View Public Page</span>
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            @include('admin.products._form')
        </form>
    </div>
</x-layouts.admin>
