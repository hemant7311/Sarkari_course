@extends('layouts.first')

@section('title', 'Explore Courses - SarkariCourse')
@section('meta_description', 'Browse 500+ free SSC, Railway, Banking, UPSC, Police and State exam courses with live classes, mock tests and study material.')

@section('content')
<main class="sc-scope sc-courses">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-courses-hero" aria-label="Courses hero">
        <div class="sc-hero-bg" aria-hidden="true">
            <span class="sc-blob sc-blob-1"></span>
            <span class="sc-blob sc-blob-2"></span>
        </div>
        <div class="sc-container sc-courses-hero-grid">
            <div class="reveal-up">
                <nav class="sc-breadcrumb"><a href="{{ route('home') }}">Home</a> <span>›</span> <span>Courses</span></nav>
                <h1>Explore Our <span class="sc-grad-text">Top Quality Courses</span></h1>
                <p class="sc-courses-hero-sub">Learn from expert educators and prepare for your dream government job with the best online courses, mock tests, and study materials.</p>

                <form action="{{ route('courses') }}" method="GET" class="sc-courses-search">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses, exams or topics…">
                    <button type="submit" class="sc-btn sc-btn-primary sc-btn-sm">Search</button>
                </form>
            </div>
            <div class="sc-hero-visual reveal-scale">
                <div class="sc-hero-3d" aria-hidden="true" style="background-image:url('{{ asset('images/courses/courses-hero-education-3d.webp') }}')"></div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ CATEGORY CHIPS + FILTERS ══════════════════ --}}
    <section class="sc-section" style="padding-bottom:0">
        <div class="sc-container">
            <div class="sc-course-chips reveal-up">
                <a href="{{ route('courses') }}" class="sc-chip {{ !request('category') ? 'active' : '' }}">🎯 All Courses</a>
                @foreach($categories as $cat)
                    <a href="{{ route('courses', ['category' => $cat->name]) }}" class="sc-chip {{ request('category') == $cat->name ? 'active' : '' }}">
                        {{ $cat->icon ?? '📘' }} {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ COURSE GRID ══════════════════ --}}
    <section class="sc-section" aria-label="Course results">
        <div class="sc-container">

            @if(request('search') || request('category'))
                <p class="sc-results-note reveal-up">
                    {{ $courses->total() }} result{{ $courses->total() === 1 ? '' : 's' }}
                    @if(request('search')) for "<strong>{{ request('search') }}</strong>" @endif
                    @if(request('category')) in <strong>{{ request('category') }}</strong> @endif
                    — <a href="{{ route('courses') }}">clear filters</a>
                </p>
            @endif

            <div class="sc-course-grid-full" data-reveal-group>
                @forelse($courses as $course)
                    <a href="{{ route('course_details', $course) }}" class="sc-course-card sc-card">
                        <div class="sc-course-thumb" style="@if($course->thumbnail_url) background-image:url('{{ $course->thumbnail_url }}'); @endif">
                            <span class="sc-course-badge">Free</span>
                        </div>
                        <div class="sc-course-body">
                            <span class="sc-course-cat">{{ $course->category }}</span>
                            <h3>{{ $course->title }}</h3>
                            <div class="sc-course-meta">
                                <span>👤 {{ $course->teacher_name }}</span>
                                <span>{{ ucfirst($course->level) }}</span>
                            </div>
                            <span class="sc-course-link">View Details →</span>
                        </div>
                    </a>
                @empty
                    <div class="sc-empty-state">
                        <img src="{{ asset('images/search/search-empty-3d.webp') }}" alt="No courses found illustration" width="180" height="150" loading="lazy">
                        <h3>No courses found</h3>
                        <p>Try a different search term or browse all categories.</p>
                        <a href="{{ route('courses') }}" class="sc-btn sc-btn-outline">View All Courses</a>
                    </div>
                @endforelse
            </div>

            @if($courses->hasPages())
                <div class="sc-pagination reveal-up">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- ══════════════════ CTA ══════════════════ --}}
    <section class="sc-section sc-section-alt">
        <div class="sc-container">
            <div class="sc-cta-band reveal-scale">
                <div class="sc-cta-text">
                    <h2>Can't Find the Right Course?</h2>
                    <p>We'll help you find the perfect course for your exam preparation.</p>
                </div>
                <div class="sc-cta-actions">
                    <a href="{{ route('contact') }}" class="sc-btn sc-btn-white">Get Personalized Guidance</a>
                </div>
                <span class="sc-cta-decor" aria-hidden="true"><img src="{{ asset('images/hero/cta-books-graduation-cap-3d.webp') }}" alt=""></span>
            </div>
        </div>
    </section>

</main>
@endsection
