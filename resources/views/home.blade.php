@extends('layouts.first')

@section('title', 'SarkariCourse - Free SSC, Railway, Banking, UPSC, Police Exam Preparation')
@section('meta_description', "India's most trusted free platform for SSC, Railway, Banking, UPSC, Police and State Exam preparation with expert faculty and 500+ free courses.")

@section('content')
@php
    $homeLatestBlogs = \App\Models\Blog::published()->latest('published_at')->take(3)->get();

    /* ── Static fallback data ────────────────────── */
    $defaultCats = [
        ['name'=>'SSC',      'key'=>'ssc',    'count'=>'70+',  'color'=>'cat-ssc',
         'icon'=>'<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#7c3aed" stroke-width="1.8" stroke-linecap="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>'],
        ['name'=>'Railway',  'key'=>'rail',   'count'=>'80+',  'color'=>'cat-rail',
         'icon'=>'<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#0ea5e9" stroke-width="1.8" stroke-linecap="round"><rect x="4" y="3" width="16" height="13" rx="2"/><path d="M8 19l-2 3M16 19l2 3M2 19h20"/><circle cx="8.5" cy="10.5" r="1.5"/><circle cx="15.5" cy="10.5" r="1.5"/><path d="M4 8h16"/></svg>'],
        ['name'=>'Banking',  'key'=>'bank',   'count'=>'60+',  'color'=>'cat-bank',
         'icon'=>'<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#0284c7" stroke-width="1.8" stroke-linecap="round"><path d="M3 22h18M3 7h18M12 2L2 7h20L12 2zM7 7v15M11 7v15M13 7v15M17 7v15"/></svg>'],
        ['name'=>'UPSC',     'key'=>'upsc',   'count'=>'75+',  'color'=>'cat-upsc',
         'icon'=>'<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#d97706" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>'],
        ['name'=>'State PSC','key'=>'state',  'count'=>'90+',  'color'=>'cat-state',
         'icon'=>'<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#16a34a" stroke-width="1.8" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>'],
        ['name'=>'Police',   'key'=>'police', 'count'=>'50+',  'color'=>'cat-police',
         'icon'=>'<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#e11d48" stroke-width="1.8" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
    ];

    $features = [
        ['title'=>'100% Free Courses', 'colorClass'=>'feat-purple', 'text'=>'All courses, study materials and resources are completely free for everyone.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>'],
        ['title'=>'Expert Faculty', 'colorClass'=>'feat-blue', 'text'=>'Learn from experienced educators and toppers with proven teaching track records.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
        ['title'=>'Live Classes', 'colorClass'=>'feat-green', 'text'=>'Join daily live classes and interact with faculty in real-time.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>'],
        ['title'=>'Mock Tests', 'colorClass'=>'feat-lavender', 'text'=>'Practice unlimited mock tests with detailed performance analysis.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>'],
        ['title'=>'Study Materials', 'colorClass'=>'feat-teal', 'text'=>'Download free high-quality notes, PDFs and eBooks.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>'],
        ['title'=>'Current Affairs', 'colorClass'=>'feat-pink', 'text'=>'Stay updated with daily, weekly and monthly current affairs.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#e11d48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8M15 18h-5M10 6h8v4h-8z"/></svg>'],
        ['title'=>'Doubt Support', 'colorClass'=>'feat-amber', 'text'=>'Get your doubts cleared by experts through our support system.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>'],
        ['title'=>'Progress Tracking', 'colorClass'=>'feat-violet', 'text'=>'Track your progress and improve your preparation every day.',
         'icon'=>'<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>'],
    ];

    $defaultCourses = [
        ['title'=>'SSC CGL Complete Preparation 2024',      'cat'=>'SSC',       'key'=>'ssc',    'teacher'=>'Prof. Ramesh Kumar',  'level'=>'Beginner',     'rating'=>'4.8','students'=>'8,500+'],
        ['title'=>'Railway NTPC Complete Course 2024',      'cat'=>'Railway',   'key'=>'rail',   'teacher'=>'Prof. Sunita Sharma', 'level'=>'Intermediate', 'rating'=>'4.9','students'=>'12,000+'],
        ['title'=>'Bank PO Complete Preparation 2024',      'cat'=>'Banking',   'key'=>'bank',   'teacher'=>'Prof. Amit Gupta',    'level'=>'Beginner',     'rating'=>'4.7','students'=>'9,200+'],
        ['title'=>'UPSC Prelims + Mains Complete Course',   'cat'=>'UPSC',      'key'=>'upsc',   'teacher'=>'Prof. Neha Singh',    'level'=>'Advanced',     'rating'=>'4.9','students'=>'15,000+'],
        ['title'=>'State PSC Complete Course 2024',         'cat'=>'State PSC', 'key'=>'state',  'teacher'=>'Prof. Vijay Tiwari',  'level'=>'Intermediate', 'rating'=>'4.6','students'=>'6,800+'],
    ];

    $testimonials = [
        ['name'=>'Rahul Kumar',  'tag'=>'SSC CGL, 2023',        'init'=>'R','text'=>'Thanks to SarkariCourse, I cleared SSC CGL in my first attempt. The study materials and mock tests were extremely helpful. Never thought free education could be this effective!'],
        ['name'=>'Priya Singh',  'tag'=>'Railway NTPC, 2023',   'init'=>'P','text'=>'The best platform for free education. Qualified Railway NTPC with an excellent rank. The content quality is exceptional and highly recommended for all exam aspirants!'],
        ['name'=>'Aman Verma',   'tag'=>'UPSC CSE, 2023',       'init'=>'A','text'=>'SarkariCourse made my UPSC journey easier. The content quality is outstanding and completely free. Expert faculty and live classes were extremely helpful throughout.'],
    ];
@endphp

<main class="sc-scope sc-home">

{{-- ════════════════════════════════ HERO ════════════════════════════════ --}}
<section class="sc-hero" aria-label="Hero section">
    <div class="sc-hero-bg" aria-hidden="true">
        <span class="sc-blob sc-blob-1"></span>
        <span class="sc-blob sc-blob-2"></span>
    </div>

    <div class="sc-container sc-hero-grid">

        {{-- Copy --}}
        <div class="sc-hero-copy">
            <span class="sc-hero-eyebrow">
                <span class="sc-hero-eyebrow-dot" aria-hidden="true"></span>
                100% Free Learning Platform
            </span>

            <h1 class="sc-hero-title">
                Crack Government Exams with
                <span class="sc-hero-title-accent">India's Most Trusted<br>Free Platform</span>
            </h1>

            <p class="sc-hero-sub">
                Access free high-quality courses, mock tests, study notes,
                current affairs and expert guidance for SSC, Railway,
                Banking, UPSC and more.
            </p>

            <div class="sc-hero-actions">
                <a href="{{ auth()->check() ? route('courses') : route('userlogin') }}"
                   class="sc-btn sc-btn-primary" id="btn-hero-start">
                    Start Learning Free
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline" id="btn-hero-explore">Explore Courses</a>
            </div>

            <div class="sc-hero-proof">
                <div class="sc-avatars" aria-hidden="true">
                    <span class="sc-avatar sc-avatar-a">R</span>
                    <span class="sc-avatar sc-avatar-b">P</span>
                    <span class="sc-avatar sc-avatar-c">A</span>
                    <span class="sc-avatar sc-avatar-d">S</span>
                </div>
                <div class="sc-proof-copy">
                    <strong>12,000+ Students</strong> already learning
                    <span class="sc-stars">★★★★★ 4.9 (5,000+ reviews)</span>
                </div>
            </div>
        </div>

        {{-- Visual --}}
        <div class="sc-hero-visual" aria-hidden="true">
            <div class="sc-hero-img-circle"></div>
            <img src="{{ asset('images/hero/hero-student-laptop-new.jpg') }}"
                 alt="Student studying for government exams"
                 class="sc-hero-img"
                 onerror="this.src='{{ asset('images/hero/hero-student-preparation-alt-3d.webp') }}'">
        </div>

    </div>
</section>

{{-- ════════════════════════════════ STATS BAR ════════════════════════════════ --}}
<div class="sc-stats-bar">
    <div class="sc-container">
        <div class="sc-stats-grid">
            <div class="sc-stat-item">
                <div class="sc-lottie-stat"
                     data-lottie="{{ asset('lottie/stat-students.json') }}"
                     data-lottie-loop="true"
                     aria-hidden="true"></div>
                <div>
                    <span class="sc-stat-num"><span data-counter="{{ max($totalStudents, 10000) }}" data-suffix="+">10,000+</span></span>
                    <span class="sc-stat-label">Active Students</span>
                </div>
            </div>
            <div class="sc-stat-item">
                <div class="sc-lottie-stat"
                     data-lottie="{{ asset('lottie/stat-courses.json') }}"
                     data-lottie-loop="true"
                     aria-hidden="true"></div>
                <div>
                    <span class="sc-stat-num"><span data-counter="{{ max($totalCourses, 500) }}" data-suffix="+">500+</span></span>
                    <span class="sc-stat-label">Free Courses</span>
                </div>
            </div>
            <div class="sc-stat-item">
                <div class="sc-lottie-stat"
                     data-lottie="{{ asset('lottie/stat-educators.json') }}"
                     data-lottie-loop="true"
                     aria-hidden="true"></div>
                <div>
                    <span class="sc-stat-num">1500+</span>
                    <span class="sc-stat-label">Educators</span>
                </div>
            </div>
            <div class="sc-stat-item">
                <div class="sc-lottie-stat"
                     data-lottie="{{ asset('lottie/stat-success.json') }}"
                     data-lottie-loop="true"
                     aria-hidden="true"></div>
                <div>
                    <span class="sc-stat-num">95%</span>
                    <span class="sc-stat-label">Success Rate</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════ CATEGORIES ════════════════════════════════ --}}
@php
    $catDescriptions = [
        'ssc'       => 'Staff Selection Commission',
        'railway'   => 'Railway Recruitment Board',
        'banking'   => 'Bank PO, Clerk & Other Exams',
        'upsc'      => 'Union Public Service Commission',
        'statepsc'  => 'State Public Service Commissions',
        'state psc' => 'State Public Service Commissions',
        'police'    => 'Police Recruitment Exams',
    ];
@endphp
<section class="sc-section" aria-labelledby="cat-heading">
    <div class="sc-container">
        <div class="sc-section-head reveal-up">
            <span class="sc-eyebrow">✦ POPULAR EXAM CATEGORIES ✦</span>
            <h2 class="sc-section-title sc-title-simple" id="cat-heading">Choose Your Exam, Start Your Preparation</h2>
            <p class="sc-section-sub">All government exam preparation in one place</p>
        </div>

        <div class="sc-cat-grid" data-reveal-group>
            @forelse($categories->take(6) as $i => $cat)
                @php
                    $ck = strtolower(preg_replace('/[^a-z]/i','', $cat->name));
                    $colorMap = ['ssc'=>'cat-ssc','railway'=>'cat-rail','banking'=>'cat-bank','upsc'=>'cat-upsc','statepsc'=>'cat-state','police'=>'cat-police'];
                    $colorClass = $colorMap[$ck] ?? 'cat-def';
                    $dc = $defaultCats[$i] ?? end($defaultCats);
                    $desc = $cat->description ?? $catDescriptions[$ck] ?? $catDescriptions[strtolower($cat->name)] ?? 'Government Exam Preparation';
                    $countVal = ($cat->courses_count && $cat->courses_count > 0) ? $cat->courses_count : rand(75, 120);
                @endphp
                <a href="{{ route('courses', ['category' => $cat->name]) }}" class="sc-cat-card" id="cat-{{ $ck }}">
                    <span class="sc-cat-icon {{ $colorClass }}" aria-hidden="true">{!! $dc['icon'] !!}</span>
                    <span class="sc-cat-name">{{ $cat->name }}</span>
                    <span class="sc-cat-desc">{{ $desc }}</span>
                    <span class="sc-cat-count">{{ $countVal }}+ Courses</span>
                </a>
            @empty
                @foreach($defaultCats as $i => $cat)
                    @php
                        $desc = $catDescriptions[$cat['key']] ?? 'Government Exam Preparation';
                    @endphp
                    <a href="{{ route('courses') }}" class="sc-cat-card" id="cat-{{ $cat['key'] }}">
                        <span class="sc-cat-icon {{ $cat['color'] }}" aria-hidden="true">{!! $cat['icon'] !!}</span>
                        <span class="sc-cat-name">{{ $cat['name'] }}</span>
                        <span class="sc-cat-desc">{{ $desc }}</span>
                        <span class="sc-cat-count">{{ $cat['count'] }} Courses</span>
                    </a>
                @endforeach
            @endforelse
        </div>

        <div class="sc-center-cta reveal-up">
            <a href="{{ route('courses') }}" class="sc-btn sc-btn-pill-primary" id="btn-all-cats">View All Categories →</a>
        </div>
    </div>
</section>

{{-- ════════════════════════════════ WHY CHOOSE ════════════════════════════════ --}}
<section class="sc-section sc-section-alt" aria-labelledby="why-heading">
    <div class="sc-container">
        <div class="sc-section-head reveal-up">
            <h2 class="sc-section-title sc-title-simple" id="why-heading">Quality Education, Completely Free</h2>
            <div class="sc-title-bar" aria-hidden="true"></div>
        </div>

        <div class="sc-feature-grid" data-reveal-group>
            @foreach($features as $f)
                <div class="sc-feature-item">
                    <div class="sc-feature-icon {{ $f['colorClass'] }}" aria-hidden="true">{!! $f['icon'] !!}</div>
                    <div class="sc-feature-content">
                        <h3>{{ $f['title'] }}</h3>
                        <p>{{ $f['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════ COURSES ════════════════════════════════ --}}
<section class="sc-section" aria-labelledby="courses-heading">
    <div class="sc-container">
        <div class="sc-section-head reveal-up">
            <span class="sc-eyebrow">✦ FEATURED COURSES ✦</span>
            <h2 class="sc-section-title sc-title-simple" id="courses-heading">Top Free Courses This Month</h2>
            <p class="sc-section-sub">Explore our most popular free courses</p>
        </div>

        @php
            $thumbMap = ['ssc'=>'ssc','railway'=>'rail','banking'=>'bank','upsc'=>'upsc','statepsc'=>'state','police'=>'police'];
        @endphp

        <div class="sc-course-grid" data-reveal-group>
            @forelse($featuredCourses->take(4) as $course)
                @php
                    $ck2 = strtolower(preg_replace('/[^a-z]/i','', $course->category ?? ''));
                    $tclass = $thumbMap[$ck2] ?? 'def';
                    $dc2 = collect($defaultCourses)->firstWhere('key', $tclass) ?? $defaultCourses[0];
                @endphp
                <a href="{{ route('course_details', $course) }}" class="sc-course-card" id="course-{{ $course->id }}">
                    <div class="sc-course-thumb sc-course-thumb-{{ $tclass }}{{ $course->thumbnail_url ? ' sc-thumb-bg-img' : '' }}"
                         @if($course->thumbnail_url) style="background-image:url('{{ $course->thumbnail_url }}')" @endif>
                        <span class="sc-course-free">FREE</span>
                        @if(!$course->thumbnail_url)
                            <span class="sc-course-thumb-ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            </span>
                        @endif
                    </div>
                    <div class="sc-course-body">
                        <span class="sc-course-cat-tag">{{ $course->category }}</span>
                        <h3>{{ $course->title }}</h3>
                        <div class="sc-course-meta">
                            <span>{{ $course->teacher_name }}</span>
                            <span>{{ ucfirst($course->level) }}</span>
                        </div>
                        <div class="sc-course-rating">
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span style="margin-left:4px;">4.8</span>
                        </div>
                        <span class="sc-enroll-btn">Enroll Now →</span>
                    </div>
                </a>
            @empty
                @foreach(collect($defaultCourses)->take(4) as $i => $c)
                    <a href="{{ route('courses') }}" class="sc-course-card" id="course-demo-{{ $i + 1 }}">
                        <div class="sc-course-thumb sc-course-thumb-{{ $c['key'] }}">
                            <span class="sc-course-free">FREE</span>
                            <span class="sc-course-thumb-ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            </span>
                        </div>
                        <div class="sc-course-body">
                            <span class="sc-course-cat-tag">{{ $c['cat'] }}</span>
                            <h3>{{ $c['title'] }}</h3>
                            <div class="sc-course-meta">
                                <span>{{ $c['teacher'] }}</span>
                                <span>{{ $c['level'] }}</span>
                            </div>
                            <div class="sc-course-rating">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                <span style="margin-left:4px;">{{ $c['rating'] }} | {{ $c['students'] }}</span>
                            </div>
                            <span class="sc-enroll-btn">Enroll Now →</span>
                        </div>
                    </a>
                @endforeach
            @endforelse
        </div>

        <div class="sc-center-cta reveal-up">
            <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline" id="btn-all-courses">View All Courses →</a>
        </div>
    </div>
</section>

{{-- ════════════════════════════════ TESTIMONIALS ════════════════════════════════ --}}
<section class="sc-section sc-section-alt" aria-labelledby="testi-heading">
    <div class="sc-container">
        <div class="sc-section-head reveal-up">
            <span class="sc-eyebrow">✦ SUCCESS STORIES ✦</span>
            <h2 class="sc-section-title sc-title-simple" id="testi-heading">Real Results from Real Students</h2>
        </div>

        <div class="sc-testi-wrapper">
            <!-- Left Prev Button -->
            <button type="button" class="sc-slider-btn sc-slider-prev" id="testi-prev-btn" aria-label="Previous testimonial">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#7c3aed" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </button>

            <!-- Testimonial Grid -->
            <div class="sc-testi-grid" id="scTestiGrid" data-reveal-group>
                @foreach($testimonials as $i => $t)
                    <blockquote class="sc-testi-card" id="testi-{{ $i + 1 }}">
                        <div class="sc-quote-box" aria-hidden="true">&ldquo;</div>
                        <p>{{ $t['text'] }}</p>
                        <footer class="sc-testi-footer">
                            <span class="sc-testi-avatar">{{ $t['init'] }}</span>
                            <div>
                                <strong>{{ $t['name'] }}</strong>
                                <cite>{{ $t['tag'] }}</cite>
                            </div>
                        </footer>
                    </blockquote>
                @endforeach
            </div>

            <!-- Right Next Button -->
            <button type="button" class="sc-slider-btn sc-slider-next" id="testi-next-btn" aria-label="Next testimonial">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#7c3aed" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>

        <div class="sc-dots" id="scTestiDots" aria-label="Testimonial navigation" role="tablist">
            <button class="sc-dot is-active" id="dot-1" aria-label="Slide 1"></button>
            <button class="sc-dot" id="dot-2" aria-label="Slide 2"></button>
            <button class="sc-dot" id="dot-3" aria-label="Slide 3"></button>
        </div>
    </div>
</section>

{{-- ════════════════════════════════ BLOG ════════════════════════════════ --}}
@if($homeLatestBlogs->count())
<section class="sc-section" aria-labelledby="blog-heading">
    <div class="sc-container">
        <div class="sc-section-head reveal-up">
            <span class="sc-eyebrow">✦ FROM THE BLOG ✦</span>
            <h2 class="sc-section-title sc-title-simple" id="blog-heading">Latest Updates &amp; Exam Tips</h2>
        </div>

        <div class="sc-blog-grid" data-reveal-group>
            @foreach($homeLatestBlogs as $post)
                <a href="{{ route('blog.show', $post) }}" class="sc-blog-card" id="blog-{{ $loop->index + 1 }}">
                    <div class="sc-blog-thumb" @if($post->thumbnail) style="background-image:url('{{ asset('storage/'.$post->thumbnail) }}')" @endif></div>
                    <div class="sc-blog-body">
                        <span class="sc-blog-tag">{{ $post->category }}</span>
                        <h3>{{ Str::limit($post->title, 62) }}</h3>
                        <span class="sc-blog-date">{{ optional($post->published_at)->format('d M Y') }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="sc-center-cta reveal-up">
            <a href="{{ route('blog') }}" class="sc-btn sc-btn-outline" id="btn-read-blog">Read More Articles</a>
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════ CTA BAND ════════════════════════════════ --}}
<section class="sc-section">
    <div class="sc-container">
        <div class="sc-cta-band reveal-scale" id="cta-band">
            {{-- Dot grid background decorations --}}
            <div class="sc-cta-dots-tl" aria-hidden="true"></div>
            <div class="sc-cta-dots-br" aria-hidden="true"></div>

            {{-- Left side 3D visual from images/hero/cta-books-graduation-cap-3d.webp --}}
            <div class="sc-cta-visual">
                <div class="sc-cta-glow" aria-hidden="true"></div>
                <img src="{{ asset('images/hero/cta-books-graduation-cap-3d.webp') }}"
                     alt="Graduation Books & Cap"
                     class="sc-cta-img sc-float"
                     onerror="this.src='{{ asset('images/hero/cta-books-new.jpg') }}'">
            </div>

            {{-- Right side copy & buttons --}}
            <div class="sc-cta-content">
                <h2>Ready to Start Your Success Journey?</h2>
                <p>Join thousands of students who are already preparing with SarkariCourse. It's free, it's proven, It works!</p>
                <div class="sc-cta-btns">
                    <a href="{{ auth()->check() ? route('courses') : route('userlogin') }}"
                       class="sc-btn sc-btn-cta-white" id="btn-cta-start">
                        Start Learning Free
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-cta-outline" id="btn-cta-explore">Explore Courses</a>
                </div>
            </div>
        </div>
    </div>
</section>

</main>
@endsection
