<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#6D28D9">
    <title>@yield('title', 'Account') - SarkariCourse</title>

    @vite(['resources/css/fonts.css'])

    @vite(['resources/css/design-system.css'])
    @vite(['resources/css/auth.css'])
    @stack('styles')
</head>
<body class="sc-scope sc-auth-body">

    <div class="sc-auth-page">

        <div class="sc-auth-brand">
            <a href="{{ route('home') }}" class="sc-logo">
                <span class="sc-logo-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"><path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/></svg>
                </span>
                <span class="sc-logo-text sc-logo-text-light">Sarkari<em>Course</em></span>
            </a>

            <div class="sc-auth-brand-body">
                <h1>@yield('auth_heading', 'Your Path to Government Jobs Starts Here.')</h1>
                <p>@yield('auth_subheading', "Join thousands of aspirants preparing smarter with India's most trusted free exam platform.")</p>

                <div class="sc-auth-stats">
                    <div><strong>50K+</strong><span>Students</span></div>
                    <div><strong>95%</strong><span>Success Rate</span></div>
                    <div><strong>100%</strong><span>Free Access</span></div>
                </div>
            </div>

            <div class="sc-auth-hero-3d" id="scAuthHero3d" aria-hidden="true" style="background-image:url('{{ asset('images/auth/'.\Illuminate\Support\Str::of(trim($__env->yieldContent('auth_bg_image', 'login-welcome-3d.webp')))->toString()) }}')"></div>

            <div class="sc-auth-badges">
                <span>✓ Free Forever</span>
                <span>✓ Expert Faculty</span>
                <span>✓ 500+ Lectures</span>
            </div>
        </div>

        <div class="sc-auth-panel-wrap">
            <div class="sc-auth-form-wrap">
                @yield('content')
            </div>
        </div>
    </div>

    @vite(['resources/js/sc-animations.js'])
    @stack('scripts')
</body>
</html>
