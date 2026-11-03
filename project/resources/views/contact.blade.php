@extends('layouts.first')

@section('title', 'Contact Us - SarkariCourse')
@section('meta_description', "Have a question or need guidance? Get in touch with SarkariCourse's support team — we reply within 24 hours.")

@section('content')
<main class="sc-scope sc-contact">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-contact-hero" aria-label="Contact hero">
        <div class="sc-hero-bg" aria-hidden="true">
            <span class="sc-blob sc-blob-1"></span>
            <span class="sc-blob sc-blob-2"></span>
        </div>
        <div class="sc-container sc-contact-hero-grid">
            <div class="reveal-up">
                <span class="sc-badge">Contact</span>
                <h1>We're Here to <span class="sc-grad-text">Help You!</span></h1>
                <p class="sc-contact-hero-sub">Have a question or need guidance? Our team is ready to assist you. Reach out to us anytime.</p>

                <div class="sc-contact-badges" data-reveal-group>
                    <div class="sc-mini-badge"><span>🎧</span><div><strong>Quick Support</strong><span>We reply within 24 hrs</span></div></div>
                    <div class="sc-mini-badge"><span>🛡️</span><div><strong>Trusted by Students</strong><span>Support you can rely on</span></div></div>
                    <div class="sc-mini-badge"><span>🎯</span><div><strong>Student First</strong><span>Your success is our goal</span></div></div>
                </div>
            </div>
            <div class="sc-hero-visual reveal-scale">
                <div class="sc-hero-3d" data-three-hero aria-hidden="true" style="background-image:url('{{ asset('images/contact/contact-support-3d.webp') }}')"></div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ FORM + INFO ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container sc-contact-grid">

            <div class="sc-contact-form-card sc-card reveal-left">
                <h2>Send Us a Message</h2>
                <p class="sc-form-sub">Fill out the form below and our team will get back to you.</p>

                @if(session('status'))
                    <div class="sc-alert sc-alert-success">{{ session('status') }}</div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="sc-contact-form">
                    @csrf
                    <div class="sc-form-row">
                        <div>
                            <label class="sc-label" for="name">Your Name</label>
                            <input type="text" id="name" name="name" class="sc-input" value="{{ old('name') }}" required>
                            @error('name') <span class="sc-field-error">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="sc-label" for="email">Your Email</label>
                            <input type="email" id="email" name="email" class="sc-input" value="{{ old('email') }}" required>
                            @error('email') <span class="sc-field-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sc-form-row">
                        <div>
                            <label class="sc-label" for="mobile">Phone Number</label>
                            <input type="text" id="mobile" name="mobile" class="sc-input" value="{{ old('mobile') }}">
                        </div>
                        <div>
                            <label class="sc-label" for="course">Course / Subject</label>
                            <input type="text" id="course" name="course" class="sc-input" value="{{ old('course') }}" placeholder="e.g. SSC CGL 2024">
                        </div>
                    </div>
                    <div>
                        <label class="sc-label" for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" class="sc-textarea" required>{{ old('message') }}</textarea>
                        @error('message') <span class="sc-field-error">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="sc-btn sc-btn-primary sc-form-submit">
                        Send Message
                        <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                </form>
            </div>

            <div class="sc-contact-info reveal-right">
                <h3>Get in Touch</h3>
                <div class="sc-info-list">
                    <div class="sc-info-item">
                        <span class="sc-info-icon">📞</span>
                        <div><strong>Phone Number</strong><span>{{ $settings->phone ?? '+91 12345 67890' }}</span><small>Mon - Sat (10:00 AM - 6:00 PM)</small></div>
                    </div>
                    <div class="sc-info-item">
                        <span class="sc-info-icon">✉️</span>
                        <div><strong>Email Address</strong><span>{{ $settings->email ?? 'support@sarkaricourse.com' }}</span><small>We reply within 24 hours</small></div>
                    </div>
                    <div class="sc-info-item">
                        <span class="sc-info-icon">💬</span>
                        <div><strong>WhatsApp Support</strong><span>{{ $settings->phone ?? '+91 12345 67890' }}</span><small>Chat with us on WhatsApp</small></div>
                    </div>
                    <div class="sc-info-item">
                        <span class="sc-info-icon">📍</span>
                        <div><strong>Office Address</strong><span>{{ $settings->address ?? '123, Education Street, New Delhi - 110001' }}</span></div>
                    </div>
                    <div class="sc-info-item">
                        <span class="sc-info-icon">🕒</span>
                        <div><strong>Working Hours</strong><span>Mon - Sat: 10:00 AM - 6:00 PM</span><small>Sunday: Closed</small></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════ FAQ ══════════════════ --}}
    <section class="sc-section sc-section-alt" aria-labelledby="faq-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">FAQ</span>
                <h2 id="faq-heading">Frequently Asked <span class="sc-accent">Questions</span></h2>
                <p>Have questions? We have answers.</p>
            </div>

            <div class="sc-faq-grid" data-reveal-group>
                @php
                    $faqs = [
                        ['q' => 'How can I enroll in a course?', 'a' => 'Simply sign up for a free account, browse our course catalog, and click "Enroll Now" on any course you want to start.'],
                        ['q' => 'What payment methods do you accept?', 'a' => 'All courses on SarkariCourse are currently 100% free — no payment is required to enroll.'],
                        ['q' => 'How can I access my purchased courses?', 'a' => 'Log in and visit your Dashboard — all your enrolled courses appear under "My Courses".'],
                        ['q' => 'Do you provide certificates?', 'a' => 'Yes, digital certificates are available for select completed courses from your dashboard.'],
                        ['q' => 'Can I get a refund if I\'m not satisfied?', 'a' => 'Since all courses are free, our Refund Policy does not currently apply — see the Refund Policy page for details.'],
                        ['q' => 'How can I contact support?', 'a' => 'Use the form above, email us, or reach out on WhatsApp — our team replies within 24 hours.'],
                    ];
                @endphp
                @foreach($faqs as $i => $faq)
                    <details class="sc-faq-item" @if($i === 0) open @endif>
                        <summary>{{ $faq['q'] }}<span class="sc-faq-toggle">+</span></summary>
                        <p>{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════ CTA ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container">
            <div class="sc-cta-band reveal-scale">
                <div class="sc-cta-text">
                    <h2>Still Have Questions?</h2>
                    <p>Our support team is available to help you.</p>
                </div>
                <div class="sc-cta-actions">
                    <a href="mailto:{{ $settings->email ?? 'support@sarkaricourse.com' }}" class="sc-btn sc-btn-white">Email Us</a>
                </div>
                <span class="sc-cta-decor" aria-hidden="true">💬</span>
            </div>
        </div>
    </section>

</main>
@endsection
