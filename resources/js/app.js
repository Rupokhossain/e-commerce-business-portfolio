document.addEventListener('DOMContentLoaded', () => {
    initPageProgressBar();
    initScrollReveal();
    initBackToTop();
    initFormSubmissionsLoading();
    initImageShimmerLoading();
    initHeaderDropdown();
    initQuickSearch();
    initMobileDrawer();
    initHeroSlider();
    initProductGallery();
});

/**
 * Global Page Loading Progress Bar
 * Provides instant feedback on page transitions and slow network/database requests.
 */
function initPageProgressBar() {
    let progressBar = document.getElementById('page-progress-bar');
    if (!progressBar) {
        progressBar = document.createElement('div');
        progressBar.id = 'page-progress-bar';
        document.body.prepend(progressBar);
    }

    let progressTimer = null;
    let progress = 0;

    const startProgress = () => {
        clearInterval(progressTimer);
        progress = 20;
        progressBar.classList.add('is-loading');
        progressBar.style.width = '20%';

        progressTimer = setInterval(() => {
            if (progress < 60) {
                progress += Math.floor(Math.random() * 8) + 4;
            } else if (progress < 85) {
                progress += Math.floor(Math.random() * 4) + 2;
            } else if (progress < 95) {
                progress += 1;
            }
            progressBar.style.width = `${progress}%`;
        }, 160);
    };

    const completeProgress = () => {
        clearInterval(progressTimer);
        progress = 100;
        progressBar.style.width = '100%';
        setTimeout(() => {
            progressBar.classList.remove('is-loading');
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 300);
        }, 200);
    };

    // Complete on initial load
    completeProgress();

    // Reset when page shown from bfcache
    window.addEventListener('pageshow', completeProgress);

    // Intercept internal link clicks to give instant feedback
    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');
        if (!link) return;

        const href = link.getAttribute('href');
        const target = link.getAttribute('target');

        // Ignore anchors, JS links, external links, file downloads, mailto/tel
        if (
            !href ||
            href.startsWith('#') ||
            href.startsWith('javascript:') ||
            href.startsWith('mailto:') ||
            href.startsWith('tel:') ||
            target === '_blank' ||
            link.hasAttribute('download') ||
            link.dataset.noProgress !== undefined ||
            event.ctrlKey ||
            event.metaKey ||
            event.shiftKey
        ) {
            return;
        }

        try {
            const url = new URL(href, window.location.origin);
            if (url.origin === window.location.origin && url.pathname !== window.location.pathname) {
                startProgress();
            }
        } catch {
            // Invalid URL, do nothing
        }
    });

    // Also trigger on form submissions
    document.addEventListener('submit', () => {
        startProgress();
    });
}

/**
 * Viewport Scroll-Reveal Animations
 * Automatically reveals elements with smooth micro-animations as they enter the screen.
 */
function initScrollReveal() {
    const targets = document.querySelectorAll(
        '.reveal-on-scroll, .reveal-from-left, .reveal-from-right, .reveal-scale, [data-reveal], [data-home-products] article, [data-home-categories] .group, [data-trust-strip] .flex, [data-gallery-card], [data-industries-grid] > div'
    );

    if (targets.length === 0) {
        return;
    }

    // Accessibility check: Immediately reveal without animation if prefers-reduced-motion is active
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        targets.forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    if (!('IntersectionObserver' in window)) {
        targets.forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    obs.unobserve(entry.target);
                }
            });
        },
        {
            rootMargin: '0px 0px 40px 0px',
            threshold: 0.02,
        }
    );

    targets.forEach((el) => {
        if (
            !el.classList.contains('reveal-on-scroll') &&
            !el.classList.contains('reveal-from-left') &&
            !el.classList.contains('reveal-from-right') &&
            !el.classList.contains('reveal-scale')
        ) {
            el.classList.add('reveal-on-scroll');
        }

        observer.observe(el);
    });

    // Fallback: If elements are already visible in viewport on initial load, reveal immediately
    requestAnimationFrame(() => {
        const vh = window.innerHeight || document.documentElement.clientHeight;
        targets.forEach((el) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < vh && rect.bottom > 0) {
                el.classList.add('is-revealed');
            }
        });
    });
}

/**
 * Floating Back-to-Top Button
 */
function initBackToTop() {
    const btn = document.getElementById('back-to-top-btn');
    if (!btn) return;

    let ticking = false;

    const checkScroll = () => {
        if (window.scrollY > 350) {
            btn.classList.remove('is-hidden');
            btn.classList.add('is-visible');
        } else {
            btn.classList.remove('is-visible');
            btn.classList.add('is-hidden');
        }
        ticking = false;
    };

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                window.requestAnimationFrame(checkScroll);
                ticking = true;
            }
        },
        { passive: true }
    );

    btn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    });
}

/**
 * Form Submission Loading State with Spinner
 * Gives immediate feedback and prevents duplicate form submissions.
 */
function initFormSubmissionsLoading() {
    const forms = document.querySelectorAll('form[method="POST"], form[method="post"]');

    forms.forEach((form) => {
        form.addEventListener('submit', () => {
            if (!form.checkValidity()) {
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            if (!submitBtn || submitBtn.dataset.loadingSubmitted) {
                return;
            }

            submitBtn.dataset.loadingSubmitted = 'true';
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-80', 'cursor-not-allowed');

            const originalContent = submitBtn.innerHTML;
            const originalWidth = submitBtn.offsetWidth;
            if (originalWidth > 0) {
                submitBtn.style.minWidth = `${originalWidth}px`;
            }

            submitBtn.innerHTML = `
                <span class="inline-flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Processing...</span>
                </span>
            `;

            setTimeout(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-80', 'cursor-not-allowed');
                    submitBtn.innerHTML = originalContent;
                    delete submitBtn.dataset.loadingSubmitted;
                }
            }, 15000);
        });
    });
}

/**
 * Image Shimmer Placeholder & Smooth Fade-in
 */
function initImageShimmerLoading() {
    const images = document.querySelectorAll('img[loading="lazy"]');

    images.forEach((img) => {
        if (img.complete) {
            img.classList.remove('opacity-0');
        } else {
            img.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            img.addEventListener('load', () => {
                img.classList.remove('opacity-0');
            }, { once: true });
        }
    });
}

function initHeaderDropdown() {
    const wrapper = document.querySelector('[data-products-dropdown]');
    const trigger = document.querySelector('[data-products-trigger]');
    const menu = document.querySelector('[data-products-menu]');

    if (!wrapper || !trigger || !menu) {
        return;
    }

    let closeTimer = null;

    const open = () => {
        clearTimeout(closeTimer);
        menu.classList.remove('hidden');
        trigger.setAttribute('aria-expanded', 'true');
    };

    const close = () => {
        menu.classList.add('hidden');
        trigger.setAttribute('aria-expanded', 'false');
    };

    wrapper.addEventListener('mouseenter', open);
    wrapper.addEventListener('mouseleave', () => {
        closeTimer = setTimeout(close, 140);
    });

    trigger.addEventListener('click', (event) => {
        event.preventDefault();
        const isOpen = trigger.getAttribute('aria-expanded') === 'true';
        if (isOpen) {
            close();
        } else {
            open();
        }
    });

    document.addEventListener('click', (event) => {
        if (!wrapper.contains(event.target)) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close();
        }
    });
}

function initQuickSearch() {
    const panel = document.querySelector('[data-search-panel]');
    const toggles = document.querySelectorAll('[data-search-toggle]');
    const closeBtn = document.querySelector('[data-search-close]');
    const input = document.querySelector('[data-search-input]');

    if (!panel || toggles.length === 0) {
        return;
    }

    const openSearch = () => {
        panel.classList.remove('hidden');
        toggles.forEach((btn) => btn.setAttribute('aria-expanded', 'true'));
        requestAnimationFrame(() => input?.focus());
    };

    const closeSearch = () => {
        panel.classList.add('hidden');
        toggles.forEach((btn) => btn.setAttribute('aria-expanded', 'false'));
    };

    toggles.forEach((btn) => {
        btn.addEventListener('click', () => {
            if (panel.classList.contains('hidden')) {
                openSearch();
            } else {
                closeSearch();
            }
        });
    });

    closeBtn?.addEventListener('click', closeSearch);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !panel.classList.contains('hidden')) {
            closeSearch();
        }
    });
}

function initMobileDrawer() {
    const drawer = document.querySelector('[data-mobile-drawer]');
    const openBtn = document.querySelector('[data-mobile-open]');
    const closeBtns = document.querySelectorAll('[data-mobile-close]');
    const accordionTrigger = document.querySelector('[data-mobile-products-toggle]');
    const accordionList = document.querySelector('[data-mobile-products-list]');
    const accordionIcon = document.querySelector('[data-mobile-products-icon]');

    if (!drawer || !openBtn) {
        return;
    }

    const openDrawer = () => {
        drawer.classList.remove('hidden');
        openBtn.setAttribute('aria-expanded', 'true');
        document.body.classList.add('overflow-hidden');
    };

    const closeDrawer = () => {
        drawer.classList.add('hidden');
        openBtn.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('overflow-hidden');
    };

    openBtn.addEventListener('click', openDrawer);
    closeBtns.forEach((btn) => btn.addEventListener('click', closeDrawer));

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !drawer.classList.contains('hidden')) {
            closeDrawer();
        }
    });

    accordionTrigger?.addEventListener('click', () => {
        const isHidden = accordionList?.classList.toggle('hidden');
        accordionTrigger.setAttribute('aria-expanded', String(!isHidden));
        accordionIcon?.classList.toggle('rotate-180', !isHidden);
    });
}

function initHeroSlider() {
    const slider = document.querySelector('[data-hero-slider]');
    const track = slider?.querySelector('[data-hero-track]');
    const slides = slider ? Array.from(slider.querySelectorAll('[data-hero-slide]')) : [];

    if (!slider || !track || slides.length <= 1) {
        return;
    }

    const dots = Array.from(slider.querySelectorAll('[data-hero-dot]'));
    const prevBtn = slider.querySelector('[data-hero-prev]');
    const nextBtn = slider.querySelector('[data-hero-next]');
    const progressBar = slider.querySelector('[data-hero-progress]');
    const intervalMs = Math.max(1500, Number(slider.dataset.autoplayMs || 5000));

    let current = 0;
    let timer = null;
    let touchStartX = 0;
    let touchStartY = 0;

    const restartProgress = () => {
        if (!progressBar) {
            return;
        }
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        void progressBar.offsetWidth;
        if (!document.hidden) {
            progressBar.style.transition = `width ${intervalMs}ms linear`;
            progressBar.style.width = '100%';
        }
    };

    const scheduleNext = () => {
        clearTimeout(timer);
        timer = null;

        if (document.hidden) {
            return;
        }

        restartProgress();
        timer = setTimeout(() => {
            goTo(current + 1);
        }, intervalMs);
    };

    const goTo = (index) => {
        current = (index + slides.length) % slides.length;
        track.style.transform = `translate3d(-${current * 100}%, 0, 0)`;

        dots.forEach((dot, idx) => {
            const active = idx === current;
            dot.setAttribute('aria-current', active ? 'true' : 'false');
            dot.classList.toggle('w-4', active);
            dot.classList.toggle('sm:w-6', active);
            dot.classList.toggle('bg-brand-accent', active);
            dot.classList.toggle('w-1.5', !active);
            dot.classList.toggle('sm:w-2', !active);
            dot.classList.toggle('bg-white/45', !active);
        });

        scheduleNext();
    };

    prevBtn?.addEventListener('click', () => {
        goTo(current - 1);
    });

    nextBtn?.addEventListener('click', () => {
        goTo(current + 1);
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const target = Number(dot.dataset.heroDot || 0);
            goTo(target);
        });
    });

    slider.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') {
            goTo(current - 1);
        } else if (event.key === 'ArrowRight') {
            goTo(current + 1);
        }
    });

    slider.addEventListener('touchstart', (event) => {
        const touch = event.changedTouches[0];
        touchStartX = touch?.clientX ?? 0;
        touchStartY = touch?.clientY ?? 0;
    }, { passive: true });

    slider.addEventListener('touchend', (event) => {
        const touch = event.changedTouches[0];
        const deltaX = (touch?.clientX ?? 0) - touchStartX;
        const deltaY = (touch?.clientY ?? 0) - touchStartY;

        if (Math.abs(deltaX) > 40 && Math.abs(deltaX) > Math.abs(deltaY)) {
            goTo(deltaX < 0 ? current + 1 : current - 1);
        }
    }, { passive: true });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            clearTimeout(timer);
            timer = null;
            if (progressBar) {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0%';
            }
        } else {
            scheduleNext();
        }
    });

    scheduleNext();
}

function initProductGallery() {
    const gallery = document.querySelector('[data-product-gallery]');
    const mainImage = gallery?.querySelector('[data-gallery-main]');
    const thumbs = gallery ? Array.from(gallery.querySelectorAll('[data-gallery-thumb]')) : [];

    if (!gallery || !mainImage || thumbs.length === 0) {
        return;
    }

    thumbs.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            const targetSrc = thumb.dataset.galleryThumb;
            if (!targetSrc || mainImage.src === targetSrc) {
                return;
            }

            mainImage.classList.add('opacity-40');
            const preloader = new Image();
            preloader.onload = () => {
                mainImage.src = targetSrc;
                mainImage.setAttribute('data-lightbox-src', targetSrc);
                mainImage.classList.remove('opacity-40');
            };
            preloader.onerror = () => {
                mainImage.src = targetSrc;
                mainImage.classList.remove('opacity-40');
            };
            preloader.src = targetSrc;

            const zoomBtn = gallery.querySelector('button[data-lightbox-src]');
            if (zoomBtn) {
                zoomBtn.setAttribute('data-lightbox-src', targetSrc);
            }

            thumbs.forEach((btn) => {
                const isSelected = btn === thumb;
                btn.classList.toggle('border-brand-primary', isSelected);
                btn.classList.toggle('ring-2', isSelected);
                btn.classList.toggle('ring-brand-primary/15', isSelected);
                btn.classList.toggle('border-border-hairline', !isSelected);
            });
        });
    });
}
