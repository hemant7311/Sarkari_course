<section class="section pb-16 sm:pb-20 lg:pb-24">
    <div data-animate class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-brand-600 to-brand-400 px-6 py-12 sm:px-12 sm:py-14 lg:px-16">
        <div class="relative z-10 flex flex-col items-center gap-8 lg:flex-row lg:justify-between lg:text-left">
            <div class="shrink-0 flex justify-center">
                <img
                    src="{{ asset('images/hero/cta-books-graduation-cap-3d.webp') }}"
                    alt="Stack of books topped with a graduation cap and diploma scroll"
                    width="180"
                    height="180"
                    loading="lazy"
                    class="h-32 w-32 sm:h-40 sm:w-40 object-contain drop-shadow-md"
                >
            </div>

            <div class="text-center lg:text-left">
                <h2 class="text-balance text-2xl font-bold text-white sm:text-3xl">
                    Ready to Start Your Success Journey?
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm text-white/85 sm:text-base lg:mx-0">
                    Join thousands of students who are already preparing with SarkariCourse. It's free, it's proven, it works!
                </p>
            </div>

            <div class="flex shrink-0 flex-col gap-3 sm:flex-row">
                <a href="/signup" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-brand-600 transition-transform hover:-translate-y-0.5">
                    Start Learning Free
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
                <a href="/courses" class="btn-outline-light">
                    Explore Courses
                </a>
            </div>
        </div>

        {{-- Decorative dotted texture, purely visual --}}
        <svg class="pointer-events-none absolute -right-10 -top-10 h-56 w-56 opacity-20" viewBox="0 0 200 200" fill="none" aria-hidden="true">
            <pattern id="dots" width="16" height="16" patternUnits="userSpaceOnUse">
                <circle cx="2" cy="2" r="2" fill="white" />
            </pattern>
            <rect width="200" height="200" fill="url(#dots)" />
        </svg>
    </div>
</section>
