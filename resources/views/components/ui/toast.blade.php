{{-- Reusable Global Toast Notification System --}}
<div
    id="global-toast-container"
    class="fixed top-5 right-5 z-[99999] flex flex-col items-end gap-3 pointer-events-none w-auto max-w-[calc(100vw-2rem)]"
    role="region"
    aria-live="polite"
    aria-label="Notifications"
></div>

<style>
    @keyframes toast-progress {
        from { width: 100%; }
        to { width: 0%; }
    }
    .toast-progress-active {
        animation: toast-progress linear forwards;
    }
    .agy-toast-card {
        width: 380px !important;
        min-width: 320px !important;
        max-width: calc(100vw - 2rem) !important;
        box-sizing: border-box !important;
        display: flex !important;
        flex-direction: row !important;
        align-items: flex-start !important;
        gap: 14px !important;
    }
    .agy-toast-content {
        flex: 1 1 auto !important;
        min-width: 220px !important;
        box-sizing: border-box !important;
    }
    .agy-toast-title {
        font-size: 13px !important;
        font-weight: 700 !important;
        line-height: 1.3 !important;
        letter-spacing: -0.01em !important;
        color: #0f172a !important;
    }
    .agy-toast-msg {
        font-size: 12.5px !important;
        line-height: 1.5 !important;
        color: #475569 !important;
        margin-top: 2px !important;
        white-space: normal !important;
        word-break: normal !important;
        overflow-wrap: break-word !important;
        display: block !important;
        width: 100% !important;
    }
</style>

<script>
    (function() {
        const container = document.getElementById('global-toast-container');

        const icons = {
            success: `<svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`,
            error: `<svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
            warning: `<svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`,
            info: `<svg class="w-5 h-5 text-brand-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>`
        };

        const themes = {
            success: {
                badge: 'bg-emerald-50 border-emerald-200 text-emerald-800',
                border: 'border-emerald-200',
                bar: 'bg-emerald-500',
                title: 'Success'
            },
            error: {
                badge: 'bg-rose-50 border-rose-200 text-rose-800',
                border: 'border-rose-200',
                bar: 'bg-rose-500',
                title: 'Error'
            },
            warning: {
                badge: 'bg-amber-50 border-amber-200 text-amber-900',
                border: 'border-amber-200',
                bar: 'bg-amber-500',
                title: 'Warning'
            },
            info: {
                badge: 'bg-indigo-50 border-indigo-200 text-brand-primary',
                border: 'border-indigo-100',
                bar: 'bg-brand-primary',
                title: 'Notice'
            }
        };

        function showToast(message, type = 'success', duration = 4500, customTitle = null) {
            if (!container || !message) return;

            const safeType = themes[type] ? type : 'info';
            const theme = themes[safeType];
            const title = customTitle || theme.title;

            const toast = document.createElement('div');
            toast.className = `agy-toast-card pointer-events-auto relative overflow-hidden p-4 bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border ${theme.border} shrink-0 transform translate-x-12 opacity-0 transition-all duration-300 ease-out select-none`;
            toast.style.width = '380px';
            toast.style.minWidth = '320px';
            toast.style.maxWidth = 'calc(100vw - 2rem)';
            toast.style.boxSizing = 'border-box';

            toast.innerHTML = `
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl ${theme.badge} border shadow-xs mt-0.5">
                    ${icons[safeType]}
                </div>
                <div class="agy-toast-content flex-1 pr-2" style="min-width: 220px; width: calc(100% - 64px); box-sizing: border-box;">
                    <div class="agy-toast-title text-xs font-bold text-ink-primary tracking-tight">${title}</div>
                    <div class="agy-toast-msg">${message}</div>
                </div>
                <button
                    type="button"
                    class="shrink-0 p-1 rounded-lg text-ink-muted hover:text-ink-primary hover:bg-surface-neutral transition-colors cursor-pointer"
                    aria-label="Dismiss notification"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <div class="absolute bottom-0 left-0 h-1 ${theme.bar} transition-all duration-100" style="width: 100%;"></div>
            `;

            container.appendChild(toast);

            // Animate In
            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-12', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            });

            const progressBar = toast.querySelector('div:last-child');
            const closeBtn = toast.querySelector('button');

            let startTime = Date.now();
            let remaining = duration;
            let timerId = null;

            function dismiss() {
                if (timerId) clearTimeout(timerId);
                toast.classList.add('translate-x-12', 'opacity-0', 'scale-95');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }

            closeBtn.addEventListener('click', dismiss);

            function startTimer() {
                startTime = Date.now();
                if (progressBar) {
                    progressBar.style.transition = `width ${remaining}ms linear`;
                    progressBar.style.width = '0%';
                }
                timerId = setTimeout(dismiss, remaining);
            }

            function pauseTimer() {
                clearTimeout(timerId);
                const elapsed = Date.now() - startTime;
                remaining = Math.max(0, remaining - elapsed);
                if (progressBar) {
                    const currentWidth = (remaining / duration) * 100;
                    progressBar.style.transition = 'none';
                    progressBar.style.width = `${currentWidth}%`;
                }
            }

            toast.addEventListener('mouseenter', pauseTimer);
            toast.addEventListener('mouseleave', () => {
                if (remaining > 0) {
                    startTimer();
                } else {
                    dismiss();
                }
            });

            startTimer();
        }

        window.showToast = showToast;
        window.toast = showToast;

        // Auto-display Laravel session flashes upon page load
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToast(@json(session('success')), 'success');
            @endif

            @if (session('inquiry_submitted'))
                showToast(@json(session('inquiry_submitted')), 'success', 6500, 'Inquiry Sent');
            @endif

            @if (session('status'))
                showToast(@json(session('status')), 'info');
            @endif

            @if (session('error'))
                showToast(@json(session('error')), 'error', 6000);
            @endif

            @if (session('info'))
                showToast(@json(session('info')), 'info');
            @endif

            @if (session('warning'))
                showToast(@json(session('warning')), 'warning', 6000);
            @endif
        });
    })();
</script>
