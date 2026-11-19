<x-layouts.admin
    title="Add New Hardware Product"
    subtitle="Create a new B2B catalog item with technical specs and availability"
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
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @include('admin.products._form')
        </form>
    </div>
</x-layouts.admin>
