@extends('layouts.first')

@section('title', 'Our Services - SarkariCourse')
@section('meta_description', 'Explore SarkariCourse services: live classes, structured notes, mock test series and mentorship for SSC, Railway, Banking, UPSC and Police exams.')

@section('content')
<main class="sc-scope sc-services">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-services-hero" aria-label="Services hero">
        <div class="sc-hero-bg" aria-hidden="true">
            <span class="sc-blob sc-blob-1"></span>
            <span class="sc-blob sc-blob-2"></span>
        </div>
        <div class="sc-container sc-services-hero-grid">
            <div class="reveal-up">
                <nav class="sc-breadcrumb"><a href="{{ route('home') }}">Home</a> <span>›</span> <span>Services</span></nav>
                <h1>Our Services <span class="sc-grad-text">Designed For Your Success</span></h1>
                <p class="sc-services-hero-sub">We provide everything you need to crack government exams and build a secure future. Quality content, expert guidance and the right practice — all in one place.</p>
                <div class="sc-hero-actions">
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">Explore Courses</a>
                    <a href="{{ route('contact') }}" class="sc-btn sc-btn-outline">Talk to an Expert</a>
                </div>
            </div>
            <div class="sc-hero-visual reveal-scale">
                <div class="sc-hero-3d" data-three-hero aria-hidden="true" style="background-image:url('{{ asset('images/hero/services-hero-mobile-learning-3d.webp') }}')"></div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ SERVICE GRID ══════════════════ --}}
    <section class="sc-section" aria-labelledby="offer-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">What We Offer</span>
                <h2 id="offer-heading">Everything You Need to <span class="sc-accent">Achieve Your Goal</span></h2>
                <p>Our services are specially designed to provide complete support at every step of your preparation journey.</p>
            </div>

            <div class="sc-service-grid" data-reveal-group>
                @php
                    $services = [
                        ['icon' => '🎓', 'title' => 'Live Classes', 'text' => 'Interactive live classes by expert faculty with doubt clearing sessions.'],
                        ['icon' => '📝', 'title' => 'Mock Tests', 'text' => 'Chapter-wise, full-length and previous year mock tests with detailed analysis.'],
                        ['icon' => '📖', 'title' => 'Study Material', 'text' => 'High-quality notes, ebooks and PDFs prepared by subject experts.'],
                        ['icon' => '📰', 'title' => 'Current Affairs', 'text' => 'Daily current affairs, monthly PDFs and important news for all exams.'],
                        ['icon' => '🎯', 'title' => 'Test Series', 'text' => 'Topic-wise and full syllabus test series to boost your exam readiness.'],
                        ['icon' => '💬', 'title' => 'Doubt Support', 'text' => 'Quick doubt resolution by experts through chat and live sessions.'],
                        ['icon' => '🧭', 'title' => 'Career Guidance', 'text' => 'Personalized career guidance to help you choose the right path.'],
                        ['icon' => '💼', 'title' => 'Interview Preparation', 'text' => 'Mock interviews, expert tips and guidance to crack the final selection.'],
                        ['icon' => '🎖️', 'title' => 'Certification', 'text' => 'Get digital certificates for completed courses to boost your profile.'],
                        ['icon' => '📱', 'title' => 'Mobile App Access', 'text' => 'Learn on the go with our feature-rich mobile application.'],
                        ['icon' => '🔔', 'title' => 'Exam Notifications', 'text' => 'Timely updates on exam notifications, dates and important alerts.'],
                        ['icon' => '🤝', 'title' => 'Community Support', 'text' => 'Join a community of aspirants and grow together with motivation.'],
                    ];
                @endphp
                @foreach($services as $s)
                    <div class="sc-service-card sc-card">
                        <span class="sc-service-icon">{{ $s['icon'] }}</span>
                        <h3>{{ $s['title'] }}</h3>
                        <p>{{ $s['text'] }}</p>
                        <a href="{{ route('courses') }}" class="sc-service-link">Learn More →</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ MID CTA ══════════════════ --}}
    <section class="sc-container">
        <div class="sc-cta-band reveal-scale">
            <div class="sc-cta-text">
                <h2>Need Help Choosing the Right Service?</h2>
                <p>Our experts are here to guide you at every step of your preparation.</p>
            </div>
            <div class="sc-cta-actions">
                <a href="{{ route('contact') }}" class="sc-btn sc-btn-white">Talk to Our Expert</a>
            </div>
            <span class="sc-cta-decor" aria-hidden="true"><img src="{{ asset('images/hero/cta-books-graduation-cap-3d.webp') }}" alt=""></span>
        </div>
    </section>

    {{-- ══════════════════ TRUST STRIP ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-label="Why trust our services">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <h2>Why Aspirants Trust <span class="sc-accent">Our Services</span></h2>
            </div>
            <div class="sc-trust-grid" data-reveal-group>
                <div class="sc-trust-item"><span>👨‍🏫</span><strong>Expert Faculty</strong><p>Learn from experienced educators and toppers.</p></div>
                <div class="sc-trust-item"><span>📚</span><strong>Quality Content</strong><p>Well researched and exam-oriented content.</p></div>
                <div class="sc-trust-item"><span>💰</span><strong>Affordable Pricing</strong><p>Best services at pocket friendly prices.</p></div>
                <div class="sc-trust-item"><span>🏆</span><strong>Proven Results</strong><p>Thousands of selections across exams every year.</p></div>
            </div>
        </div>
    </section>

</main>
@endsection
