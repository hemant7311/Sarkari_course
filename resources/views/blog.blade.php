@extends('layouts.first')

@section('title', 'The Prep Journal - SarkariCourse Blog')
@section('meta_description', 'Exam strategy, interview tips, current affairs and success stories for SSC, Railway, Banking, UPSC and Police exam aspirants.')

@section('content')

<main class="sc-scope sc-blog-page">

@php
  $catIcons = [
    'spotlight'        => '💡',
    'product updates'  => '🚀',
    'company'          => '🏢',
    'productivity'     => '📊',
    'strategy'         => '🎯',
    'interview'        => '🗣️',
    'current affairs'  => '📰',
  ];
  $iconFor = fn ($name) => $catIcons[strtolower($name ?? '')] ?? '🏷️';
@endphp

<!-- ══════════════ HERO ══════════════ -->
<section class="sc-blog-hero" aria-label="Blog hero">
  <div class="sc-hero-bg" aria-hidden="true">
      <span class="sc-blob sc-blob-1"></span>
      <span class="sc-blob sc-blob-2"></span>
  </div>
  <div class="sc-container sc-blog-hero-grid">
    <div class="reveal-up">
      <span class="sc-badge">Our Blog</span>
      <h1>Latest Updates, <span class="sc-grad-text">Exam Tips &amp; Insights</span></h1>
      <p class="sc-blog-hero-sub">Exam strategy, interview tips, current affairs and success stories — hand-picked for SSC, Railway, Banking, UPSC and Police aspirants.</p>
    </div>
    <div class="sc-hero-visual reveal-scale">
      <div class="sc-hero-3d" aria-hidden="true" style="background-image:url('{{ asset('images/blog/blog-hero-writing-3d.webp') }}')"></div>
    </div>
  </div>
</section>

<!-- ══════════════ TABS: Blogs / YouTube Blogs ══════════════ -->
<div class="sc-container">
  <div class="sc-blog-tabs" role="tablist">
    <button type="button" id="tabBlogs" class="sc-blog-tab active" role="tab" aria-selected="true">📄 All Blogs</button>
    <button type="button" id="tabVideos" class="sc-blog-tab" role="tab" aria-selected="false">🎬 YouTube Blog</button>
  </div>
</div>

<!-- ══════════════ SEARCH + FILTER (Blogs tab only) ══════════════ -->
<section class="sc-section" style="padding-bottom:0">
  <div class="sc-container">
    <div class="sc-section-head" style="margin-bottom:28px">
      <h2 id="sectionTitle" style="font-size:1.5rem">All Articles</h2>
      <p id="sectionSub">Apni exam preparation ke liye sabse relevant articles yahin dhoondein.</p>
    </div>

    <div id="blogToolbar" class="sc-blog-toolbar">
      <form id="searchForm" class="sc-blog-search">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" id="searchInput" placeholder="Search articles...">
      </form>

      <div class="sc-blog-filters">
        <button type="button" class="sc-filter-btn active" data-category="">📄 All Articles</button>
        @foreach($categories as $cat)
            <button type="button" class="sc-filter-btn" data-category="{{ $cat }}">{{ $iconFor($cat) }} {{ $cat }}</button>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- ══════════════ CONTENT AREA (Blogs or Videos render here) ══════════════ -->
<section class="sc-section" style="padding-top:28px">
  <div class="sc-container">

    <!-- Loading state -->
    <div id="stateLoading" class="sc-skeleton-grid" hidden aria-live="polite" aria-busy="true">
      @for ($i = 0; $i < 6; $i++)
        <div class="sc-skeleton-card">
          <div class="sc-skeleton" style="height:160px;border-radius:var(--r-lg) var(--r-lg) 0 0;"></div>
          <div style="padding:18px 20px;">
            <div class="sc-skeleton sc-skeleton-text sc-w-60"></div>
            <div class="sc-skeleton sc-skeleton-text sc-w-80"></div>
            <div class="sc-skeleton sc-skeleton-text" style="width:40%;margin-bottom:0;"></div>
          </div>
        </div>
      @endfor
    </div>

    <!-- Error state -->
    <div id="stateError" class="sc-state-box" hidden>
      <p class="sc-state-icon">⚠️</p>
      <p id="stateErrorMsg">Kuch galat ho gaya. Data load nahi ho paaya.</p>
      <button type="button" id="retryBtn" class="sc-btn sc-btn-outline">Dobara try karein</button>
    </div>

    <!-- Empty state -->
    <div id="stateEmpty" class="sc-state-box" hidden>
      <p class="sc-state-icon">🗂️</p>
      <p id="stateEmptyMsg">No Data Found</p>
    </div>

    <!-- Card grid (populated by JS) -->
    <div id="cardGrid" class="sc-blog-cardgrid" hidden></div>

  </div>
</section>

<!-- ══════════════ LOAD MORE (Blogs pagination only) ══════════════ -->
<div id="loadMoreWrap" class="sc-container sc-center-cta" hidden>
  <button type="button" id="loadMoreBtn" class="sc-btn sc-btn-outline">View More</button>
</div>

<!-- ══════════════ NEWSLETTER ══════════════ -->
<section class="sc-section">
  <div class="sc-container">
    <div class="sc-cta-band reveal-scale">
      <div class="sc-cta-text">
        <h2>Subscribe to Our Newsletter</h2>
        <p>Get the latest exam updates, preparation tips and study resources delivered to your inbox.</p>
      </div>
      <form action="{{ route('newsletter.store') }}" method="POST" class="sc-newsletter-form">
        @csrf
        <input type="email" name="email" class="sc-input" placeholder="Enter your email address" required>
        <button type="submit" class="sc-btn sc-btn-white">Subscribe</button>
      </form>
      <span class="sc-cta-decor" aria-hidden="true"><img src="{{ asset('images/hero/newsletter-subscribe-3d.webp') }}" alt=""></span>
    </div>
  </div>
</section>

<!-- ══════════════ VIDEO MODAL (plays inline on this page, never redirects to YouTube) ══════════════ -->
<div id="videoModal" class="sc-video-modal" aria-hidden="true">
  <div class="sc-video-modal-backdrop" onclick="closeVideoModal()"></div>
  <div class="sc-video-modal-dialog">
    <button type="button" class="sc-video-modal-close" onclick="closeVideoModal()" aria-label="Close video">&times;</button>
    <div class="sc-video-modal-frame">
      <iframe id="videoModalFrame" src="" title="YouTube video" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
    </div>
    <p id="videoModalTitle" class="sc-video-modal-title"></p>
  </div>
</div>

<script>
(function () {
  const API = {
    posts: "{{ route('api.blog.posts') }}",
    videos: "{{ route('api.blog.videos') }}",
  };

  const els = {
    tabBlogs: document.getElementById('tabBlogs'),
    tabVideos: document.getElementById('tabVideos'),
    toolbar: document.getElementById('blogToolbar'),
    sectionTitle: document.getElementById('sectionTitle'),
    sectionSub: document.getElementById('sectionSub'),
    searchForm: document.getElementById('searchForm'),
    searchInput: document.getElementById('searchInput'),
    filterBtns: () => document.querySelectorAll('.sc-filter-btn'),
    grid: document.getElementById('cardGrid'),
    loading: document.getElementById('stateLoading'),
    error: document.getElementById('stateError'),
    errorMsg: document.getElementById('stateErrorMsg'),
    retryBtn: document.getElementById('retryBtn'),
    empty: document.getElementById('stateEmpty'),
    emptyMsg: document.getElementById('stateEmptyMsg'),
    loadMoreWrap: document.getElementById('loadMoreWrap'),
    loadMoreBtn: document.getElementById('loadMoreBtn'),
  };

  let activeTab = 'blogs'; // 'blogs' | 'videos'
  let currentCategory = '';
  let currentSearch = '';
  let currentPage = 1;
  let requestToken = 0; // guards against out-of-order responses

  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str ?? '';
    return div.innerHTML;
  }

  function setState(state) {
    els.loading.hidden = state !== 'loading';
    els.error.hidden = state !== 'error';
    els.empty.hidden = state !== 'empty';
    els.grid.hidden = state !== 'content';
  }

  function blogCardHTML(post, isLarge) {
    return `
      <article class="card ${isLarge ? 'card--lg' : ''}">
        <div class="card__img">
          <a href="${post.url}">
            <img src="${escapeHtml(post.thumbnail)}" alt="${escapeHtml(post.title)}" loading="lazy">
          </a>
        </div>
        <div class="card__body">
          <p class="card__tag">🏷️ ${escapeHtml(post.category || 'Article')} <span class="card__dot">·</span> <span class="card__date">${escapeHtml(post.published_at || '')}</span></p>
          <h3 class="card__title"><a href="${post.url}">${escapeHtml(post.title)}</a></h3>
          <p class="card__excerpt">${escapeHtml(post.excerpt)}</p>
          <div class="card__footer"><a href="${post.url}" class="learn-more">Learn More →</a></div>
        </div>
      </article>`;
  }

  function videoCardHTML(video) {
    const safeTitle = escapeHtml(video.title).replace(/'/g, "&#39;");
    return `
      <article class="card">
        <div class="card__img card__img--video">
          <button type="button" class="video-play-btn" onclick="openVideoModal('${video.video_id}', '${safeTitle}', '${video.embed_url}')" aria-label="Play video">
            <img src="${escapeHtml(video.thumbnail)}" alt="${escapeHtml(video.title)}" loading="lazy">
            <span class="video-play-btn__icon">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
            </span>
          </button>
        </div>
        <div class="card__body">
          <p class="card__tag">🎬 Video <span class="card__dot">·</span> <span class="card__date">${escapeHtml(video.published_at || '')}</span></p>
          <h3 class="card__title">${escapeHtml(video.title)}</h3>
          <p class="card__excerpt">${escapeHtml(video.description)}</p>
          <div class="card__footer">
            <button type="button" class="learn-more" onclick="openVideoModal('${video.video_id}', '${safeTitle}', '${video.embed_url}')">Watch Video →</button>
          </div>
        </div>
      </article>`;
  }

  async function loadBlogs(page, append) {
    const myToken = ++requestToken;
    if (!append) setState('loading');
    els.loadMoreBtn.disabled = true;

    try {
      const params = new URLSearchParams({ page });
      if (currentCategory) params.set('category', currentCategory);
      if (currentSearch) params.set('search', currentSearch);

      const res = await fetch(`${API.posts}?${params.toString()}`, { headers: { 'Accept': 'application/json' } });
      if (myToken !== requestToken) return; // a newer request superseded this one
      if (!res.ok) throw new Error('HTTP ' + res.status);

      const json = await res.json();
      if (!json.success) throw new Error('API returned an error');

      if (!append) els.grid.innerHTML = '';

      if (json.data.length === 0 && !append) {
        els.emptyMsg.textContent = 'No Data Found';
        setState('empty');
        els.loadMoreWrap.hidden = true;
        return;
      }

      json.data.forEach((post, i) => {
        const isLarge = !append && i < 2;
        els.grid.insertAdjacentHTML('beforeend', blogCardHTML(post, isLarge));
      });

      setState('content');
      currentPage = json.meta.current_page;
      els.loadMoreWrap.hidden = !json.meta.has_more;
    } catch (err) {
      if (myToken !== requestToken) return;
      els.errorMsg.textContent = 'Blogs load nahi ho paaye. Internet check karke dobara try karein.';
      setState('error');
      els.loadMoreWrap.hidden = true;
    } finally {
      els.loadMoreBtn.disabled = false;
    }
  }

  async function loadVideos() {
    const myToken = ++requestToken;
    setState('loading');
    els.loadMoreWrap.hidden = true;

    try {
      const res = await fetch(API.videos, { headers: { 'Accept': 'application/json' } });
      if (myToken !== requestToken) return;
      if (!res.ok) throw new Error('HTTP ' + res.status);

      const json = await res.json();
      if (!json.success) throw new Error(json.message || 'API returned an error');

      els.grid.innerHTML = '';

      if (json.data.length === 0) {
        els.emptyMsg.textContent = 'No Data Found';
        setState('empty');
        return;
      }

      json.data.forEach(video => els.grid.insertAdjacentHTML('beforeend', videoCardHTML(video)));
      setState('content');
    } catch (err) {
      if (myToken !== requestToken) return;
      els.errorMsg.textContent = 'YouTube videos load nahi ho paaye. Thodi der baad dobara try karein.';
      setState('error');
    }
  }

  function refresh() {
    if (activeTab === 'blogs') {
      currentPage = 1;
      loadBlogs(1, false);
    } else {
      loadVideos();
    }
  }

  function switchTab(tab) {
    if (activeTab === tab) return;
    activeTab = tab;

    const isBlogs = tab === 'blogs';
    els.tabBlogs.classList.toggle('active', isBlogs);
    els.tabVideos.classList.toggle('active', !isBlogs);
    els.tabBlogs.setAttribute('aria-selected', String(isBlogs));
    els.tabVideos.setAttribute('aria-selected', String(!isBlogs));

    els.toolbar.hidden = !isBlogs;
    els.sectionTitle.textContent = isBlogs ? 'All Articles' : 'YouTube Videos';
    els.sectionSub.textContent = isBlogs
      ? 'Apni exam preparation ke liye sabse relevant articles yahin dhoondein.'
      : 'Hamare YouTube channel ke latest videos — seedhe is page par dekhein.';

    refresh();
  }

  // ── Event wiring ──────────────────────────────────────────
  els.tabBlogs.addEventListener('click', () => switchTab('blogs'));
  els.tabVideos.addEventListener('click', () => switchTab('videos'));
  els.retryBtn.addEventListener('click', refresh);
  els.loadMoreBtn.addEventListener('click', () => loadBlogs(currentPage + 1, true));

  els.searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    currentSearch = els.searchInput.value.trim();
    currentPage = 1;
    loadBlogs(1, false);
  });

  els.filterBtns().forEach(btn => {
    btn.addEventListener('click', function () {
      els.filterBtns().forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      currentCategory = this.dataset.category || '';
      currentPage = 1;
      loadBlogs(1, false);
    });
  });

  // ── Initial load ──────────────────────────────────────────
  loadBlogs(1, false);

  // ── Video modal (global so inline onclick handlers can reach it) ──
  window.openVideoModal = function (videoId, title, embedUrl) {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoModalFrame');
    const titleEl = document.getElementById('videoModalTitle');
    frame.src = embedUrl || ('https://www.youtube-nocookie.com/embed/' + videoId + '?autoplay=1&rel=0');
    titleEl.textContent = title || '';
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  window.closeVideoModal = function () {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoModalFrame');
    frame.src = '';
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') window.closeVideoModal();
  });
})();
</script>

@endsection