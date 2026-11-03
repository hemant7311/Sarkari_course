@extends('layouts.first')

@section('title', 'SarkariCourse - Free SSC, Railway, Banking, UPSC, Police Exam Preparation')
@section('meta_description', "India's most trusted free platform for SSC, Railway, Banking, UPSC, Police and State Exam preparation with expert faculty and 500+ courses.")

@section('content')

{{-- Homepage-only: latest published posts for the "Latest From The Blog" section.
     Read-only display query in the view layer — no controller/route changes. --}}
@php
    $homeLatestBlogs = \App\Models\Blog::published()->latest('published_at')->take(3)->get();
@endphp

<main class="sc-scope sc-home">

    {{-- ══════════════════════ HERO ══════════════════════ --}}
    <section class="sc-hero" aria-label="Hero">
        <div class="sc-hero-bg" aria-hidden="true">
            <span class="sc-blob sc-blob-1"></span>
            <span class="sc-blob sc-blob-2"></span>
        </div>

        <div class="sc-container sc-hero-grid">
            <div class="sc-hero-copy">
                <span class="sc-badge">🇮🇳 India's #1 Free Exam-Prep Platform</span>

                <h1 class="sc-hero-title">
                    Crack Government Exams with
                    <span class="sc-grad-text">Confidence &amp; Clarity</span>
                </h1>

                <p class="sc-hero-sub">
                    Free high-quality courses, live classes, mock tests and expert
                    guidance for SSC, Railway, Banking, UPSC, Police and State exams —
                    all in one premium learning workspace.
                </p>

                <div class="sc-hero-actions">
                    <a href="{{ auth()->check() ? route('courses') : route('userlogin') }}" class="sc-btn sc-btn-primary">
                        Start Learning Free
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline">Explore Courses</a>
                </div>

                <div class="sc-hero-social-proof">
                    <span class="sc-hero-avatars">
                        <span class="sc-hero-avatar-dot">R</span>
                        <span class="sc-hero-avatar-dot">P</span>
                        <span class="sc-hero-avatar-dot">A</span>
                        <span class="sc-hero-avatar-dot">S</span>
                    </span>
                    <div class="sc-hero-social-text">
                        <strong>10,000+ Students already learning</strong>
                        <span class="sc-hero-rating"><span class="sc-hero-stars">★★★★★</span> 4.8 (2.5K Reviews)</span>
                    </div>
                </div>

            </div>

            <div class="sc-hero-visual">
                <div class="sc-hero-3d" data-three-hero aria-hidden="true" style="background-image:url('{{ asset('images/hero/hero-student-with-laptop-3d.webp') }}')"></div>

                <div class="sc-float-card sc-float-card-1 sc-float">
                    <span class="sc-float-icon sc-float-icon-purple">📡</span>
                    <div><strong>32+</strong><span>Live Classes</span><span class="sc-float-sub">Daily Live Sessions</span></div>
                </div>
                <div class="sc-float-card sc-float-card-2 sc-float" style="animation-delay:.4s">
                    <span class="sc-float-icon sc-float-icon-green">📝</span>
                    <div><strong>1250+</strong><span>Mock Tests</span><span class="sc-float-sub">Tests Available</span></div>
                </div>
                <div class="sc-float-card sc-float-card-3 sc-float" style="animation-delay:.8s">
                    <span class="sc-float-icon sc-float-icon-orange">🎯</span>
                    <div><strong>95%</strong><span>Success Rate</span><span class="sc-float-sub">Our Students</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ QUICK STATS BAND ══════════════════ --}}
    <section class="sc-stats-band-wrap" aria-label="Platform stats">
        <div class="sc-container">
            <div class="sc-stats-band" data-reveal-group>
                <div class="sc-stats-item">
                    <span class="sc-stats-icon sc-stats-icon-purple">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    <div><strong><span data-counter="{{ $totalStudents > 0 ? $totalStudents : 10000 }}" data-suffix="+">0</span></strong><span>Active Students</span></div>
                </div>
                <div class="sc-stats-item">
                    <span class="sc-stats-icon sc-stats-icon-blue">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </span>
                    <div><strong><span data-counter="{{ $totalCourses > 0 ? $totalCourses : 500 }}" data-suffix="+">0</span></strong><span>Free Courses</span></div>
                </div>
                <div class="sc-stats-item">
                    <span class="sc-stats-icon sc-stats-icon-green">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </span>
                    <div><strong><span data-counter="1500" data-suffix="+">0</span></strong><span>Selections</span></div>
                </div>
                <div class="sc-stats-item">
                    <span class="sc-stats-icon sc-stats-icon-orange">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/><path d="M20 12c0 5-8 9-8 9s-8-4-8-9a8 8 0 0 1 16 0z"/></svg>
                    </span>
                    <div><strong><span data-counter="95" data-suffix="%">0</span></strong><span>Success Rate</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ CATEGORIES ══════════════════ --}}
    <section class="sc-section" aria-labelledby="cat-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Popular Exam Categories</span>
                <h2 id="cat-heading">Choose Your Exam, Start Your <span class="sc-accent">Preparation</span></h2>
                <p>All government exam preparation in one place.</p>
            </div>

            <div class="sc-cat-grid" data-reveal-group>
                @php $catColors = ['purple','blue','green','orange','pink','teal']; @endphp
                @forelse($categories->take(6)->values() as $i => $cat)
                    <a href="{{ route('courses', ['category' => $cat->name]) }}" class="sc-cat-card sc-card">
                        <span class="sc-cat-icon sc-cat-icon-{{ $catColors[$i % 6] }}">{{ $cat->icon ?? '🎓' }}</span>
                        <strong>{{ $cat->name }}</strong>
                        <span>{{ $cat->courses_count ?? '' }} Courses</span>
                    </a>
                @empty
                    @php $catFallback = ['SSC' => '📝','Railway' => '🚆','Banking' => '🏦','UPSC' => '🏛️','State PSC' => '🗳️','Police' => '👮']; $i = 0; @endphp
                    @foreach($catFallback as $name => $icon)
                        <a href="{{ route('courses') }}" class="sc-cat-card sc-card">
                            <span class="sc-cat-icon sc-cat-icon-{{ $catColors[$i % 6] }}">{{ $icon }}</span>
                            <strong>{{ $name }}</strong>
                            <span>Explore</span>
                        </a>
                        @php $i++; @endphp
                    @endforeach
                @endforelse
            </div>

            <div class="sc-center-cta reveal-up">
                <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">View All Categories</a>
            </div>
        </div>
    </section>

    {{-- ══════════════════ WHY CHOOSE US ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-labelledby="why-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Why Choose SarkariCourse?</span>
                <h2 id="why-heading">Quality Education, <span class="sc-accent">Completely Free</span></h2>
            </div>

            <div class="sc-feature-grid" data-reveal-group>
                @php
                    $features = [
                        ['icon' => '🎯', 'title' => '100% Free Courses', 'text' => 'All courses, study materials and resources are completely free for everyone.'],
                        ['icon' => '👨‍🏫', 'title' => 'Expert Faculty', 'text' => 'Learn from experienced educators and toppers with proven teaching track records.'],
                        ['icon' => '📡', 'title' => 'Live Classes', 'text' => 'Join daily live classes and interact with faculty in real-time.'],
                        ['icon' => '📝', 'title' => 'Mock Tests', 'text' => 'Practice unlimited mock tests with detailed performance analysis.'],
                        ['icon' => '📚', 'title' => 'Study Materials', 'text' => 'Download free high-quality notes, PDFs and eBooks.'],
                        ['icon' => '📰', 'title' => 'Current Affairs', 'text' => 'Stay updated with daily, weekly and monthly current affairs.'],
                        ['icon' => '💬', 'title' => 'Doubt Support', 'text' => 'Get your doubts cleared by experts through our support system.'],
                        ['icon' => '📈', 'title' => 'Progress Tracking', 'text' => 'Track your progress and improve your preparation every day.'],
                    ];
                @endphp
                @php $featColors = ['purple','blue','teal','navy','green','pink','orange','purple']; @endphp
                @foreach($features as $i => $f)
                    <div class="sc-feature-card">
                        <span class="sc-feature-icon sc-feature-icon-{{ $featColors[$i % 8] }}">{{ $f['icon'] }}</span>
                        <h3>{{ $f['title'] }}</h3>
                        <p>{{ $f['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ FEATURED COURSES ══════════════════ --}}
    <section class="sc-section" aria-labelledby="courses-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Featured Courses</span>
                <h2 id="courses-heading">Top Free Courses This <span class="sc-accent">Month</span></h2>
                <p>Explore our most popular courses, built by expert educators.</p>
            </div>

            <div class="sc-course-grid" data-reveal-group>
                @php $thumbColors = ['purple','blue','green','orange','pink']; @endphp
                @forelse($featuredCourses as $i => $course)
                    <a href="{{ route('course_details', $course) }}" class="sc-course-card sc-card">
                        <div class="sc-course-thumb {{ $course->thumbnail_url ? '' : 'sc-course-thumb-'.$thumbColors[$i % 5] }}" style="@if($course->thumbnail_url) background-image:url('{{ $course->thumbnail_url }}'); @endif">
                            <span class="sc-course-badge">Free</span>
                        </div>
                        <div class="sc-course-body">
                            <span class="sc-course-cat">{{ $course->category }}</span>
                            <h3>{{ $course->title }}</h3>
                            <div class="sc-course-meta">
                                <span>📚 {{ $course->chapters()->count() }} Lessons</span>
                                <span>{{ ucfirst($course->level) }}</span>
                            </div>
                            <span class="sc-course-link">Enroll Now →</span>
                        </div>
                    </a>
                @empty
                    <p class="sc-empty-note">New courses are being added regularly — check back soon!</p>
                @endforelse
            </div>

            <div class="sc-center-cta reveal-up">
                <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline">View All Courses</a>
            </div>
        </div>
    </section>

    {{-- ══════════════════ SUCCESS STORIES ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-labelledby="stories-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Success Stories</span>
                <h2 id="stories-heading">Real Results from Real <span class="sc-accent">Students</span></h2>
            </div>

            <div class="sc-testimonial-grid" data-reveal-group>
                @php
                    $testimonials = [
                        ['name' => 'Rahul Kumar', 'tag' => 'SSC CGL 2023', 'text' => 'Thanks to SarkariCourse, I cleared SSC CGL in my first attempt. The study materials and mock tests were extremely helpful.'],
                        ['name' => 'Priya Singh', 'tag' => 'Railway NTPC 2023', 'text' => 'The best platform for free education. Qualified Railway NTPC with an excellent rank. Highly recommended!'],
                        ['name' => 'Aman Verma', 'tag' => 'UPSC CSE 2023', 'text' => 'SarkariCourse made my UPSC journey easier. The content quality is exceptional and completely free!'],
                    ];
                @endphp
                @foreach($testimonials as $t)
                    <blockquote class="sc-testimonial-card sc-card">
                        <span class="sc-quote-mark" aria-hidden="true">&ldquo;</span>
                        <p>{{ $t['text'] }}</p>
                        <footer>
                            <span class="sc-avatar-dot">{{ strtoupper(substr($t['name'],0,1)) }}</span>
                            <div><strong>{{ $t['name'] }}</strong><cite>{{ $t['tag'] }}</cite></div>
                        </footer>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ LATEST FROM THE BLOG ══════════════════ --}}
    @if($homeLatestBlogs->count())
    <section class="sc-section" aria-labelledby="blog-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">From The Blog</span>
                <h2 id="blog-heading">Latest Updates &amp; <span class="sc-accent">Exam Tips</span></h2>
            </div>

            <div class="sc-blog-grid" data-reveal-group>
                @foreach($homeLatestBlogs as $post)
                    <a href="{{ route('blog.show', $post) }}" class="sc-blog-card sc-card">
                        <div class="sc-blog-thumb" @if($post->thumbnail) style="background-image:url('{{ asset('storage/'.$post->thumbnail) }}')" @endif></div>
                        <div class="sc-blog-body">
                            <span class="sc-blog-cat">{{ $post->category }}</span>
                            <h3>{{ Str::limit($post->title, 62) }}</h3>
                            <span class="sc-blog-date">{{ optional($post->published_at)->format('d M Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="sc-center-cta reveal-up">
                <a href="{{ route('blog') }}" class="sc-btn sc-btn-outline">Read More Articles</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ══════════════════ NEWSLETTER + CTA ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-cta-band reveal-scale">
                <div class="sc-cta-text">
                    <h2>Ready to Start Your Success Journey?</h2>
                    <p>Join thousands of aspirants already preparing with SarkariCourse. It's free, it's proven, it works!</p>
                </div>
                <div class="sc-cta-actions">
                    <a href="{{ auth()->check() ? route('courses') : route('userlogin') }}" class="sc-btn sc-btn-white">Start Learning Free</a>
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline sc-btn-outline-dark">Explore Courses</a>
                </div>
                <span class="sc-cta-decor" aria-hidden="true"><img src="{{ asset('images/hero/cta-books-graduation-cap-3d.webp') }}" alt=""></span>
            </div>
        </div>
    </section>

</main>
@endsection
