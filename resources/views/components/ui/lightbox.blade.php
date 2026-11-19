{{-- Reusable High-Res Image Lightbox Modal --}}
<div
    id="global-image-lightbox"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/85 backdrop-blur-md hidden opacity-0 transition-opacity duration-200 select-none"
    role="dialog"
    aria-modal="true"
    aria-label="Image Preview"
>
    {{-- Close Button (Top Right) --}}
    <button
        type="button"
        id="lightbox-close-btn"
        class="absolute top-4 right-4 sm:top-6 sm:right-6 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/25 hover:text-white transition-all cursor-pointer shadow-lg"
        aria-label="Close image popup"
        title="Close (Esc)"
    >
        <x-icon name="x" class="w-5 h-5" />
    </button>

    {{-- Main Image Container Box --}}
    <div id="lightbox-card" class="relative max-w-5xl max-h-[90vh] flex flex-col items-center transform scale-95 transition-transform duration-200">
        {{-- High-Res Image Display --}}
        <div class="relative max-h-[75vh] sm:max-h-[80vh] flex items-center justify-center p-2 rounded-2xl bg-white shadow-2xl overflow-hidden border border-white/20">
            <img
                id="lightbox-target-img"
                src=""
                alt="Enlarged Hardware View"
                class="max-w-full max-h-[72vh] sm:max-h-[78vh] w-auto h-auto object-contain rounded-xl"
            />
        </div>

        {{-- Floating Bottom Caption & Meta Info --}}
        <div id="lightbox-caption-box" class="mt-3 px-4 py-2 rounded-full bg-black/75 border border-white/15 text-white text-center shadow-lg backdrop-blur-xs max-w-xl truncate">
            <div id="lightbox-caption-title" class="text-xs sm:text-sm font-bold tracking-tight truncate"></div>
            <div id="lightbox-caption-sub" class="text-[10px] sm:text-xs text-white/70 truncate hidden"></div>
        </div>
    </div>
</div>

<script>
    (function() {
        const lightbox = document.getElementById('global-image-lightbox');
        const targetImg = document.getElementById('lightbox-target-img');
        const captionTitle = document.getElementById('lightbox-caption-title');
        const captionSub = document.getElementById('lightbox-caption-sub');
        const closeBtn = document.getElementById('lightbox-close-btn');
        const card = document.getElementById('lightbox-card');

        if (!lightbox) return;

        function openLightbox(src, title, sub) {
            if (!src) return;
            targetImg.src = src;
            captionTitle.textContent = title || 'Hardware Preview';

            if (sub) {
                captionSub.textContent = sub;
                captionSub.classList.remove('hidden');
            } else {
                captionSub.textContent = '';
                captionSub.classList.add('hidden');
            }

            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
                if (card) {
                    card.classList.remove('scale-95');
                    card.classList.add('scale-100');
                }
            }, 10);
            document.body.classList.add('overflow-hidden');
        }

        function closeLightbox() {
            lightbox.classList.add('opacity-0');
            if (card) {
                card.classList.remove('scale-100');
                card.classList.add('scale-95');
            }
            setTimeout(() => {
                lightbox.classList.add('hidden');
                targetImg.src = '';
                document.body.classList.remove('overflow-hidden');
            }, 200);
        }

        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

        lightbox.addEventListener('click', function(e) {
            // Close if clicking outside the image card
            if (e.target === lightbox || e.target.id === 'lightbox-card') {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
                closeLightbox();
            }
        });

        // Delegate click for any element with data-lightbox-src
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-lightbox-src]');
            if (trigger) {
                e.preventDefault();
                const src = trigger.getAttribute('data-lightbox-src');
                const title = trigger.getAttribute('data-lightbox-title');
                const sub = trigger.getAttribute('data-lightbox-sub');
                openLightbox(src, title, sub);
            }
        });

        window.openImageLightbox = openLightbox;
    })();
</script>
