@extends('layouts.first')

@section('title', 'About Us - SarkariCourse | Empowering Aspirants, Building Futures')
@section('meta_description', "SarkariCourse is India's leading free platform for government exam preparation. Learn about our mission, journey and the team behind it.")

@section('content')
<main class="sc-scope sc-about">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-about-hero" aria-label="About hero">
        <div class="sc-hero-bg" aria-hidden="true">
            <span class="sc-blob sc-blob-1"></span>
            <span class="sc-blob sc-blob-2"></span>
        </div>
        <div class="sc-container sc-about-hero-grid">
            <div class="reveal-up">
                <span class="sc-badge">About Us</span>
                <h1>Empowering Aspirants.<br><span class="sc-grad-text">Building Futures.</span></h1>
                <p class="sc-about-hero-sub">
                    SarkariCourse is India's leading platform for government exams preparation.
                    We provide quality education, updated content and the right guidance to help
                    you achieve your dream government job.
                </p>
                <div class="sc-hero-actions">
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">Explore Courses</a>
                    <a href="#our-story" class="sc-btn sc-btn-outline">Learn More</a>
                </div>
            </div>

            <div class="sc-hero-visual reveal-scale">
                <div class="sc-hero-3d" data-three-hero aria-hidden="true" style="background-image:url('{{ asset('images/about/about-hero-government-learning-3d.webp') }}')"></div>
                <div class="sc-float-card sc-float-card-1 sc-float">
                    <span class="sc-float-icon">📡</span>
                    <div><strong>Live Classes</strong><span>Interactive learning</span></div>
                </div>
                <div class="sc-float-card sc-float-card-2 sc-float" style="animation-delay:.6s">
                    <span class="sc-float-icon">📝</span>
                    <div><strong>Mock Tests</strong><span>Practice &amp; improve</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ OUR STORY ══════════════════ --}}
    <section class="sc-section" id="our-story" aria-labelledby="story-heading">
        <div class="sc-container sc-story-grid">
            <div class="sc-story-image reveal-left">
                <div class="sc-story-image-frame">
                    <img src="{{ asset('images/about/about-team-collaboration-3d.webp') }}" alt="Illustration of educators and students collaborating on SarkariCourse" loading="lazy">
                </div>
            </div>
            <div class="reveal-right">
                <span class="sc-badge">Our Story</span>
                <h2 id="story-heading">Our Journey Started With a <span class="sc-accent">Simple Vision</span></h2>
                <p>SarkariCourse was founded with a mission to make quality education accessible to
                    every aspirant, no matter where they come from. We believe that the right
                    guidance and resources can transform lives.</p>
                <ul class="sc-check-list">
                    <li>Quality content created by expert educators</li>
                    <li>Affordable courses for every student</li>
                    <li>Regular updates and real exam experience</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- ══════════════════ MISSION / VISION ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-label="Mission and vision">
        <div class="sc-container">
            <div class="sc-mv-grid" data-reveal-group>
                <div class="sc-mv-card sc-card">
                    <span class="sc-mv-icon">🎯</span>
                    <h3>Our Mission</h3>
                    <p>To provide affordable, accessible and high-quality education to every
                        aspirant and help them achieve their dream government job with confidence.</p>
                </div>
                <div class="sc-mv-card sc-card">
                    <span class="sc-mv-icon">🔭</span>
                    <h3>Our Vision</h3>
                    <p>To become India's most trusted education platform and create a nation of
                        confident and successful government employees.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ STATS ══════════════════ --}}
    <section class="sc-section" aria-label="Statistics">
        <div class="sc-container">
            <div class="sc-about-stats" data-reveal-group>
                <div class="sc-stat-block">
                    <strong><span data-counter="{{ $totalStudents > 0 ? $totalStudents : 500000 }}" data-suffix="+">0</span></strong>
                    <span>Happy Students</span>
                </div>
                <div class="sc-stat-block">
                    <strong><span data-counter="{{ $totalCourses > 0 ? $totalCourses : 250 }}" data-suffix="+">0</span></strong>
                    <span>Expert Faculty Led Courses</span>
                </div>
                <div class="sc-stat-block">
                    <strong><span data-counter="1500" data-suffix="+">0</span></strong>
                    <span>Online Classes</span>
                </div>
                <div class="sc-stat-block">
                    <strong><span data-counter="10" data-suffix="M+">0</span></strong>
                    <span>Tests Attempted</span>
                </div>
                <div class="sc-stat-block">
                    <strong><span data-counter="98" data-suffix="%">0</span></strong>
                    <span>Success Rate</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ JOURNEY TIMELINE ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-labelledby="journey-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Our Journey</span>
                <h2 id="journey-heading">Milestones That Define <span class="sc-accent">Our Journey</span></h2>
            </div>

            <div class="sc-timeline" data-reveal-group>
                @php
                    $milestones = [
                        ['year' => '2020', 'text' => 'Founded SarkariCourse with a small team'],
                        ['year' => '2021', 'text' => 'Launched our first batch of online courses'],
                        ['year' => '2022', 'text' => 'Reached 100K+ students across India'],
                        ['year' => '2023', 'text' => 'Introduced mock tests &amp; current affairs section'],
                        ['year' => '2024', 'text' => 'Crossed 500K+ students with 98% success rate'],
                    ];
                @endphp
                @foreach($milestones as $m)
                    <div class="sc-timeline-item">
                        <span class="sc-timeline-dot"></span>
                        <strong class="sc-num">{{ $m['year'] }}</strong>
                        <p>{!! $m['text'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ TEAM ══════════════════ --}}
    <section class="sc-section" aria-labelledby="team-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Our Team</span>
                <h2 id="team-heading">Meet The People Behind <span class="sc-accent">SarkariCourse</span></h2>
            </div>

            <div class="sc-team-grid" data-reveal-group>
                @php
                    $team = [
                        ['name' => 'Amit Sharma', 'role' => 'Founder &amp; CEO'],
                        ['name' => 'Neha Gupta', 'role' => 'Academic Head'],
                        ['name' => 'Vikram Singh', 'role' => 'Content Head'],
                        ['name' => 'Pooja Verma', 'role' => 'Student Support Head'],
                    ];
                @endphp
                @foreach($team as $person)
                    <div class="sc-team-card sc-card">
                        <span class="sc-team-avatar">{{ strtoupper(substr($person['name'],0,1)) }}</span>
                        <strong>{{ $person['name'] }}</strong>
                        <span>{!! $person['role'] !!}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ ACHIEVEMENTS ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-label="Achievements">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Our Achievements</span>
                <h2>Recognized For <span class="sc-accent">Our Commitment</span></h2>
            </div>
            <div class="sc-achieve-grid" data-reveal-group>
                <div class="sc-achieve-item">🏅 <span>Best EdTech Startup 2023</span></div>
                <div class="sc-achieve-item">🎖️ <span>Education Excellence Award 2023</span></div>
                <div class="sc-achieve-item">🏆 <span>Most Trusted Platform By Students</span></div>
                <div class="sc-achieve-item">⭐ <span>Top Rated Platform On Play Store</span></div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ CTA ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-cta-band reveal-scale">
                <div class="sc-cta-text">
                    <h2>Ready to Achieve Your Dream Job?</h2>
                    <p>Join thousands of successful aspirants and start your journey today.</p>
                </div>
                <div class="sc-cta-actions">
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-white">Explore Courses</a>
                </div>
                <span class="sc-cta-decor" aria-hidden="true"><img src="{{ asset('images/hero/cta-books-graduation-cap-3d.webp') }}" alt=""></span>
            </div>
        </div>
    </section>

</main>
@endsection
