
<footer class="footer sc-scope">
  <div class="footer-container">

    <!-- ── Newsletter strip ── -->
    <div class="footer-top">
      <div class="footer-top-left">
        <span class="footer-top-label">Stay Updated</span>
        <p class="footer-top-headline">Free exam alerts & <span>study resources</span></p>
      </div>
      <form action="{{ route('newsletter.store') }}" method="POST" class="footer-newsletter">
        @csrf
        <input type="email" name="email" placeholder="Enter your email address" required />
        <button type="submit">Subscribe →</button>
      </form>
      @if(session('newsletter_status'))
        <div style="color:#4ade80; font-size:.8rem; margin-top:6px;">{{ session('newsletter_status') }}</div>
      @endif
    </div>

    <!-- ── Main grid ── -->
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-column">
        <a href="/" class="footer-logo">
          <div class="footer-logo-icon">🎯</div>
          <span class="footer-logo-text">{{ $settings->site_name ?? 'SarkariCourse' }}</span>
        </a>
        <p class="footer-tagline">{{ $settings->footer_text ?? "India's trusted platform for SSC, Railway, Banking, UPSC, Police and Defence exam preparation." }}</p>

        <div class="footer-stats">
          <div class="footer-stat">
            <span class="footer-stat-num">5L+</span>
            <span class="footer-stat-label">Students</span>
          </div>
          <div class="stat-divider"></div>
          <div class="footer-stat">
            <span class="footer-stat-num">200+</span>
            <span class="footer-stat-label">Courses</span>
          </div>
          <div class="stat-divider"></div>
          <div class="footer-stat">
            <span class="footer-stat-num">98%</span>
            <span class="footer-stat-label">Pass Rate</span>
          </div>
        </div>

        <div class="footer-socials">
          <!-- Facebook -->
          <a href="{{ $settings->facebook ?? '#' }}" target="_blank" class="social-btn" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <!-- Instagram -->
          <a href="{{ $settings->instagram ?? '#' }}" target="_blank" class="social-btn" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" style="stroke:#0b1120;stroke-width:2"/></svg>
          </a>
          <!-- YouTube -->
          <a href="{{ $settings->youtube ?? '#' }}" target="_blank" class="social-btn" aria-label="YouTube">
            <svg viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" style="fill:#0b1120"/></svg>
          </a>
          <!-- LinkedIn -->
          <a href="#" class="social-btn" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <!-- Telegram -->
          <a href="#" class="social-btn" aria-label="Telegram">
            <svg viewBox="0 0 24 24"><path d="M21.8 2.2L1.2 10.3c-1.3.5-1.3 1.3-.2 1.6l5.1 1.6 2 6c.3.8.6 1.1 1.1 1.1.5 0 .7-.2 1-.5l2.5-2.4 5.2 3.8c1 .5 1.7.3 1.9-.9l3.4-16c.3-1.4-.5-2-1.4-1.6z"/></svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer-column">
        <p class="footer-col-title">Quick Links</p>
        <ul class="footer-links-list">
          <li><a href="/">Home</a></li>
          <li><a href="/about">About Us</a></li>
          <li><a href="/courses">All Courses</a></li>
          <li><a href="/services">Services</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </div>

      <!-- Exam Categories -->
      <div class="footer-column">
        <p class="footer-col-title">Exam Categories</p>
        <ul class="footer-links-list">
          @forelse($footerCategories as $cat)
            <li><a href="{{ route('courses', ['category' => $cat->name]) }}">{{ $cat->name }}</a></li>
          @empty
            <li><a href="{{ route('courses') }}">All Courses</a></li>
          @endforelse
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-column">
        <p class="footer-col-title">Contact Info</p>
        <ul class="contact-items">
          <li class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="contact-text">
              <span class="contact-label">Address</span>
              <span class="contact-value">{{ $settings->address ?? 'Agra, Uttar Pradesh, India' }}</span>
            </div>
          </li>
          <li class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.52 2 2 0 0 1 3.59 1.34h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.9a16 16 0 0 0 6.09 6.09l.92-.92a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.73 16.92z"/></svg>
            </div>
            <div class="contact-text">
              <span class="contact-label">Phone</span>
              <span class="contact-value">{{ $settings->phone ?? '+91 9876543210' }}</span>
            </div>
          </li>
          <li class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="contact-text">
              <span class="contact-label">Email</span>
              <span class="contact-value">{{ $settings->email ?? 'support@sarkaricourse.com' }}</span>
            </div>
          </li>
          <li class="contact-item">
            <div class="contact-icon">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="contact-text">
              <span class="contact-label">Support Hours</span>
              <span class="contact-value">Mon–Sat, 9 AM – 7 PM</span>
            </div>
          </li>
        </ul>
      </div>

    </div>

    <!-- ── Bottom bar ── -->
    <div class="footer-bottom">
      <p class="footer-copy">© {{ date('Y') }} <strong>{{ $settings->site_name ?? 'SarkariCourse' }}</strong>. All Rights Reserved.</p>
      <div class="footer-badge">
        <span class="badge-dot"></span>
        All systems operational
      </div>
      <div class="footer-bottom-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms &amp; Conditions</a>
        <a href="{{ route('refund') }}">Refund Policy</a>
      </div>
    </div>

  </div>
</footer>