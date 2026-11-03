// ============================================================
// SarkariCourse — Lottie helper (Phase: Final Completion)
// Lazy-loads the lottie-web player only when an element with
// [data-lottie="/path/to/file.json"] scrolls into view, and only
// if the browser doesn't prefer reduced motion. Keeps the player
// bundle off pages that don't use Lottie at all.
// ============================================================

let lottiePromise = null;
function loadPlayer() {
    if (!lottiePromise) lottiePromise = import('lottie-web');
    return lottiePromise;
}

async function mount(el) {
    if (el.dataset.lottieMounted) return;
    el.dataset.lottieMounted = '1';

    const { default: lottie } = await loadPlayer();
    lottie.loadAnimation({
        container: el,
        renderer: 'svg',
        loop: el.dataset.lottieLoop !== 'false',
        autoplay: true,
        path: el.dataset.lottie,
    });
}

function init() {
    const targets = document.querySelectorAll('[data-lottie]');
    if (!targets.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        // Respect reduced-motion: leave a static fallback (CSS already
        // provides one via the element's normal background/content).
        return;
    }

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                mount(entry.target);
                io.unobserve(entry.target);
            }
        });
    }, { rootMargin: '150px' });

    targets.forEach((el) => io.observe(el));
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

// Expose a manual mount for elements injected after page load (e.g. AI chat bubbles)
window.scLottieMount = mount;
