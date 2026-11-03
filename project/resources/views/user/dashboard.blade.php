@extends('layouts.user')

@section('title', 'My Dashboard')

@section('content')
<div class="sc-sdash">

    {{-- ══════════════════ WELCOME BANNER + 3D HERO ══════════════════ --}}
    <div class="sc-sdash-banner">
        <div class="sc-sdash-banner-text reveal-up">
            <span class="sc-badge">🎓 Student Dashboard</span>
            <h1>Welcome back, {{ Str::before(Auth::user()->name, ' ') }} 👋</h1>
            <p>Here's what's happening with your preparation today.</p>
            <div class="sc-sdash-banner-actions">
                <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary sc-btn-arrow">
                    Browse More Courses
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
        <div class="sc-sdash-banner-3d reveal-scale" data-three-hero aria-hidden="true" style="background-image:url('{{ asset('images/dashboard/dashboard-hero-3d.webp') }}')"></div>
    </div>

    {{-- ══════════════════ ACCOUNT OVERVIEW (real data only) ══════════════════ --}}
    <div class="sc-sdash-stat-row" data-reveal-group>
        <div class="sc-sdash-stat-card">
            <span class="sc-sdash-stat-icon">📚</span>
            <div><strong>{{ $enrolledCourses->count() }}</strong><span>Enrolled Courses</span></div>
        </div>
        <div class="sc-sdash-stat-card">
            <span class="sc-sdash-stat-icon">🎓</span>
            <div><strong>Student</strong><span>Account Type</span></div>
        </div>
        <div class="sc-sdash-stat-card">
            <span class="sc-sdash-stat-icon">📱</span>
            <div><strong>{{ Auth::user()->phone ?? '—' }}</strong><span>Contact Number</span></div>
        </div>
        <div class="sc-sdash-stat-card">
            <span class="sc-sdash-stat-icon">🗓️</span>
            <div><strong>{{ Auth::user()->created_at->format('M Y') }}</strong><span>Member Since</span></div>
        </div>
    </div>

    <div class="sc-sdash-layout">
        <div class="sc-sdash-main">

            {{-- ══════════════════ CONTINUE LEARNING (real data only) ══════════════════ --}}
            @if($enrolledCourses->isNotEmpty())
                @php $latestCourse = $enrolledCourses->first(); @endphp
                <section class="sc-sdash-continue reveal-up" aria-labelledby="continue-heading">
                    <h2 id="continue-heading">Continue Learning</h2>
                    <div class="sc-sdash-continue-card">
                        @if($latestCourse->thumbnail_url)
                            <div class="sc-sdash-continue-thumb" style="background-image:url('{{ $latestCourse->thumbnail_url }}')"></div>
                        @else
                            <div class="sc-sdash-continue-thumb sc-sdash-continue-fallback">{{ $latestCourse->category }}</div>
                        @endif
                        <div class="sc-sdash-continue-body">
                            <span class="sc-course-cat">{{ $latestCourse->category }}</span>
                            <h3>{{ $latestCourse->title }}</h3>
                            <p>By {{ $latestCourse->teacher_name }}</p>
                            <a href="{{ route('course_details', $latestCourse) }}" class="sc-btn sc-btn-primary sc-btn-arrow">
                                Resume Course
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </div>
                </section>
            @endif

            {{-- ══════════════════ MY COURSES (real data only) ══════════════════ --}}
            <section class="reveal-up" aria-labelledby="courses-heading">
                <h2 id="courses-heading">My Courses</h2>

                @if($enrolledCourses->isEmpty())
                    <div class="sc-sdash-empty">
                        <span>📭</span>
                        <p>You haven't enrolled in any course yet.</p>
                        <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">Browse Courses</a>
                    </div>
                @else
                    <div class="sc-sdash-course-grid" data-reveal-group>
                        @foreach($enrolledCourses as $course)
                            <div class="sc-sdash-course-card">
                                @if($course->thumbnail_url)
                                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" loading="lazy">
                                @else
                                    <div class="sc-sdash-continue-fallback" style="height:110px;border-radius:var(--r-md);margin-bottom:10px;">{{ $course->category }}</div>
                                @endif
                                <span class="sc-course-cat">{{ $course->category }}</span>
                                <h3>{{ $course->title }}</h3>
                                <p>By {{ $course->teacher_name }}</p>
                                <div class="sc-sdash-course-actions">
                                    <a href="{{ route('course_details', $course) }}" class="sc-btn sc-btn-primary sc-btn-sm" style="flex:1;justify-content:center;">Continue</a>
                                    <form action="{{ route('courses.unenroll', $course) }}" method="POST" onsubmit="return confirm('Remove this course?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sc-icon-btn" aria-label="Unenroll from {{ $course->title }}" title="Unenroll">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>

        {{-- ══════════════════ QUICK ACTIONS (real routes only) ══════════════════ --}}
        <aside class="sc-sdash-side reveal-right">
            <div class="sc-sdash-quick-card">
                <h2>Quick Actions</h2>
                <nav class="sc-sdash-quick-list">
                    <a href="{{ route('courses') }}">
                        <span class="sc-sdash-quick-icon">🔍</span>
                        <span>Browse Courses</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="{{ route('wishlist') }}">
                        <span class="sc-sdash-quick-icon">♡</span>
                        <span>My Wishlist</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="{{ route('notifications') }}">
                        <span class="sc-sdash-quick-icon">🔔</span>
                        <span>Notifications</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="{{ route('profile.edit') }}">
                        <span class="sc-sdash-quick-icon">👤</span>
                        <span>Edit Profile</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    <a href="{{ route('settings') }}">
                        <span class="sc-sdash-quick-icon">⚙️</span>
                        <span>Settings</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </nav>
            </div>
        </aside>
    </div>
</div>
@endsection
