
<footer class="footer sc-scope">
  <div class="footer-container">

    <!-- ── Main grid ── -->
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-column footer-column-brand">
        <a href="/" class="footer-logo">
          <div class="footer-logo-icon">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none">
              <path d="M12 3l9 4.5-9 4.5-9-4.5L12 3z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/>
              <path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="footer-logo-text">Sarkari<em>Course</em></span>
        </a>
        <p class="footer-tagline">{{ $settings->footer_text ?? "India's most trusted free platform for government exam preparation. Quality education for every aspirant." }}</p>

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
          <li><a href="/about">Contact Us</a></li>
          <li><a href="/courses">All Courses</a></li>
          <li><a href="/privacy-policy">Privacy Policy</a></li>
          <li><a href="/terms-and-conditions">Terms of Service</a></li>
          <li><a href="/refund-policy">Refund Policy</a></li>
        </ul>
      </div>

      <!-- Exams -->
      <div class="footer-column">
        <p class="footer-col-title">Exams</p>
        <ul class="footer-links-list">
          <li><a href="/courses">SSC</a></li>
          <li><a href="/courses">Railway</a></li>
          <li><a href="/courses">Banking</a></li>
          <li><a href="/courses">UPSC</a></li>
          <li><a href="/courses">State PSC</a></li>
          <li><a href="/courses">Police</a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div class="footer-column">
        <p class="footer-col-title">Resources</p>
        <ul class="footer-links-list">
          <li><a href="/services">Hack Tests</a></li>
          <li><a href="/about">Study Materials</a></li>
          <li><a href="/blog">Current Affairs</a></li>
          <li><a href="/blog">Previous Papers</a></li>
          <li><a href="/about">Success Stories</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="footer-column">
        <p class="footer-col-title">Newsletter</p>
        <p class="footer-newsletter-desc">Subscribe to get updates about new courses and exam notifications.</p>
        <form action="{{ route('newsletter.store') }}" method="POST" class="footer-newsletter-form">
          @csrf
          <input type="email" name="email" placeholder="Enter your email" required />
          <button type="submit">Subscribe</button>
        </form>
        @if(session('newsletter_status'))
          <div style="color:#4ade80; font-size:.8rem; margin-top:8px;">{{ session('newsletter_status') }}</div>
        @endif
      </div>

    </div>

    <!-- ── Bottom bar ── -->
    <div class="footer-bottom">
      <p class="footer-copy">© {{ date('Y') }} <strong>{{ $settings->site_name ?? 'SarkariCourse' }}</strong>. All Rights Reserved.</p>
      <div class="footer-bottom-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms of Service</a>
      </div>
    </div>

  </div>
</footer>