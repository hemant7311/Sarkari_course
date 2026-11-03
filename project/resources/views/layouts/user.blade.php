<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#6D28D9">
    <title>@yield('title', 'My Account') - SarkariCourse</title>

    @vite(['resources/css/fonts.css'])

    @vite(['resources/css/design-system.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/dashboard.css'])
    @vite(['resources/css/ai-chat.css'])
    @stack('styles')
</head>
<body class="sc-scope sc-dash-body">

    <a href="#main-content" class="sc-skip-link">Skip to main content</a>

    {{-- Mobile top bar --}}
    <div class="sc-dash-topbar">
        <button type="button" class="sc-icon-btn" id="scDashMenuTrigger" aria-label="Open menu">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
        </button>
        <a href="{{ route('home') }}" class="sc-logo">
            <span class="sc-logo-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
            </span>
            <span class="sc-logo-text">Sarkari<em>Course</em></span>
        </a>
        <a href="{{ route('notifications') }}" class="sc-icon-btn" aria-label="Notifications">
            <svg viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </a>
    </div>

    <div class="sc-dash-overlay" id="scDashOverlay"></div>

    <aside class="sc-dash-sidebar" id="scDashSidebar">
        <a href="{{ route('home') }}" class="sc-logo sc-dash-brand">
            <span class="sc-logo-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
            </span>
            <span class="sc-logo-text">Sarkari<em>Course</em></span>
        </a>

        <div class="sc-dash-user-card">
            @if(Auth::user()->profile_image)
                <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}">
            @else
                <span class="sc-user-fallback">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            @endif
            <div>
                <strong>{{ Auth::user()->name }}</strong>
                <span>{{ Auth::user()->email }}</span>
            </div>
        </div>

        <nav class="sc-dash-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                My Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Profile Settings
            </a>
            <a href="{{ route('wishlist') }}" class="{{ request()->routeIs('wishlist') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                Wishlist
            </a>
            <a href="{{ route('notifications') }}" class="{{ request()->routeIs('notifications') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                Notifications
            </a>
            <a href="{{ route('courses') }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                Browse Courses
            </a>
            <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Settings
            </a>

            <form action="{{ route('logout') }}" method="POST" class="sc-dash-logout-form">
                @csrf
                <button type="submit">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="sc-dash-content" id="main-content">
        @if (session('status') && !in_array(session('status'), ['profile-updated', 'password-updated', 'verification-link-sent']))
            <div class="sc-alert sc-alert-success">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>

    @include('components.ai-chat-widget')

    <script>
        (function () {
            var sidebar = document.getElementById('scDashSidebar');
            var overlay = document.getElementById('scDashOverlay');
            var trigger = document.getElementById('scDashMenuTrigger');
            function open() { sidebar.classList.add('open'); overlay.classList.add('open'); }
            function close() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }
            trigger?.addEventListener('click', open);
            overlay?.addEventListener('click', close);
        })();
    </script>
    @vite(['resources/js/sc-animations.js'])
    @vite(['resources/js/sc-lottie.js'])
    @vite(['resources/js/three-loader.js'])
    @stack('scripts')
</body>
</html>
