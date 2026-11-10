import Lenis from "lenis";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { createIcons, icons } from "lucide";

gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia(
  "(prefers-reduced-motion: reduce)"
).matches;

/* ---------------------------------------------------------------------
   Icons
   ------------------------------------------------------------------ */
createIcons({ icons });

/* ---------------------------------------------------------------------
   Animated icon fallback
   Lordicon (Lottie-based) icons are used for decorative/notification
   spots via the <x-animated-icon> component. If the Lordicon CDN is
   blocked or slow (offline dev, corporate firewall, ad-blockers), swap
   each one for its static Lucide equivalent after a short grace period
   so the UI never shows an empty box.
   ------------------------------------------------------------------ */
document.querySelectorAll(".animated-icon").forEach((wrapper) => {
  const fallbackName = wrapper.getAttribute("data-fallback-icon");
  if (!fallbackName) return;

  const swapToFallback = () => {
    if (wrapper.dataset.swapped) return;
    wrapper.dataset.swapped = "true";
    const size = wrapper.getAttribute("data-icon-size") || 32;
    wrapper.innerHTML = "";
    const icon = document.createElement("i");
    icon.setAttribute("data-lucide", fallbackName);
    icon.style.width = `${size}px`;
    icon.style.height = `${size}px`;
    wrapper.appendChild(icon);
    createIcons({ icons });
  };

  // If the lord-icon custom element never registers (script blocked/offline),
  // fall back after a short grace period.
  window.setTimeout(() => {
    if (!customElements.get("lord-icon")) {
      swapToFallback();
    }
  }, 2500);
});

/* ---------------------------------------------------------------------
   Smooth scroll (Lenis) — skipped entirely for reduced-motion users
   ------------------------------------------------------------------ */
let lenis;
if (!prefersReducedMotion) {
  lenis = new Lenis({
    duration: 1.1,
    smoothWheel: true,
  });

  lenis.on("scroll", ScrollTrigger.update);

  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });
  gsap.ticker.lagSmoothing(0);
}

/* ---------------------------------------------------------------------
   Mobile navigation toggle
   ------------------------------------------------------------------ */
const navToggle = document.querySelector("[data-nav-toggle]");
const mobileMenu = document.querySelector("[data-mobile-menu]");

if (navToggle && mobileMenu) {
  navToggle.addEventListener("click", () => {
    const isOpen = mobileMenu.classList.toggle("is-open");
    navToggle.setAttribute("aria-expanded", String(isOpen));
    document.body.classList.toggle("overflow-hidden", isOpen);
  });

  mobileMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("is-open");
      navToggle.setAttribute("aria-expanded", "false");
      document.body.classList.remove("overflow-hidden");
    });
  });
}

/* ---------------------------------------------------------------------
   Header shadow on scroll
   ------------------------------------------------------------------ */
const header = document.querySelector("[data-site-header]");
if (header) {
  ScrollTrigger.create({
    start: "top -10",
    onUpdate: (self) => {
      header.classList.toggle("is-scrolled", self.scroll() > 10);
    },
  });
}

/* ---------------------------------------------------------------------
   Scroll-triggered reveal animations
   Applies to any element with [data-animate]. Optional data-animate-group
   groups siblings into a staggered reveal.
   ------------------------------------------------------------------ */
if (!prefersReducedMotion) {
  const groups = new Map();

  document.querySelectorAll("[data-animate]").forEach((el) => {
    const groupKey = el.getAttribute("data-animate-group");
    if (groupKey) {
      if (!groups.has(groupKey)) groups.set(groupKey, []);
      groups.get(groupKey).push(el);
    } else {
      gsap.set(el, { opacity: 0, y: 24 });
      gsap.to(el, {
        opacity: 1,
        y: 0,
        duration: 0.7,
        ease: "power2.out",
        scrollTrigger: {
          trigger: el,
          start: "top 85%",
        },
      });
    }
  });

  groups.forEach((els) => {
    gsap.set(els, { opacity: 0, y: 24 });
    gsap.to(els, {
      opacity: 1,
      y: 0,
      duration: 0.6,
      ease: "power2.out",
      stagger: 0.1,
      scrollTrigger: {
        trigger: els[0],
        start: "top 85%",
      },
    });
  });

  // Hero entrance (runs immediately, not scroll-gated)
  const heroTimeline = gsap.timeline({ defaults: { ease: "power2.out" } });
  const heroEyebrow = document.querySelector("[data-hero-eyebrow]");
  const heroHeading = document.querySelector("[data-hero-heading]");
  const heroCopy = document.querySelector("[data-hero-copy]");
  const heroActions = document.querySelector("[data-hero-actions]");
  const heroSocial = document.querySelector("[data-hero-social]");
  const heroArt = document.querySelector("[data-hero-art]");
  const heroChips = document.querySelectorAll("[data-hero-chip]");

  if (heroHeading) {
    gsap.set(
      [heroEyebrow, heroHeading, heroCopy, heroActions, heroSocial].filter(Boolean),
      { opacity: 0, y: 20 }
    );
    heroTimeline
      .to(heroEyebrow, { opacity: 1, y: 0, duration: 0.5 })
      .to(heroHeading, { opacity: 1, y: 0, duration: 0.7 }, "-=0.3")
      .to(heroCopy, { opacity: 1, y: 0, duration: 0.6 }, "-=0.4")
      .to(heroActions, { opacity: 1, y: 0, duration: 0.5 }, "-=0.35")
      .to(heroSocial, { opacity: 1, y: 0, duration: 0.5 }, "-=0.3");
  }

  if (heroArt) {
    gsap.set(heroArt, { opacity: 0, scale: 0.94 });
    heroTimeline.to(
      heroArt,
      { opacity: 1, scale: 1, duration: 0.8 },
      "-=0.6"
    );
  }

  if (heroChips.length) {
    gsap.set(heroChips, { opacity: 0, x: 16 });
    heroTimeline.to(
      heroChips,
      { opacity: 1, x: 0, duration: 0.5, stagger: 0.12 },
      "-=0.4"
    );
  }

  // Gentle float loop on hero chips for ambient life
  heroChips.forEach((chip, i) => {
    gsap.to(chip, {
      y: i % 2 === 0 ? -8 : 8,
      duration: 2.4 + i * 0.3,
      ease: "sine.inOut",
      repeat: -1,
      yoyo: true,
      delay: 1 + i * 0.2,
    });
  });
}

/* ---------------------------------------------------------------------
   Animated counters for the stats bar ("10,000+", "95%", etc.)
   ------------------------------------------------------------------ */
document.querySelectorAll("[data-counter]").forEach((el) => {
  const target = parseFloat(el.getAttribute("data-counter"));
  const suffix = el.getAttribute("data-counter-suffix") || "";
  const counter = { value: 0 };

  const run = () => {
    gsap.to(counter, {
      value: target,
      duration: prefersReducedMotion ? 0.01 : 1.6,
      ease: "power1.out",
      onUpdate: () => {
        const formatted =
          target >= 1000
            ? Math.floor(counter.value).toLocaleString("en-IN")
            : Math.floor(counter.value);
        el.textContent = `${formatted}${suffix}`;
      },
    });
  };

  ScrollTrigger.create({
    trigger: el,
    start: "top 90%",
    once: true,
    onEnter: run,
  });
});

/* ---------------------------------------------------------------------
   Testimonials carousel (simple, dependency-free, touch friendly)
   ------------------------------------------------------------------ */
const carousel = document.querySelector("[data-carousel]");
if (carousel) {
  const track = carousel.querySelector("[data-carousel-track]");
  const slides = Array.from(carousel.querySelectorAll("[data-carousel-slide]"));
  const prevBtn = carousel.querySelector("[data-carousel-prev]");
  const nextBtn = carousel.querySelector("[data-carousel-next]");
  const dotsWrap = carousel.querySelector("[data-carousel-dots]");
  let index = 0;
  let perView = 1;

  const dots = slides.map((_, i) => {
    const dot = document.createElement("button");
    dot.type = "button";
    dot.className = "h-2 w-2 rounded-full bg-ink-900/15 transition-all";
    dot.setAttribute("aria-label", `Go to testimonial ${i + 1}`);
    dot.addEventListener("click", () => goTo(i));
    dotsWrap?.appendChild(dot);
    return dot;
  });

  function updatePerView() {
    const w = window.innerWidth;
    perView = w >= 1024 ? 3 : w >= 640 ? 2 : 1;
  }

  function updateDots() {
    dots.forEach((dot, i) => {
      dot.classList.toggle("bg-brand-500", i === index);
      dot.classList.toggle("w-6", i === index);
      dot.classList.toggle("bg-ink-900/15", i !== index);
    });
  }

  function goTo(i) {
    const maxIndex = Math.max(slides.length - perView, 0);
    index = Math.min(Math.max(i, 0), maxIndex);
    const slideWidth = slides[0].getBoundingClientRect().width;
    const gap = 24; // matches gap-6
    track.style.transform = `translateX(-${index * (slideWidth + gap)}px)`;
    updateDots();
  }

  prevBtn?.addEventListener("click", () => goTo(index - 1));
  nextBtn?.addEventListener("click", () => goTo(index + 1));

  window.addEventListener("resize", () => {
    updatePerView();
    goTo(index);
  });

  updatePerView();
  goTo(0);
}

/* ---------------------------------------------------------------------
   Newsletter form (frontend-only feedback; wire to real endpoint later)
   ------------------------------------------------------------------ */
const newsletterForm = document.querySelector("[data-newsletter-form]");
if (newsletterForm) {
  newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const emailInput = newsletterForm.querySelector("input[type='email']");
    const feedback = newsletterForm.querySelector("[data-newsletter-feedback]");
    if (emailInput?.checkValidity()) {
      feedback.textContent = "Thanks for subscribing!";
      feedback.classList.remove("hidden");
      emailInput.value = "";
    }
  });
}
