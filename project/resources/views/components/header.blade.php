{{--
  SarkariCourse — Global Header (Phase 2)
  - Desktop: sticky glass nav with animated active link
  - Mobile: Instagram-style top bar + slide drawer + floating bottom nav
  Data: $settings (site name) is injected via View::composer in AppServiceProvider.
--}}
<header class="sc-header sc-scope" id="scHeader">

    {{-- ══ DESKTOP / TABLET NAV ══════════════════════════ --}}
    <div class="sc-nav-desktop">
        <div class="sc-container sc-nav-inner">

            <a href="{{ route('home') }}" class="sc-logo">
                <span class="sc-logo-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
                </span>
                <span class="sc-logo-text">Sarkari<em>Course</em></span>
            </a>

            <nav class="sc-nav-links" aria-label="Primary">
                @php
                    $navItems = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'About', 'route' => 'about'],
                        ['label' => 'Courses', 'route' => 'courses'],
                        ['label' => 'Services', 'route' => 'services'],
                        ['label' => 'Blog', 'route' => 'blog'],
                        ['label' => 'Contact', 'route' => 'contact'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="sc-nav-link {{ request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*') ? 'active' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="sc-nav-actions">
                <button type="button" class="sc-icon-btn" id="scSearchTrigger" aria-label="Search">
                    <svg viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                </button>

                @guest
                    <a href="{{ route('userlogin') }}" class="sc-btn sc-btn-outline sc-btn-sm">Login</a>
                    <a href="{{ route('userlogin') }}" class="sc-btn sc-btn-primary sc-btn-sm">Sign Up</a>
                @endguest

                @auth
                    <div class="sc-user-menu">
                        <button type="button" class="sc-user-trigger" id="scUserTrigger">
                            @if(Auth::user()->profile_image)
                                <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                <span class="sc-user-fallback">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                            @endif
                            <span>{{ Str::limit(Auth::user()->name, 12) }}</span>
                        </button>
                        <div class="sc-user-dropdown" id="scUserDropdown">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <a href="{{ route('profile.edit') }}">My Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- ══ MOBILE HEADER (Instagram-style) ══════════════════ --}}
    <div class="sc-nav-mobile">
        <div class="sc-nav-mobile-inner">
            <button type="button" class="sc-icon-btn" id="scDrawerTrigger" aria-label="Open menu">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
            </button>

            <a href="{{ route('home') }}" class="sc-logo sc-logo-mobile">
                <span class="sc-logo-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
                </span>
                <span class="sc-logo-text">Sarkari<em>Course</em></span>
            </a>

            <div class="sc-nav-mobile-actions">
                <button type="button" class="sc-icon-btn" id="scSearchTriggerMobile" aria-label="Search">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                </button>
                @auth
                    <a href="{{ route('profile.edit') }}" class="sc-avatar-btn">
                        @if(Auth::user()->profile_image)
                            <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}">
                        @else
                            <span class="sc-user-fallback">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('userlogin') }}" class="sc-icon-btn" aria-label="Login">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- ══ SLIDE DRAWER (mobile) ══════════════════════════ --}}
    <div class="sc-drawer-overlay" id="scDrawerOverlay"></div>
    <aside class="sc-drawer" id="scDrawer" aria-hidden="true">
        <div class="sc-drawer-head">
            <a href="{{ route('home') }}" class="sc-logo">
                <span class="sc-logo-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
                </span>
                <span class="sc-logo-text">Sarkari<em>Course</em></span>
            </a>
            <button type="button" class="sc-icon-btn" id="scDrawerClose" aria-label="Close menu">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        @auth
            <div class="sc-drawer-user">
                @if(Auth::user()->profile_image)
                    <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}">
                @else
                    <span class="sc-user-fallback lg">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                @endif
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>
        @endauth

        <nav class="sc-drawer-nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses') ? 'active' : '' }}">Courses</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            <div class="sc-drawer-divider"></div>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
            <a href="{{ route('refund') }}">Refund Policy</a>
            <a href="{{ route('terms') }}">Terms &amp; Conditions</a>
        </nav>

        <div class="sc-drawer-footer">
            @guest
                <a href="{{ route('userlogin') }}" class="sc-btn sc-btn-outline" style="width:100%">Login</a>
                <a href="{{ route('userlogin') }}" class="sc-btn sc-btn-primary" style="width:100%">Sign Up</a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="sc-btn sc-btn-outline" style="width:100%">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sc-btn sc-btn-ghost" style="width:100%">Logout</button>
                </form>
            @endauth
        </div>
    </aside>

    {{-- ══ SEARCH OVERLAY ══════════════════════════════════ --}}
    <div class="sc-search-overlay" id="scSearchOverlay">
        <div class="sc-search-panel sc-glass">
            <form action="{{ route('search') }}" method="GET" class="sc-search-form-wrap">
                <div class="sc-search-form">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" name="q" placeholder="Search courses, exams, topics…" autocomplete="off" id="scSearchInput">
                    <kbd>ESC</kbd>
                </div>

                <div class="sc-search-suggest" id="scRecentSearches" hidden>
                    <span class="sc-search-suggest-label">Recent Searches</span>
                    <div class="sc-search-chip-row" id="scRecentSearchesList"></div>
                </div>

                <div class="sc-search-suggest">
                    <span class="sc-search-suggest-label">Popular Searches</span>
                    <div class="sc-search-chip-row">
                        @foreach(['SSC CGL', 'Railway NTPC', 'UPSC Prelims', 'Banking PO', 'Current Affairs'] as $term)
                            <button type="button" class="sc-search-chip" data-term="{{ $term }}">{{ $term }}</button>
                        @endforeach
                    </div>
                </div>
            </form>
            <button type="button" class="sc-icon-btn" id="scSearchClose" aria-label="Close search">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
    </div>
</header>

{{-- ══ FLOATING BOTTOM NAV (mobile only) ══════════════════ --}}
<nav class="sc-bottom-nav sc-scope" aria-label="Bottom navigation">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
        <span>Home</span>
    </a>
    <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses') || request()->routeIs('course_details') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        <span>Courses</span>
    </a>
    <a href="{{ route('blog') }}" class="sc-bottom-nav-center {{ request()->routeIs('blog') || request()->routeIs('blog.show') ? 'active' : '' }}">
        <span class="sc-bottom-nav-fab">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </span>
        <span>Blog</span>
    </a>
    <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><line x1="16" y1="8" x2="2" y2="22"/><line x1="17.5" y1="15" x2="9" y2="15"/></svg>
        <span>Services</span>
    </a>
    <a href="{{ auth()->check() ? route('profile.edit') : route('userlogin') }}" class="{{ request()->routeIs('profile.edit') || request()->routeIs('userlogin') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        <span>Profile</span>
    </a>
</nav>

<div class="sc-header-spacer" aria-hidden="true"></div>
