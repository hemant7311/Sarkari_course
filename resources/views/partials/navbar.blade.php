@php
    $navLinks = [
        ['label' => 'Home', 'href' => '/', 'active' => request()->is('/')],
        ['label' => 'Courses', 'href' => '/courses'],
        ['label' => 'Exams', 'href' => '/exams', 'dropdown' => true],
        ['label' => 'Mock Tests', 'href' => '/mock-tests'],
        ['label' => 'Current Affairs', 'href' => '/current-affairs'],
        ['label' => 'Blog', 'href' => '/blog'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Contact', 'href' => '/contact'],
    ];
@endphp

<header data-site-header class="sticky top-0 z-50 border-b border-transparent bg-white/90 backdrop-blur transition-shadow duration-300 [&.is-scrolled]:shadow-card [&.is-scrolled]:border-ink-900/5">
    <nav class="section flex h-[72px] items-center justify-between" aria-label="Primary">
        {{-- Logo --}}
        <a href="/" class="flex shrink-0 items-center gap-2.5" aria-label="SarkariCourse home">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 text-white">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                    <path d="M6 12.5v4.5c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="leading-tight">
                <span class="block text-base font-bold text-ink-900">SarkariCourse</span>
                <span class="block text-[11px] font-medium text-ink-500">Free Education For All</span>
            </span>
        </a>

        {{-- Desktop links --}}
        <ul class="hidden items-center gap-7 lg:flex">
            @foreach ($navLinks as $link)
                <li class="relative">
                    <a href="{{ $link['href'] }}" class="nav-link {{ !empty($link['active']) ? 'is-active' : '' }} inline-flex items-center gap-1">
                        {{ $link['label'] }}
                        @if (!empty($link['dropdown']))
                            <i data-lucide="chevron-down" class="h-3.5 w-3.5"></i>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Right actions --}}
        <div class="hidden items-center gap-3 lg:flex">
            <button type="button" aria-label="Search" class="flex h-10 w-10 items-center justify-center rounded-full text-ink-500 transition-colors hover:bg-brand-50 hover:text-brand-600">
                <i data-lucide="search" class="h-[18px] w-[18px]"></i>
            </button>
            <a href="/login" class="rounded-full border border-ink-900/10 px-5 py-2.5 text-sm font-semibold text-ink-700 transition-colors hover:border-brand-300 hover:text-brand-600">
                Login
            </a>
            <a href="/signup" class="btn-primary">
                Sign Up
            </a>
        </div>

        {{-- Mobile: notification bell only. Primary navigation on mobile
             lives in the fixed bottom tab bar (partials.bottom-nav);
             Blog/About/Contact remain reachable from the footer. --}}
        <a
            href="/notifications"
            aria-label="Notifications"
            class="flex h-10 w-10 items-center justify-center rounded-full text-ink-900 border border-ink-900/10 transition-colors hover:bg-brand-50 lg:hidden"
        >
            <i data-lucide="bell" class="h-5 w-5 text-ink-900"></i>
        </a>
    </nav>
</header>
