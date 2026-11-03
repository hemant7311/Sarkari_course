@extends('layouts.first')

@section('title', 'About Us - SarkariCourse | Empowering Aspirants, Building Futures')
@section('meta_description', "SarkariCourse is India's leading free platform for government exam preparation. Learn about our mission, journey and the team behind it.")

@section('content')
<main class="sc-scope sc-about">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-about-hero" aria-label="About hero">
        <div class="sc-hero-bg" aria-hidden="true"></div>
        <div class="sc-container sc-about-hero-grid">
            <div class="sc-hero-content reveal-up">
                <div class="sc-badge-wrap"><span class="sc-badge-new">ABOUT US</span></div>
                <h1>Empowering Aspirants.<br><span class="sc-grad-text">Building Futures.</span></h1>
                <p class="sc-about-hero-sub">
                    SarkariCourse is India's leading platform for government exams preparation. We provide quality education, updated content and the right guidance to help you achieve your dream government job.
                </p>
                <div class="sc-hero-actions">
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">
                        Explore Courses
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:8px"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </a>
                    <a href="#our-story" class="sc-btn sc-btn-outline" style="background:#fff">
                        Learn More
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:8px"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </a>
                </div>
                <div class="sc-hero-trust">
                    <div class="sc-trust-avatars">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Student">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Student">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Student">
                    </div>
                    <div class="sc-trust-info">
                        <div class="sc-stars">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <span><strong>50K+</strong> Students Trust Us</span>
                    </div>
                </div>
            </div>

            <div class="sc-hero-visual reveal-scale">
                <img src="{{ asset('images/cta-books-graduation-cap.png') }}" alt="Graduation Cap and Books" class="sc-hero-main-img">
                
                <div class="sc-float-badge badge-1 sc-float">
                    <div class="badge-icon" style="background:#f3e8ff;color:#7c3aed"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect><polyline points="17 2 12 7 7 2"></polyline></svg></div>
                    <div class="badge-text"><strong>Live Classes</strong><span>Interactive learning</span></div>
                </div>
                <div class="sc-float-badge badge-2 sc-float" style="animation-delay: 1s">
                    <div class="badge-icon" style="background:#e0e7ff;color:#4f46e5"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                    <div class="badge-text"><strong>Mock Tests</strong><span>Practice & improve</span></div>
                </div>
                <div class="sc-float-badge badge-3 sc-float" style="animation-delay: 2s">
                    <div class="badge-icon" style="background:#fae8ff;color:#c026d3"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></div>
                    <div class="badge-text"><strong>Study Material</strong><span>PDF Notes & More</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ OUR STORY ══════════════════ --}}
    <section class="sc-section" id="our-story">
        <div class="sc-container sc-story-grid">
            <div class="sc-story-image reveal-left">
                <div class="sc-story-img-wrap">
                    <img src="{{ asset('images/hero-student-with-laptop-3d.png') }}" alt="Student studying on SarkariCourse">
                    <div class="sc-story-glow"></div>
                </div>
            </div>
            <div class="sc-story-content reveal-right">
                <span class="sc-badge-new">OUR STORY</span>
                <h2>Our Journey Started With a <span class="sc-grad-text">Simple Vision</span></h2>
                <p>SarkariCourse was founded with a mission to make quality education accessible to every aspirant, no matter where they come from. We believe that the right guidance and resources can transform lives.</p>
                <ul class="sc-features-list">
                    <li>
                        <span class="icon">✓</span>
                        Quality content created by expert educators
                    </li>
                    <li>
                        <span class="icon">✓</span>
                        Affordable courses for every student
                    </li>
                    <li>
                        <span class="icon">✓</span>
                        Regular updates and real exam experience
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- ══════════════════ MISSION / VISION ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-mv-cards" data-reveal-group>
                <div class="sc-mv-card-new">
                    <div class="sc-mv-icon-wrap">
                        <div class="icon-circle">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        </div>
                    </div>
                    <div class="sc-mv-text">
                        <h3>Our Mission</h3>
                        <p>To provide affordable, accessible and high-quality education to every aspirant and help them achieve their dream government job with confidence.</p>
                    </div>
                </div>
                <div class="sc-mv-card-new">
                    <div class="sc-mv-icon-wrap">
                        <div class="icon-circle">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </div>
                    </div>
                    <div class="sc-mv-text">
                        <h3>Our Vision</h3>
                        <p>To become India's most trusted education platform and create a nation of confident and successful government employees.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ STATS ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-stats-new" data-reveal-group>
                <div class="sc-stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                    <strong>500K+</strong>
                    <span>Happy Students</span>
                </div>
                <div class="sc-stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></div>
                    <strong>250+</strong>
                    <span>Expert Faculty</span>
                </div>
                <div class="sc-stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect><polyline points="17 2 12 7 7 2"></polyline></svg></div>
                    <strong>1500+</strong>
                    <span>Online Classes</span>
                </div>
                <div class="sc-stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                    <strong>10M+</strong>
                    <span>Tests Attempted</span>
                </div>
                <div class="sc-stat-card">
                    <div class="stat-icon"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></div>
                    <strong>98%</strong>
                    <span>Success Rate</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ JOURNEY TIMELINE ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-section-head-new reveal-up">
                <span class="sc-badge-new">OUR JOURNEY</span>
                <h2>Milestones That Define <span class="sc-grad-text">Our Journey</span></h2>
            </div>

            <div class="sc-timeline-new" data-reveal-group>
                <div class="sc-timeline-line"></div>
                <div class="sc-timeline-items">
                    <div class="sc-timeline-item-new">
                        <div class="dot"></div>
                        <strong class="year">2020+</strong>
                        <p>Founded SarkariCourse with a small team</p>
                    </div>
                    <div class="sc-timeline-item-new">
                        <div class="dot"></div>
                        <strong class="year">2021</strong>
                        <p>Launched our first batch of online courses</p>
                    </div>
                    <div class="sc-timeline-item-new">
                        <div class="dot"></div>
                        <strong class="year">2022</strong>
                        <p>Reached 100K+ students across India</p>
                    </div>
                    <div class="sc-timeline-item-new">
                        <div class="dot"></div>
                        <strong class="year">2023</strong>
                        <p>Introduced mock tests &amp; current affairs section</p>
                    </div>
                    <div class="sc-timeline-item-new">
                        <div class="dot"></div>
                        <strong class="year">2024</strong>
                        <p>Crossed 500K+ students with 98% success rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ TEAM ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-section-head-new reveal-up">
                <span class="sc-badge-new">OUR TEAM</span>
                <h2>Meet The People Behind <span class="sc-grad-text">SarkariCourse</span></h2>
            </div>

            <div class="sc-team-grid-new" data-reveal-group>
                @php
                    $team = [
                        ['name' => 'Amit Sharma',  'role' => 'Founder &amp; CEO',        'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&auto=format&fit=crop&q=80'],
                        ['name' => 'Neha Gupta',   'role' => 'Academic Head',         'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80'],
                        ['name' => 'Vikram Singh', 'role' => 'Content Head',          'img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&auto=format&fit=crop&q=80'],
                        ['name' => 'Pooja Verma',  'role' => 'Student Support Head', 'img' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&auto=format&fit=crop&q=80'],
                    ];
                @endphp
                @foreach($team as $person)
                    <div class="sc-team-card-new">
                        <div class="img-wrap">
                            <img src="{{ $person['img'] }}" alt="{{ $person['name'] }}" loading="lazy">
                        </div>
                        <div class="info">
                            <strong>{{ $person['name'] }}</strong>
                            <span>{!! $person['role'] !!}</span>
                            <div class="socials">
                                <a href="#"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                                <a href="#"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                                <a href="#"><svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ ACHIEVEMENTS ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-achievements-box reveal-up">
                <div class="sc-section-head-new" style="margin-bottom:24px">
                    <span class="sc-badge-new">OUR ACHIEVEMENTS</span>
                    <h2 style="font-size:1.6rem">Recognized For <span class="sc-grad-text">Our Commitment</span></h2>
                </div>
                <div class="sc-achieve-grid-new" data-reveal-group>
                    <div class="sc-achieve-item-new">
                        <div class="icon-wrap"><svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 15l-2 5l9-3.5L12 15z"></path><path d="M12 15l2 5l-9-3.5L12 15z"></path><circle cx="12" cy="8" r="6"></circle></svg></div>
                        <span>Best EdTech Startup<br>2023</span>
                    </div>
                    <div class="sc-achieve-item-new">
                        <div class="icon-wrap"><svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 15l-2 5l9-3.5L12 15z"></path><path d="M12 15l2 5l-9-3.5L12 15z"></path><circle cx="12" cy="8" r="6"></circle></svg></div>
                        <span>Education Excellence<br>Award 2023</span>
                    </div>
                    <div class="sc-achieve-item-new">
                        <div class="icon-wrap"><svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 15l-2 5l9-3.5L12 15z"></path><path d="M12 15l2 5l-9-3.5L12 15z"></path><circle cx="12" cy="8" r="6"></circle></svg></div>
                        <span>Most Trusted Platform<br>By Students</span>
                    </div>
                    <div class="sc-achieve-item-new">
                        <div class="icon-wrap"><svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 15l-2 5l9-3.5L12 15z"></path><path d="M12 15l2 5l-9-3.5L12 15z"></path><circle cx="12" cy="8" r="6"></circle></svg></div>
                        <span>Top Rated Platform<br>On Play Store</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ CTA ══════════════════ --}}
    <section class="sc-section" style="padding-bottom:80px">
        <div class="sc-container">
            <div class="sc-cta-box reveal-scale">
                <div class="left">
                    <h2>Ready to Achieve Your Dream Job?</h2>
                    <p>Join thousands of successful aspirants and start your journey today.</p>
                </div>
                <div class="right">
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-white-purple">
                        Explore Courses
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:8px"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </a>
                </div>
                <div class="watermark">
                    <svg viewBox="0 0 24 24" width="200" height="200" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
