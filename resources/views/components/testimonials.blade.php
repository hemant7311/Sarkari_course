@php
    $testimonials = [
        [
            'quote' => "Thanks to SarkariCourse, I cleared SSC CGL 2023 in my first attempt! The study materials and mock tests were extremely helpful.",
            'name' => 'Rahul Kumar',
            'result' => 'SSC CGL 2023',
            'avatar' => 'rahul-kumar.webp',
        ],
        [
            'quote' => "The best platform for free education. Qualified Railway NTPC with excellent rank. Highly recommended!",
            'name' => 'Priya Singh',
            'result' => 'Railway NTPC 2023',
            'avatar' => 'priya-singh.webp',
        ],
        [
            'quote' => "SarkariCourse made my UPSC journey easier. The content quality is exceptional and completely free!",
            'name' => 'Aman Verma',
            'result' => 'UPSC CSE 2023',
            'avatar' => 'aman-verma.webp',
        ],
    ];
@endphp

<section class="section section-y">
    <div class="mx-auto max-w-2xl text-center">
        <span class="eyebrow justify-center">Success Stories</span>
        <h2 class="section-heading">Real Results from Real Students</h2>
    </div>

    <div data-carousel class="relative mt-10">
        <div class="overflow-hidden">
            <div data-carousel-track class="flex gap-6 transition-transform duration-500 ease-out">
                @foreach ($testimonials as $testimonial)
                    <blockquote
                        data-carousel-slide
                        class="card w-full shrink-0 grow-0 basis-full p-7 sm:basis-[calc(50%-12px)] lg:basis-[calc(33.333%-16px)] rounded-2xl border border-ink-900/5 bg-white shadow-card flex flex-col justify-between"
                    >
                        <div>
                            <span class="text-3xl font-serif font-extrabold text-brand-500 leading-none block select-none">“</span>
                            <p class="mt-3 text-sm leading-relaxed text-ink-700 font-medium">
                                {{ $testimonial['quote'] }}
                            </p>
                        </div>
                        <footer class="mt-6 flex items-center gap-3">
                            <img
                                src="{{ asset('images/testimonials/' . $testimonial['avatar']) }}"
                                alt=""
                                width="40"
                                height="40"
                                loading="lazy"
                                class="h-10 w-10 rounded-full object-cover"
                            >
                            <div>
                                <cite class="block text-sm font-semibold not-italic text-ink-900">{{ $testimonial['name'] }}</cite>
                                <span class="block text-xs text-ink-500">{{ $testimonial['result'] }}</span>
                            </div>
                        </footer>
                    </blockquote>
                @endforeach
            </div>
        </div>

        {{-- Prev / Next arrows --}}
        <button
            type="button"
            data-carousel-prev
            aria-label="Previous testimonial"
            class="absolute left-0 top-1/2 hidden -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-ink-900/10 bg-white p-2.5 shadow-card transition-colors hover:bg-brand-50 sm:flex"
        >
            <i data-lucide="chevron-left" class="h-4 w-4 text-ink-700"></i>
        </button>
        <button
            type="button"
            data-carousel-next
            aria-label="Next testimonial"
            class="absolute right-0 top-1/2 hidden translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-ink-900/10 bg-white p-2.5 shadow-card transition-colors hover:bg-brand-50 sm:flex"
        >
            <i data-lucide="chevron-right" class="h-4 w-4 text-ink-700"></i>
        </button>
    </div>

    <div data-carousel-dots class="mt-8 flex items-center justify-center gap-2" role="tablist" aria-label="Testimonial navigation"></div>
</section>
