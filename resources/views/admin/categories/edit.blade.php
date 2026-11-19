<x-layouts.admin
    title="Edit Category: {{ $category->name }}"
    subtitle="Update category title, icon and display options"
>
    <div class="w-full max-w-5xl space-y-6">
        <div class="flex items-center justify-between">
            <a
                href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink-secondary hover:text-brand-primary transition-colors"
            >
                <x-icon name="arrow-left" class="w-4 h-4" />
                <span>Back to Categories</span>
            </a>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            @include('admin.categories._form')

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-border-hairline">
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2.5 rounded-xl border border-border-hairline text-xs font-semibold text-ink-secondary hover:bg-surface-canvas transition-colors"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary/95 transition-colors shadow-sm cursor-pointer"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
