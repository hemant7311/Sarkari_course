@php
    $tabs = [
        ['label' => 'Home', 'icon' => 'home', 'href' => '/', 'active' => request()->is('/')],
        ['label' => 'Courses', 'icon' => 'box', 'href' => '/courses', 'active' => request()->is('courses*')],
        ['label' => 'Exams', 'icon' => 'tag', 'href' => '/exams', 'active' => request()->is('exams*')],
        ['label' => 'Mocks', 'icon' => 'clipboard-check', 'href' => '/mock-tests', 'active' => request()->is('mock-tests*')],
        ['label' => 'Profile', 'icon' => 'user', 'href' => '/profile', 'active' => request()->is('profile*')],
    ];
@endphp

{{-- Mobile-only bottom tab bar. Hidden from lg breakpoint up, where the
     full top navigation (partials.navbar) takes over instead. --}}
<nav
    aria-label="Primary mobile navigation"
    class="fixed inset-x-0 bottom-0 z-50 flex items-stretch justify-around border-t border-ink-900/5 bg-white/95 backdrop-blur lg:hidden"
    style="padding-bottom: env(safe-area-inset-bottom);"
>
    @foreach ($tabs as $tab)
        <a
            href="{{ $tab['href'] }}"
            class="bottom-nav-tab flex flex-1 flex-col items-center justify-center gap-1 py-2.5 text-[11px] font-medium transition-colors {{ $tab['active'] ? 'text-brand-500' : 'text-ink-500' }}"
            @if($tab['active']) aria-current="page" @endif
        >
            <i data-lucide="{{ $tab['icon'] }}" class="h-5 w-5 {{ $tab['active'] ? 'text-brand-500' : 'text-ink-500' }}"></i>
            {{ $tab['label'] }}
        </a>
    @endforeach
</nav>
