@php
    $floatingChips = [
        ['icon' => 'video', 'iconBg' => 'bg-brand-500', 'iconColor' => 'text-white', 'label' => 'Live Classes', 'value' => '32+', 'sub' => 'Daily Live Sessions'],
        ['icon' => 'clipboard-check', 'iconBg' => 'bg-emerald-500', 'iconColor' => 'text-white', 'label' => 'Mock Tests', 'value' => '1250+', 'sub' => 'Tests Available'],
        ['icon' => 'award', 'iconBg' => 'bg-amber-400', 'iconColor' => 'text-white', 'label' => 'Success Rate', 'value' => '95%', 'sub' => 'Our Students'],
    ];
@endphp

<section class="relative overflow-hidden bg-gradient-to-b from-brand-50/60 via-white to-white">
    <div class="section grid grid-cols-1 items-center gap-12 pb-16 pt-10 sm:pt-14 lg:grid-cols-2 lg:gap-8 lg:pb-20 lg:pt-16">
        {{-- Copy column --}}
        <div>
            <span data-hero-eyebrow class="badge-pill inline-flex items-center gap-2 rounded-full bg-brand-50 px-4 py-1.5 text-xs font-semibold text-brand-600">
                <i data-lucide="sparkles" class="h-3.5 w-3.5"></i>
                100% Free Learning Platform
            </span>

            <h1 data-hero-heading class="mt-5 text-4xl font-extrabold leading-[1.12] text-ink-900 sm:text-5xl lg:text-[3.25rem]">
                Crack Government<br>
                Exams with<br>
                <span class="text-brand-500">India's Most Trusted<br>Free Platform</span>
            </h1>

            <p data-hero-copy class="mt-5 max-w-lg text-base leading-relaxed text-ink-500">
                Access free high-quality courses, mock tests, study notes, current affairs and expert guidance for <span class="font-semibold text-emerald-600">SSC</span>, <span class="font-semibold text-emerald-600">Railway</span>, <span class="font-semibold text-emerald-600">Banking</span>, <span class="font-semibold text-emerald-600">UPSC</span> and more.
            </p>

            <div data-hero-actions class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="/signup" class="btn-primary">
                    Start Learning Free
                    <i data-lucide="arrow-right" class="h-4 w-4"></i>
                </a>
                <a href="/courses" class="btn-outline">
                    Explore Courses
                </a>
            </div>

            <div data-hero-social class="mt-8 flex items-center gap-3">
                <div class="flex -space-x-2.5" aria-hidden="true">
                    @foreach ([1, 2, 3, 4] as $i)
                        <img
                            src="{{ asset('images/students/student-' . $i . '.webp') }}"
                            alt="Student avatar {{ $i }}"
                            width="38"
                            height="38"
                            loading="lazy"
                            class="h-9 w-9 rounded-full border-2 border-white object-cover shadow-sm"
                        >
                    @endforeach
                </div>
                <div>
                    <p class="text-sm font-bold text-ink-900">10,000+ Students already learning</p>
                    <div class="flex items-center gap-1.5">
                        <span class="flex items-center text-amber-400" aria-hidden="true">
                            @for ($i = 0; $i < 5; $i++)
                                <i data-lucide="star" class="h-3.5 w-3.5 fill-amber-400"></i>
                            @endfor
                        </span>
                        <span class="text-xs font-semibold text-ink-500">4.8 (2.5K Reviews)</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Illustration column --}}
        <div class="relative">
            <div data-hero-art class="relative mx-auto max-w-md rounded-[2.5rem] bg-gradient-to-br from-brand-100/70 to-brand-50/50 p-6 sm:p-10">
                <img
                    src="{{ asset('images/hero/hero-student-with-laptop-3d.webp') }}"
                    alt="Student preparing for government exams on a laptop with books"
                    width="600"
                    height="600"
                    class="w-full object-contain"
                    fetchpriority="high"
                >

                {{-- Floating Chips --}}
                <div class="flex flex-col gap-3 sm:absolute sm:right-[-1.5rem] sm:top-1/2 sm:-translate-y-1/2 sm:gap-4 mt-4 sm:mt-0">
                    @foreach ($floatingChips as $chip)
                        <div
                            data-hero-chip
                            class="floating-chip flex items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-card border border-ink-900/5"
                        >
                            <span class="stat-icon flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $chip['iconBg'] }} {{ $chip['iconColor'] }}">
                                <i data-lucide="{{ $chip['icon'] }}" class="h-5 w-5"></i>
                            </span>
                            <div class="leading-tight">
                                <span class="block text-xs font-medium text-ink-500">{{ $chip['label'] }}</span>
                                <span class="block text-base font-bold text-ink-900">{{ $chip['value'] }}</span>
                                <span class="block text-[10px] text-ink-500">{{ $chip['sub'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
