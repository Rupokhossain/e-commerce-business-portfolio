<x-layouts.admin
    title="Add Principle Client"
    subtitle="Add a new corporate client or factory deployment to the marquee slider and profile"
>
    <div class="w-full max-w-5xl space-y-6">
        <div class="flex items-center justify-between">
            <a
                href="{{ route('admin.clients.index') }}"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink-secondary hover:text-brand-primary transition-colors"
            >
                <x-icon name="arrow-left" class="w-4 h-4" />
                <span>Back to Principle Clients</span>
            </a>
        </div>

        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @include('admin.clients._form')

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-border-hairline">
                <a
                    href="{{ route('admin.clients.index') }}"
                    class="px-4 py-2.5 rounded-xl border border-border-hairline text-xs font-semibold text-ink-secondary hover:bg-surface-canvas transition-colors"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-brand-primary text-white text-xs font-bold hover:bg-brand-primary/95 transition-colors shadow-sm cursor-pointer"
                >
                    Save Principle Client
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
