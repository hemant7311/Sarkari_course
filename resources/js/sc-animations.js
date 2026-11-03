// ============================================================
// SarkariCourse — Global Animation Engine (Phase 2)
// Lenis smooth scroll + GSAP ScrollTrigger reveal system.
// Applies to any element carrying a `reveal-*` class, no per-page
// JS needed — pages just add the class in Blade markup.
// ============================================================
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

gsap.registerPlugin(ScrollTrigger);

function initLenis() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const lenis = new Lenis({ duration: 1.1, smoothWheel: true });
    lenis.on('scroll', ScrollTrigger.update);
    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);
    window.scLenis = lenis;
}

function initReveals() {
    const map = [
        ['.reveal-up', { y: 46, opacity: 0 }, { y: 0, opacity: 1 }],
        ['.reveal-left', { x: -46, opacity: 0 }, { x: 0, opacity: 1 }],
        ['.reveal-right', { x: 46, opacity: 0 }, { x: 0, opacity: 1 }],
        ['.reveal-scale', { scale: 0.88, opacity: 0 }, { scale: 1, opacity: 1 }],
    ];

    map.forEach(([selector, from, to]) => {
        document.querySelectorAll(selector).forEach((el, i) => {
            gsap.fromTo(el, from, {
                ...to,
                duration: 0.9,
                ease: 'power3.out',
                delay: (i % 4) * 0.08,
                scrollTrigger: { trigger: el, start: 'top 88%', once: true },
            });
        });
    });

    // Stagger groups: any [data-reveal-group] reveals its direct children in sequence
    document.querySelectorAll('[data-reveal-group]').forEach((group) => {
        const items = group.children;
        gsap.fromTo(items, { y: 34, opacity: 0 }, {
            y: 0, opacity: 1, duration: 0.7, ease: 'power3.out', stagger: 0.1,
            scrollTrigger: { trigger: group, start: 'top 85%', once: true },
        });
    });

    // Animated counters: <span data-counter="1500" data-suffix="+">
    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = parseFloat(el.dataset.counter);
        const suffix = el.dataset.suffix || '';
        const obj = { val: 0 };
        gsap.to(obj, {
            val: target, duration: 1.6, ease: 'power2.out',
            scrollTrigger: { trigger: el, start: 'top 90%', once: true },
            onUpdate: () => { el.textContent = Math.floor(obj.val).toLocaleString('en-IN') + suffix; },
        });
    });
}

function initMagneticButtons() {
    document.querySelectorAll('.sc-btn-primary, .sc-btn-outline').forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const r = btn.getBoundingClientRect();
            const x = e.clientX - r.left - r.width / 2;
            const y = e.clientY - r.top - r.height / 2;
            gsap.to(btn, { x: x * 0.18, y: y * 0.3, duration: 0.3, ease: 'power2.out' });
        });
        btn.addEventListener('mouseleave', () => gsap.to(btn, { x: 0, y: 0, duration: 0.4, ease: 'elastic.out(1,0.4)' }));
    });
}

function initCursor() {
    if (!window.matchMedia('(pointer: fine)').matches) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const dot = document.createElement('div');
    const ring = document.createElement('div');
    dot.className = 'sc-cursor-dot';
    ring.className = 'sc-cursor-ring';
    document.body.append(dot, ring);

    let mx = 0, my = 0, rx = 0, ry = 0;
    window.addEventListener('mousemove', (e) => {
        mx = e.clientX; my = e.clientY;
        dot.style.transform = `translate(${mx}px, ${my}px)`;
        const target = e.target.closest('a, button, .sc-card, input, textarea, [role="button"]');
        ring.classList.toggle('sc-cursor-ring--active', !!target);
    });

    function raf() {
        rx += (mx - rx) * 0.18;
        ry += (my - ry) * 0.18;
        ring.style.transform = `translate(${rx}px, ${ry}px)`;
        requestAnimationFrame(raf);
    }
    raf();

    document.addEventListener('mouseleave', () => { dot.style.opacity = '0'; ring.style.opacity = '0'; });
    document.addEventListener('mouseenter', () => { dot.style.opacity = '1'; ring.style.opacity = '1'; });
}

function initFormLoadingStates() {
    // Any POST form's submit button gets a disabled + "loading" visual state
    // while the page navigates away — pure UX polish, no validation logic touched.
    document.querySelectorAll('form').forEach((form) => {
        if (form.method?.toLowerCase() !== 'post' || form.hasAttribute('data-no-loading')) return;
        if (form.hasAttribute('onsubmit')) return; // e.g. delete-confirmation forms — don't risk a stuck button if the user cancels
        form.addEventListener('submit', () => {
            const btn = form.querySelector('button[type="submit"]');
            if (!btn || btn.disabled) return;
            btn.dataset.originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.style.opacity = '.75';
            btn.style.cursor = 'wait';
            btn.innerHTML = '<span class="sc-btn-spinner" aria-hidden="true"></span> Please wait…';
        });
    });
}

function initTestimonialsSlider() {
    const prevBtn = document.getElementById('testi-prev-btn');
    const nextBtn = document.getElementById('testi-next-btn');
    const dots = document.querySelectorAll('#scTestiDots .sc-dot');
    const cards = document.querySelectorAll('.sc-testi-card');

    if (!cards.length) return;

    let current = 0;
    const total = cards.length;

    function updateSlider(idx) {
        current = (idx + total) % total;

        dots.forEach((d, i) => {
            d.classList.toggle('is-active', i === current);
        });

        cards.forEach((card, i) => {
            if (i === current) {
                gsap.to(card, { scale: 1.04, opacity: 1, duration: 0.35, ease: 'power2.out' });
                card.style.borderColor = '#c4b5fd';
                card.style.boxShadow = '0 16px 40px rgba(109,40,217,.14)';
            } else {
                gsap.to(card, { scale: 1, opacity: 0.88, duration: 0.35, ease: 'power2.out' });
                card.style.borderColor = 'var(--sc-border)';
                card.style.boxShadow = 'none';
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => updateSlider(current - 1));
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', () => updateSlider(current + 1));
    }
    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => updateSlider(idx));
    });

    updateSlider(0);
}

function init() {
    initLenis();
    initReveals();
    initMagneticButtons();
    initCursor();
    initFormLoadingStates();
    initTestimonialsSlider();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
