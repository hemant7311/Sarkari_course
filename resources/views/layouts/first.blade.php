<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6D28D9">

    <title>@yield('title', 'SarkariCourse - Free SSC, Railway, Banking, UPSC Exam Preparation')</title>
    <meta name="description" content="@yield('meta_description', "India's most trusted free platform for SSC, Railway, Banking, UPSC, Police and State Exam preparation.")">
    <meta name="keywords" content="@yield('meta_keywords', 'SSC, Railway, Banking, UPSC, Police, State Exams, free online courses, exam preparation India')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SarkariCourse">
    <meta property="og:title" content="@yield('title', 'SarkariCourse')">
    <meta property="og:description" content="@yield('meta_description', "India's most trusted free platform for SSC, Railway, Banking, UPSC, Police and State Exam preparation.")">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SarkariCourse')">
    <meta name="twitter:description" content="@yield('meta_description', "India's most trusted free platform for government exam preparation.")">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- Organization schema (site-wide) --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "EducationalOrganization",
        "name": "SarkariCourse",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "sameAs": []
    }
    </script>
    @stack('schema')

    {{-- Fonts — Design System typography --}}
    @vite(['resources/css/fonts.css'])

    {{-- Design System (tokens, buttons, cards, glass) --}}
    @vite(['resources/css/design-system.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])

    {{-- Page-specific styles --}}
    @vite(['resources/css/home.css'])
    @vite(['resources/css/about.css'])
    @vite(['resources/css/services.css'])
    @vite(['resources/css/courses.css'])
    @vite(['resources/css/course_details.css'])
    @vite(['resources/css/blog.css'])
    @vite(['resources/css/blog_details.css'])
    @vite(['resources/css/contact.css'])
    @vite(['resources/css/search-results.css'])
    @vite(['resources/css/error-pages.css'])
    @vite(['resources/css/legal.css'])
    @vite(['resources/css/ai-chat.css'])

    @stack('styles')
</head>
<body class="sc-body">

    <a href="#main-content" class="sc-skip-link">Skip to main content</a>

    @include('components.header')

    <div id="main-content">
        @yield('content')
    </div>

    <footer>
        @include('components.footer')
    </footer>

    @include('components.ai-chat-widget')

    {{-- Global interaction + animation engines --}}
    @vite(['resources/js/header.js'])
    @vite(['resources/js/sc-animations.js'])
    @vite(['resources/js/sc-lottie.js'])

    @stack('scripts')

</body>
</html>
