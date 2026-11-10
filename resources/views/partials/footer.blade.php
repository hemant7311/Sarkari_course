@php
    $footerColumns = [
        'Quick Links' => [
            ['label' => 'About Us', 'href' => '/about'],
            ['label' => 'Contact Us', 'href' => '/contact'],
            ['label' => 'Privacy Policy', 'href' => '/privacy-policy'],
            ['label' => 'Terms of Service', 'href' => '/terms-of-service'],
            ['label' => 'Refund Policy', 'href' => '/refund-policy'],
        ],
        'Exams' => [
            ['label' => 'SSC', 'href' => '/exams/ssc'],
            ['label' => 'Railway', 'href' => '/exams/railway'],
            ['label' => 'Banking', 'href' => '/exams/banking'],
            ['label' => 'UPSC', 'href' => '/exams/upsc'],
            ['label' => 'State PSC', 'href' => '/exams/state-psc'],
        ],
        'Resources' => [
            ['label' => 'Mock Tests', 'href' => '/mock-tests'],
            ['label' => 'Study Materials', 'href' => '/study-materials'],
            ['label' => 'Current Affairs', 'href' => '/current-affairs'],
            ['label' => 'Previous Papers', 'href' => '/previous-papers'],
            ['label' => 'Success Stories', 'href' => '/success-stories'],
        ],
    ];

    $socialLinks = [
        ['label' => 'Facebook', 'icon' => 'facebook', 'href' => '#'],
        ['label' => 'YouTube', 'icon' => 'youtube', 'href' => '#'],
        ['label' => 'Telegram', 'icon' => 'send', 'href' => '#'],
        ['label' => 'Instagram', 'icon' => 'instagram', 'href' => '#'],
    ];
@endphp

<footer class="bg-surface-dark text-white/70">
    <div class="section section-y grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr_1.2fr]">
        {{-- Brand + description --}}
        <div class="sm:col-span-2 lg:col-span-1">
            <a href="/" class="flex items-center gap-2.5">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 text-white">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <path d="M6 12.5v4.5c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="leading-tight">
                    <span class="block text-base font-bold text-white">SarkariCourse</span>
                    <span class="block text-[11px] font-medium text-white/50">Free Education For All</span>
                </span>
            </a>
            <p class="mt-4 max-w-xs text-sm leading-relaxed text-white/50">
                India's most trusted free platform for government exam preparation. Quality education for every aspirant.
            </p>
            <ul class="mt-5 flex items-center gap-3">
                @foreach ($socialLinks as $social)
                    <li>
                        <a
                            href="{{ $social['href'] }}"
                            aria-label="{{ $social['label'] }}"
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-white/5 text-white/70 transition-colors hover:bg-brand-500 hover:text-white"
                        >
                            <i data-lucide="{{ $social['icon'] }}" class="h-4 w-4"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Link columns --}}
        @foreach ($footerColumns as $title => $links)
            <div>
                <h3 class="text-sm font-semibold text-white">{{ $title }}</h3>
                <ul class="mt-4 space-y-3">
                    @foreach ($links as $link)
                        <li>
                            <a href="{{ $link['href'] }}" class="text-sm text-white/50 transition-colors hover:text-white">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        {{-- Newsletter --}}
        <div>
            <h3 class="text-sm font-semibold text-white">Newsletter</h3>
            <p class="mt-4 text-sm text-white/50">
                Subscribe to get updates about new courses and exam notifications.
            </p>
            <form data-newsletter-form class="mt-4 flex flex-col gap-3" novalidate>
                <label for="newsletter-email" class="sr-only">Email address</label>
                <input
                    id="newsletter-email"
                    type="email"
                    required
                    placeholder="Enter your email"
                    class="w-full rounded-full bg-white px-5 py-2.5 text-sm text-ink-900 placeholder:text-gray-400 focus:ring-2 focus:ring-brand-400 focus:outline-none shadow-sm"
                >
                <button type="submit" class="w-full rounded-full bg-brand-500 hover:bg-brand-600 py-2.5 text-sm font-semibold text-white transition-colors shadow-pill">
                    Subscribe
                </button>
                <p data-newsletter-feedback class="hidden text-xs font-medium text-brand-300" role="status"></p>
            </form>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="section flex flex-col items-center justify-between gap-4 py-5 text-xs text-white/40 sm:flex-row">
            <p>&copy; {{ date('Y') }} SarkariCourse. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="/privacy-policy" class="transition-colors hover:text-white">Privacy Policy</a>
                <a href="/terms-of-service" class="transition-colors hover:text-white">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
