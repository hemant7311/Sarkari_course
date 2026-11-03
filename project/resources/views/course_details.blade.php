@extends('layouts.first')

@section('title', $course->title.' - SarkariCourse')
@section('meta_description', Str::limit(strip_tags($course->description), 155))

@section('content')
<main class="sc-scope sc-cdetail">

    {{-- ══════════════════ BREADCRUMB ══════════════════ --}}
    <div class="sc-container sc-cdetail-crumb">
        <nav class="sc-breadcrumb">
            <a href="{{ route('home') }}">Home</a> <span>›</span>
            <a href="{{ route('courses') }}">Courses</a> <span>›</span>
            <a href="{{ route('courses', ['category' => $course->category]) }}">{{ $course->category }}</a> <span>›</span>
            <span>{{ Str::limit($course->title, 40) }}</span>
        </nav>
    </div>

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-cdetail-hero">
        <div class="sc-container sc-cdetail-hero-grid">

            <div class="sc-cdetail-preview reveal-left">
                <div class="sc-cdetail-video" style="@if($course->thumbnail_url) background-image:url('{{ $course->thumbnail_url }}'); @endif">
                    <span class="sc-live-badge">● Live Batch</span>
                    @if($firstPlayable)
                        <button type="button" class="sc-play-btn" onclick="document.getElementById('scCoursePreview').classList.add('is-open')" aria-label="Play preview">
                            <svg viewBox="0 0 24 24" width="26" height="26" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                        </button>
                    @endif
                </div>
                <ul class="sc-cdetail-highlights">
                    <li>✅ Live Classes</li>
                    <li>✅ Study Material (PDF)</li>
                    <li>✅ Mock Tests</li>
                    <li>✅ Doubt Support</li>
                </ul>
            </div>

            <div class="reveal-right">
                <div class="sc-cdetail-tags">
                    <span class="sc-tag-gold">Best Seller</span>
                    <span class="sc-tag-outline">{{ $course->level }}</span>
                </div>
                <h1>{{ $course->title }}</h1>
                <p class="sc-cdetail-desc">{{ Str::limit(strip_tags($course->description), 160) }}</p>

                <div class="sc-cdetail-meta">
                    <span>👤 {{ $course->teacher_name }}</span>
                    <span>🎓 {{ $course->students()->count() }} Students Enrolled</span>
                </div>

                <div class="sc-cdetail-stats">
                    <div class="sc-stat-pill">
                        <span class="sc-stat-icon">🎥</span>
                        <div><strong>{{ $course->chapters->count() }}</strong><span>Classes</span></div>
                    </div>
                    <div class="sc-stat-pill">
                        <span class="sc-stat-icon">📄</span>
                        <div><strong>Free</strong><span>Access</span></div>
                    </div>
                    <div class="sc-stat-pill">
                        <span class="sc-stat-icon">🏷️</span>
                        <div><strong>{{ $course->category }}</strong><span>Category</span></div>
                    </div>
                </div>

                <div class="sc-enroll-box">
                    @auth
                        @if($isEnrolled)
                            <a href="{{ route('dashboard') }}" class="sc-btn sc-btn-primary sc-btn-lg">Go to My Dashboard</a>
                            <p class="sc-enroll-note">✅ Aap already enrolled hain</p>
                        @else
                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="sc-btn sc-btn-primary sc-btn-lg" style="width:100%">Enroll Now — It's Free</button>
                            </form>
                            <p class="sc-enroll-note">Limited time access</p>
                        @endif
                    @else
                        <a href="{{ route('userlogin') }}" class="sc-btn sc-btn-primary sc-btn-lg">Login to Enroll</a>
                        <p class="sc-enroll-note">Free account, 2 minute signup</p>
                    @endauth
                    <div class="sc-enroll-actions">
                        <button type="button" class="sc-icon-text-btn">♡ Wishlist</button>
                        <button type="button" class="sc-icon-text-btn">⇄ Share</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ TABS / CONTENT ══════════════════ --}}
    <section class="sc-section" aria-label="Course content">
        <div class="sc-container sc-cdetail-body-grid">

            <div class="sc-cdetail-main">

                {{-- Overview --}}
                <div class="sc-cdetail-block reveal-up" id="overview">
                    <h2>Course Overview</h2>
                    <div class="sc-cdetail-rich">{!! nl2br(e($course->description)) !!}</div>
                </div>

                {{-- Curriculum / Class list --}}
                <div class="sc-cdetail-block reveal-up" id="curriculum">
                    <div class="sc-block-head">
                        <h2>All Classes ({{ $course->chapters->count() }})</h2>
                    </div>

                    <div class="sc-class-list" data-reveal-group>
                        @forelse($course->chapters as $i => $chapter)
                            @php $unlocked = $chapter->is_preview || $isEnrolled; @endphp
                            <div class="sc-class-item {{ $unlocked ? 'unlocked' : '' }}">
                                <span class="sc-class-play">
                                    @if($unlocked) ▶ @else 🔒 @endif
                                </span>
                                <div class="sc-class-info">
                                    <strong>{{ $chapter->title }}</strong>
                                    <span>Class {{ $i + 1 }} @if($chapter->duration_minutes) · {{ $chapter->duration_minutes }} min @endif</span>
                                </div>
                                @if($unlocked && $chapter->embed_url)
                                    <a href="{{ $chapter->embed_url }}" target="_blank" rel="noopener" class="sc-btn sc-btn-ghost sc-btn-sm">Watch</a>
                                @endif
                            </div>
                        @empty
                            <p class="sc-empty-note">Class list will be updated soon.</p>
                        @endforelse
                    </div>
                </div>

                {{-- FAQ --}}
                <div class="sc-cdetail-block reveal-up" id="faq">
                    <h2>Frequently Asked Questions</h2>
                    <div class="sc-faq-grid sc-faq-grid-1col">
                        @php
                            $cFaqs = [
                                ['q' => 'Is this course really free?', 'a' => 'Yes — every course on SarkariCourse, including this one, is 100% free to access after enrolling.'],
                                ['q' => 'Do I get a certificate after completion?', 'a' => 'Digital certificates are available for select completed courses from your dashboard.'],
                                ['q' => 'Can I access classes on mobile?', 'a' => 'Yes, the platform is fully responsive and classes stream directly in your browser.'],
                            ];
                        @endphp
                        @foreach($cFaqs as $i => $faq)
                            <details class="sc-faq-item" @if($i === 0) open @endif>
                                <summary>{{ $faq['q'] }}<span class="sc-faq-toggle">+</span></summary>
                                <p>{{ $faq['a'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="sc-cdetail-sidebar reveal-right">
                <div class="sc-instructor-card">
                    <span class="sc-instructor-avatar">{{ strtoupper(substr($course->teacher_name,0,1)) }}</span>
                    <div>
                        <span class="sc-eyebrow">Instructor</span>
                        <strong>{{ $course->teacher_name }}</strong>
                        <span class="sc-instructor-sub">{{ $course->category }} Expert</span>
                    </div>
                </div>

                <div class="sc-side-card">
                    <h3>Course Includes</h3>
                    <ul class="sc-side-list">
                        <li>🎥 {{ $course->chapters->count() }} on-demand classes</li>
                        <li>📄 Downloadable study material</li>
                        <li>📱 Access on mobile &amp; desktop</li>
                        <li>🏆 Certificate of completion</li>
                        <li>💬 Doubt support</li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    {{-- ══════════════════ RELATED COURSES ══════════════════ --}}
    @if($relatedCourses->count())
    <section class="sc-section sc-section-alt" aria-labelledby="related-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">You May Also Like</span>
                <h2 id="related-heading">Related <span class="sc-accent">Courses</span></h2>
            </div>
            <div class="sc-course-grid" data-reveal-group>
                @foreach($relatedCourses as $rc)
                    <a href="{{ route('course_details', $rc) }}" class="sc-course-card sc-card">
                        <div class="sc-course-thumb" style="@if($rc->thumbnail_url) background-image:url('{{ $rc->thumbnail_url }}'); @endif">
                            <span class="sc-course-badge">Free</span>
                        </div>
                        <div class="sc-course-body">
                            <span class="sc-course-cat">{{ $rc->category }}</span>
                            <h3>{{ $rc->title }}</h3>
                            <div class="sc-course-meta">
                                <span>👤 {{ $rc->teacher_name }}</span>
                                <span>{{ ucfirst($rc->level) }}</span>
                            </div>
                            <span class="sc-course-link">View Details →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ══════════════════ VIDEO PREVIEW MODAL ══════════════════ --}}
    @if($firstPlayable)
    <div id="scCoursePreview" class="sc-video-modal" aria-hidden="true">
        <div class="sc-video-modal-backdrop" onclick="document.getElementById('scCoursePreview').classList.remove('is-open')"></div>
        <div class="sc-video-modal-dialog">
            <button type="button" class="sc-video-modal-close" onclick="document.getElementById('scCoursePreview').classList.remove('is-open')" aria-label="Close preview">&times;</button>
            <div class="sc-video-modal-frame">
                <iframe src="{{ $firstPlayable->embed_url }}" title="Course preview" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    @endif

</main>
@endsection
