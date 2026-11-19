<x-layouts.admin
    title="Inquiry Details #{{ $inquiry->id }}"
    subtitle="Client quote inquiry received on {{ $inquiry->created_at->format('M d, Y h:i A') }}"
>
    <div class="w-full space-y-6">
        {{-- Back Link & Header Quick Actions --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <a
                href="{{ route('admin.inquiries.index') }}"
                class="inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-xl border border-border-hairline bg-white hover:bg-surface-canvas text-xs sm:text-sm font-bold text-ink-secondary hover:text-brand-primary shadow-xs transition-colors self-start sm:self-auto"
            >
                <x-icon name="arrow-left" class="w-4 h-4" />
                <span>Back to Inquiries</span>
            </a>

            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                @php
                    $cleanPhone = preg_replace('/[^0-9]/', '', $inquiry->phone);
                @endphp
                <a
                    href="tel:{{ $inquiry->phone }}"
                    class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-xl border border-border-hairline bg-white hover:bg-surface-canvas text-ink-primary text-xs sm:text-sm font-bold shadow-xs hover:border-brand-primary/40 transition-colors"
                >
                    <x-icon name="phone" class="w-4 h-4 text-brand-primary" />
                    <span>Call Phone</span>
                </a>

                @if ($cleanPhone)
                    <a
                        href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Hello ' . $inquiry->name . ', thank you for contacting ProudRock Ltd.') }}"
                        target="_blank"
                        rel="noopener"
                        class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold shadow-xs transition-colors"
                    >
                        <x-icon name="message-circle" class="w-4 h-4" />
                        <span>Chat WhatsApp</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            {{-- Left Column (8 cols): Client Details, Full Message & Hardware Showcase --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Client Info Card --}}
                <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-xs space-y-5">
                    <div class="flex flex-wrap items-start justify-between gap-4 border-b border-border-hairline pb-5">
                        <div class="space-y-1">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-ink-muted">Client Information</span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-ink-primary tracking-tight">{{ $inquiry->name }}</h2>
                            @if ($inquiry->company_name)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-brand-primary-soft text-brand-primary text-xs sm:text-sm font-semibold mt-1">
                                    <x-icon name="building-2" class="w-4 h-4 shrink-0" />
                                    <span>{{ $inquiry->company_name }}</span>
                                </div>
                            @endif
                        </div>

                        @php
                            $statusClasses = [
                                'new' => 'bg-amber-100 text-amber-900 border-amber-300',
                                'in_progress' => 'bg-blue-100 text-blue-900 border-blue-300',
                                'closed' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
                            ];
                            $statusLabels = [
                                'new' => '🟡 New (Unattended)',
                                'in_progress' => '🔵 In Progress',
                                'closed' => '🟢 Closed / Completed',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-bold border {{ $statusClasses[$inquiry->status] ?? 'bg-slate-100 text-slate-800' }}">
                            {{ $statusLabels[$inquiry->status] ?? ucfirst($inquiry->status) }}
                        </span>
                    </div>

                    {{-- Contact Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-surface-canvas border border-border-hairline space-y-1.5">
                            <div class="flex items-center justify-between text-ink-muted text-[11px] uppercase font-bold">
                                <span>Contact Phone</span>
                                <x-icon name="phone" class="w-3.5 h-3.5 text-brand-primary" />
                            </div>
                            <a
                                href="tel:{{ $inquiry->phone }}"
                                class="text-base sm:text-lg font-bold text-ink-primary hover:text-brand-primary font-mono tracking-wide block transition-colors"
                            >
                                {{ $inquiry->phone }}
                            </a>
                        </div>

                        <div class="p-4 rounded-xl bg-surface-canvas border border-border-hairline space-y-1.5">
                            <div class="flex items-center justify-between text-ink-muted text-[11px] uppercase font-bold">
                                <span>Email Address</span>
                                <x-icon name="mail" class="w-3.5 h-3.5 text-brand-primary" />
                            </div>
                            @if ($inquiry->email)
                                <a
                                    href="mailto:{{ $inquiry->email }}"
                                    class="text-base sm:text-lg font-bold text-ink-primary hover:text-brand-primary truncate block transition-colors"
                                >
                                    {{ $inquiry->email }}
                                </a>
                            @else
                                <span class="text-sm font-semibold text-ink-muted block">Not provided</span>
                            @endif
                        </div>
                    </div>

                    {{-- Subject & Full Message --}}
                    <div class="pt-2 space-y-3">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-ink-muted block mb-1">Inquiry Subject</span>
                            <div class="text-base font-bold text-ink-primary">{{ $inquiry->subject ?: 'Quotation & Consultation Request' }}</div>
                        </div>

                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-ink-muted block mb-1.5">Client Message</span>
                            <div class="p-5 sm:p-6 rounded-2xl bg-[#F8FAFC] border-l-4 border-l-brand-primary border-t border-r border-b border-border-hairline text-sm sm:text-base text-ink-primary leading-relaxed whitespace-pre-wrap font-normal shadow-2xs">
                                {{ $inquiry->message }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Attached Hardware Card (Bigger & Richer Showcase) --}}
                @if ($inquiry->product)
                    <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-border-hairline pb-3">
                            <div class="text-xs font-bold uppercase tracking-wider text-ink-primary flex items-center gap-2">
                                <x-icon name="package" class="w-4 h-4 text-brand-primary" />
                                <span>Requested Hardware System</span>
                            </div>
                            <span class="text-xs text-ink-muted">Inquired Item</span>
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 p-4 sm:p-5 rounded-2xl border border-border-hairline bg-surface-canvas">
                            {{-- Large Product Photo with Lightbox Zoom --}}
                            <div class="h-28 w-28 sm:h-32 sm:w-32 rounded-2xl border border-border-hairline bg-white p-2.5 shrink-0 flex items-center justify-center overflow-hidden relative group cursor-zoom-in shadow-2xs">
                                @if ($inquiry->product->image_url)
                                    <img
                                        src="{{ $inquiry->product->image_url }}"
                                        alt="{{ $inquiry->product->name }}"
                                        data-lightbox-src="{{ $inquiry->product->image_url }}"
                                        data-lightbox-title="{{ $inquiry->product->name }}"
                                        data-lightbox-sub="{{ $inquiry->product->category->name ?? 'Hardware' }}{{ $inquiry->product->model_number ? ' · Model: ' . $inquiry->product->model_number : '' }}"
                                        class="h-full w-full object-contain group-hover:scale-105 transition-transform"
                                        title="Click to zoom in"
                                    />
                                    <span class="absolute bottom-1.5 right-1.5 p-1 rounded-md bg-black/60 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-icon name="maximize" class="w-3 h-3" />
                                    </span>
                                @else
                                    <x-icon name="package" class="w-12 h-12 text-ink-muted/50" />
                                @endif
                            </div>

                            <div class="min-w-0 flex-1 space-y-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold">
                                        {{ $inquiry->product->category->name ?? 'Hardware' }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full border text-[11px] font-semibold {{ $inquiry->product->availability_classes }}">
                                        {{ $inquiry->product->availability_label }}
                                    </span>
                                    @if ($inquiry->product->model_number)
                                        <span class="text-xs text-ink-muted font-mono">Model: {{ $inquiry->product->model_number }}</span>
                                    @endif
                                </div>

                                <h4 class="text-base sm:text-lg font-bold text-ink-primary leading-snug">
                                    {{ $inquiry->product->name }}
                                </h4>

                                @if ($inquiry->product->short_description)
                                    <p class="text-xs text-ink-secondary line-clamp-2">
                                        {{ $inquiry->product->short_description }}
                                    </p>
                                @endif

                                <div class="flex flex-wrap items-center gap-3 pt-1">
                                    <a
                                        href="{{ route('products.show', $inquiry->product->slug) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border-hairline bg-white hover:bg-surface-subtle text-xs font-bold text-brand-primary transition-colors shadow-2xs"
                                    >
                                        <span>View Public Page</span>
                                        <x-icon name="external-link" class="w-3.5 h-3.5" />
                                    </a>

                                    <a
                                        href="{{ route('admin.products.edit', $inquiry->product) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border-hairline bg-white hover:bg-surface-subtle text-xs font-bold text-ink-secondary hover:text-ink-primary transition-colors shadow-2xs"
                                    >
                                        <x-icon name="edit-3" class="w-3.5 h-3.5" />
                                        <span>Edit Product</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Column (4 cols): Lead Status, Internal Notes & Danger Zone --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="rounded-2xl border border-border-hairline bg-white p-6 sm:p-7 shadow-xs space-y-5 sticky top-20">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-ink-primary flex items-center gap-2 border-b border-border-hairline pb-3">
                        <x-icon name="activity" class="w-4 h-4 text-brand-primary" />
                        <span>Update Lead Status &amp; Notes</span>
                    </h3>

                    <form action="{{ route('admin.inquiries.status', $inquiry) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="status" class="block text-xs font-bold text-ink-primary mb-1.5">Lead Status</label>
                            <select
                                name="status"
                                id="status"
                                class="w-full rounded-xl border border-border-hairline bg-white px-3.5 py-2.5 text-xs sm:text-sm font-semibold focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                            >
                                <option value="new" @selected($inquiry->status === 'new')>🟡 New (Unattended)</option>
                                <option value="in_progress" @selected($inquiry->status === 'in_progress')>🔵 In Progress (Quote Sent / Contacted)</option>
                                <option value="closed" @selected($inquiry->status === 'closed')>🟢 Closed (Deal Finalized / Completed)</option>
                            </select>
                        </div>

                        <div>
                            <label for="admin_notes" class="block text-xs font-bold text-ink-primary mb-1.5">Internal Admin Notes</label>
                            <textarea
                                name="admin_notes"
                                id="admin_notes"
                                rows="6"
                                placeholder="e.g. Spoke with client via phone, sent quotation PDF for 10 units..."
                                class="w-full rounded-xl border border-border-hairline bg-white p-3.5 text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary"
                            >{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                            <p class="text-[10px] text-ink-muted mt-1">These notes are visible to administrators only.</p>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-3 rounded-xl bg-brand-primary text-white text-xs sm:text-sm font-bold hover:bg-brand-primary/95 transition-colors cursor-pointer shadow-md"
                        >
                            Save Changes
                        </button>
                    </form>
                </div>

                {{-- Danger Zone Box --}}
                <div class="rounded-2xl border border-rose-200 bg-rose-50/50 p-6 shadow-xs space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-rose-900 flex items-center gap-1.5">
                        <x-icon name="trash-2" class="w-4 h-4 text-rose-600" />
                        <span>Danger Zone</span>
                    </h4>
                    <p class="text-xs text-rose-700">Permanently delete this inquiry from the database.</p>
                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="w-full py-2.5 rounded-xl bg-white border border-rose-300 text-rose-700 hover:bg-rose-100 text-xs font-bold transition-colors cursor-pointer shadow-2xs"
                        >
                            Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
