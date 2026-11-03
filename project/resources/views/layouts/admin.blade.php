<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#6D28D9">
    <title>@yield('title', 'Admin Panel') - SarkariCourse</title>

    @vite(['resources/css/fonts.css'])

    @vite(['resources/css/design-system.css'])
    @vite(['resources/css/admin.css'])
    @stack('styles')
</head>
<body class="sa-scope sa-body">

<a href="#main-content" class="sc-skip-link">Skip to main content</a>

<div class="sa-sidebar-overlay" id="saSidebarOverlay"></div>

<aside class="sa-sidebar" id="saSidebar">
    <a href="{{ route('dashboard') }}" class="sa-sidebar-brand">
        <span class="sc-logo-mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
        </span>
        <span>
            <span class="sa-sidebar-brand-text">Sarkari<em>Course</em></span>
            <span class="sa-sidebar-brand-sub">Admin Panel</span>
        </span>
    </a>

    <nav class="sa-sidebar-nav">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ route('users') }}" class="{{ request()->routeIs('users') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Users
        </a>
        <a href="{{ route('addcourses') }}" class="{{ request()->routeIs('addcourses') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            Courses
        </a>
        <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m20.59 13.41-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>
            Categories
        </a>
        <a href="{{ route('admin.blogs') }}" class="{{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4"/><path d="M14 2v5h5"/><path d="M2 15h10M2 11h6M2 19h10"/></svg>
            Blogs
        </a>
        <a href="{{ route('inquiry') }}" class="{{ request()->routeIs('inquiry') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Inquiries
            @if(($sidebarPendingInquiries ?? 0) > 0)
                <span class="sa-badge sa-badge-primary" style="margin-left:auto">{{ $sidebarPendingInquiries }}</span>
            @endif
        </a>
        <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            Settings
        </a>
    </nav>

    <div class="sa-sidebar-logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>

<div class="sa-content" id="main-content">

    <div class="sa-topbar">
        <div class="sa-topbar-left">
            <button type="button" class="sa-menu-toggle" id="saMenuToggle" aria-label="Open menu">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
            </button>
            <div>
                <h1>Welcome back, {{ Str::before(Auth::user()->name, ' ') }} 👋</h1>
                <span class="sa-topbar-sub">{{ now()->format('l, d M Y') }}</span>
            </div>
        </div>

        <div class="sa-topbar-actions">
            <label class="sa-topbar-search">
                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" id="saGlobalSearch" placeholder="Search users, courses…">
            </label>

            <a href="{{ route('inquiry') }}" class="sa-topbar-icon-btn" aria-label="Inquiries" title="Inquiries">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                @if(($sidebarPendingInquiries ?? 0) > 0)
                    <span class="sa-topbar-badge">{{ $sidebarPendingInquiries }}</span>
                @endif
            </a>

            <div class="sa-topbar-profile">
                <span class="sa-topbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div class="sa-alert sa-alert-success">{{ session('status') }}</div>
    @endif

    @yield('content')

</div>

{{-- Chart.js — kept exactly as before, loaded before @stack('scripts') --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    (function () {
        var sidebar = document.getElementById('saSidebar');
        var overlay = document.getElementById('saSidebarOverlay');
        var trigger = document.getElementById('saMenuToggle');
        function open() { sidebar.classList.add('open'); overlay.classList.add('open'); }
        function close() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }
        trigger?.addEventListener('click', open);
        overlay?.addEventListener('click', close);

        // Simple client-side filter for tables on the current page (Users/Courses/etc already
        // have their own dedicated search inputs where the backend supports it — this global
        // box just jumps to the most relevant section already loaded on screen, no new queries).
        var globalSearch = document.getElementById('saGlobalSearch');
        globalSearch?.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                var val = this.value.trim().toLowerCase();
                var rows = document.querySelectorAll('.sa-table tbody tr');
                for (var i = 0; i < rows.length; i++) {
                    if (rows[i].textContent.toLowerCase().includes(val)) {
                        rows[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                        rows[i].style.background = 'rgba(109,40,217,.08)';
                        setTimeout(function (r) { return function () { r.style.background = ''; }; }(rows[i]), 1500);
                        break;
                    }
                }
            }
        });
    })();

    // Reusable modal helpers (used by Courses/Categories/Blogs/Chapters/Inquiry pages)
    function saOpenModal(id) {
        var m = document.getElementById(id);
        if (!m) return;
        m.classList.add('is-open');
        m.setAttribute('aria-hidden', 'false');
    }
    function saCloseModal(id) {
        var m = document.getElementById(id);
        if (!m) return;
        m.classList.remove('is-open');
        m.setAttribute('aria-hidden', 'true');
    }
</script>

{{-- Global interaction engine — desktop cursor, magnetic buttons, reveal animations --}}
@vite(['resources/js/sc-animations.js'])

@stack('scripts')

</body>
</html>
