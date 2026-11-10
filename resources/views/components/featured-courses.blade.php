@php
    $courses = [
        [
            'title' => 'SSC CGL',
            'subtitle' => 'Complete Course',
            'desc' => 'SSC CGL Complete Preparation 2024',
            'gradient' => 'from-violet-700 via-violet-600 to-indigo-600',
            'icon' => 'award',
            'img' => null,
            'lessons' => '120 Lessons',
            'rating' => '4.8',
            'reviews' => '2.1K',
            'href' => '/courses/ssc-cgl',
        ],
        [
            'title' => 'Railway NTPC',
            'subtitle' => 'Complete Course',
            'desc' => 'Railway NTPC Complete Preparation 2024',
            'gradient' => 'from-sky-600 to-blue-500',
            'icon' => 'train-front',
            'img' => 'assets/railway.webp',
            'lessons' => '95 Lessons',
            'rating' => '4.7',
            'reviews' => '1.8K',
            'href' => '/courses/railway-ntpc',
        ],
        [
            'title' => 'Bank PO',
            'subtitle' => 'Complete Course',
            'desc' => 'Bank PO Complete Preparation 2024',
            'gradient' => 'from-emerald-700 via-emerald-600 to-teal-500',
            'icon' => 'landmark',
            'img' => 'assets/bank.png',
            'lessons' => '110 Lessons',
            'rating' => '4.9',
            'reviews' => '2.3K',
            'href' => '/courses/bank-po',
        ],
        [
            'title' => 'UPSC',
            'subtitle' => 'Prelims + Mains Complete Course',
            'desc' => 'UPSC Prelims + Mains Complete Course',
            'gradient' => 'from-orange-600 via-amber-500 to-amber-400',
            'icon' => 'scroll-text',
            'img' => null,
            'lessons' => '150 Lessons',
            'rating' => '4.8',
            'reviews' => '1.3K',
            'href' => '/courses/upsc',
        ],
        [
            'title' => 'State PSC',
            'subtitle' => 'Complete Course',
            'desc' => 'State PSC Complete Preparation 2024',
            'gradient' => 'from-purple-700 via-fuchsia-600 to-indigo-600',
            'icon' => 'building-2',
            'img' => null,
            'lessons' => '85 Lessons',
            'rating' => '4.6',
            'reviews' => '980',
            'href' => '/courses/state-psc',
        ],
    ];
@endphp

<section class="section section-y">
    <div class="mx-auto max-w-2xl text-center">
        <span class="eyebrow justify-center">Featured Courses</span>
        <h2 class="section-heading">Top Free Courses This Month</h2>
        <p class="section-subheading">Explore our most popular free courses</p>
    </div>

    <div class="mt-10 flex snap-x snap-mandatory gap-4 overflow-x-auto pb-4 sm:grid sm:grid-cols-2 sm:gap-6 sm:overflow-visible sm:pb-0 lg:grid-cols-5">
        @foreach ($courses as $course)
            <a href="{{ $course['href'] }}" data-animate data-animate-group="courses" class="card group flex w-[82%] shrink-0 snap-start flex-col overflow-hidden sm:w-auto sm:shrink rounded-2xl border border-ink-900/5 bg-white shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
                <div class="relative flex h-36 flex-col justify-between bg-gradient-to-br {{ $course['gradient'] }} p-4 text-white overflow-hidden">
                    <div class="flex items-center justify-between z-10">
                        <span class="w-fit rounded-full bg-white/95 px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider text-emerald-600 shadow-sm border border-emerald-300">
                            FREE
                        </span>
                    </div>

                    <div class="flex items-end justify-between z-10">
                        <div>
                            <p class="text-base font-extrabold leading-tight tracking-wide">{{ $course['title'] }}</p>
                            <p class="text-[11px] font-medium text-white/80">{{ $course['subtitle'] }}</p>
                        </div>
                        @if (!empty($course['img']))
                            <img src="{{ asset($course['img']) }}" alt="" class="h-12 w-12 object-contain opacity-90 transition-transform duration-300 group-hover:scale-110 drop-shadow">
                        @else
                            <i data-lucide="{{ $course['icon'] }}" class="h-9 w-9 text-white/70 transition-transform duration-300 group-hover:scale-110 drop-shadow"></i>
                        @endif
                    </div>

                    {{-- Subtle background overlay circles --}}
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-white/10 pointer-events-none"></div>
                </div>

                <div class="flex flex-1 flex-col gap-3 p-4">
                    <p class="text-xs font-bold text-ink-900 leading-snug line-clamp-2">{{ $course['desc'] }}</p>

                    <div class="flex items-center justify-between text-xs text-ink-500 pt-1">
                        <span class="flex items-center gap-1 font-medium">
                            <i data-lucide="layers" class="h-3.5 w-3.5 text-amber-500"></i>
                            {{ $course['lessons'] }}
                        </span>
                        <span class="flex items-center gap-1 font-semibold">
                            <i data-lucide="star" class="h-3.5 w-3.5 fill-amber-400 text-amber-400"></i>
                            {{ $course['rating'] }} ({{ $course['reviews'] }})
                        </span>
                    </div>

                    <span class="mt-auto pt-2 inline-flex items-center gap-1 text-xs font-bold text-brand-500 group-hover:text-brand-600">
                        Enroll Now
                        <i data-lucide="arrow-right" class="h-3.5 w-3.5 transition-transform duration-200 group-hover:translate-x-1"></i>
                    </span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-10 flex justify-center">
        <a href="/courses" class="btn-primary">
            View All Courses
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
        </a>
    </div>
</section>
