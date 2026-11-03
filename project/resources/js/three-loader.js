// SarkariCourse — Lazy-loads the Three.js hero bundle only on pages
// that actually contain a [data-three-hero] element, and only once
// it's near the viewport. Keeps the ~130kB (gzip) Three.js chunk off
// pages that don't need it (Contact, Legal, Blog listing, etc).
function bootThreeLoader() {
    const hasHero = document.querySelector('[data-three-hero]');
    if (!hasHero) return;

    const io = new IntersectionObserver((entries, observer) => {
        if (entries.some((e) => e.isIntersecting)) {
            import('./three-hero.js');
            observer.disconnect();
        }
    }, { rootMargin: '400px' });

    io.observe(hasHero);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootThreeLoader);
} else {
    bootThreeLoader();
}
