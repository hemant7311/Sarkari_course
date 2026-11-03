@extends('layouts.first')

@section('title', $blog->meta_title ?: $blog->title.' - SarkariCourse Blog')
@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->excerpt ?: $blog->content), 155))
@section('og_image', $blog->thumbnail_url ?: asset('images/og-default.jpg'))

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BlogPosting",
    "headline": {{ Js::from($blog->title) }},
    "datePublished": "{{ optional($blog->published_at)->toIso8601String() }}",
    "author": { "@@type": "Person", "name": {{ Js::from(optional($blog->author)->name ?? 'SarkariCourse Team') }} }
}
</script>
@endpush

@section('content')
<main class="sc-scope sc-blogpost">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-blogpost-hero">
        <div class="sc-container">
            <nav class="sc-breadcrumb reveal-up">
                <a href="{{ route('home') }}">Home</a> <span>›</span>
                <a href="{{ route('blog') }}">Blog</a> <span>›</span>
                <span>{{ Str::limit($blog->title, 40) }}</span>
            </nav>

            <div class="sc-blogpost-meta-top reveal-up">
                @if($blog->category)<span class="sc-blogpost-cat">{{ $blog->category }}</span>@endif
                <span class="sc-blogpost-date">{{ optional($blog->published_at)->format('d M Y') }}</span>
                <span class="sc-blogpost-readtime">{{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read</span>
            </div>

            <h1 class="reveal-up">{{ $blog->title }}</h1>

            <div class="sc-blogpost-author reveal-up">
                <span class="sc-avatar-dot">{{ strtoupper(substr(optional($blog->author)->name ?? 'S', 0, 1)) }}</span>
                <div><strong>{{ optional($blog->author)->name ?? 'SarkariCourse Team' }}</strong><span>Author</span></div>
            </div>
        </div>

        @if($blog->thumbnail_url)
        <div class="sc-container">
            <div class="sc-blogpost-featured reveal-scale" style="background-image:url('{{ $blog->thumbnail_url }}')"></div>
        </div>
        @endif
    </section>

    {{-- ══════════════════ CONTENT + SHARE ══════════════════ --}}
    <section class="sc-section">
        <div class="sc-container sc-blogpost-grid">

            <div class="sc-blogpost-content reveal-up">
                {!! $blog->content !!}
            </div>

            <aside class="sc-blogpost-share reveal-right">
                <span class="sc-share-label">Share</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="sc-share-btn" aria-label="Share on Facebook">f</a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="sc-share-btn" aria-label="Share on Twitter">𝕏</a>
                <a href="https://wa.me/?text={{ urlencode($blog->title.' '.url()->current()) }}" target="_blank" rel="noopener" class="sc-share-btn" aria-label="Share on WhatsApp">W</a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="sc-share-btn" aria-label="Share on LinkedIn">in</a>
            </aside>
        </div>
    </section>

    {{-- ══════════════════ RELATED BLOGS ══════════════════ --}}
    @if($related->count())
    <section class="sc-section sc-section-alt" aria-labelledby="related-blog-heading">
        <div class="sc-container">
            <div class="sc-section-head reveal-up">
                <span class="sc-badge">Keep Reading</span>
                <h2 id="related-blog-heading">Related <span class="sc-accent">Articles</span></h2>
            </div>
            <div class="sc-blog-grid" data-reveal-group>
                @foreach($related as $post)
                    <a href="{{ route('blog.show', $post) }}" class="sc-blog-card sc-card">
                        <div class="sc-blog-thumb" @if($post->thumbnail_url) style="background-image:url('{{ $post->thumbnail_url }}')" @endif></div>
                        <div class="sc-blog-body">
                            <span class="sc-blog-cat">{{ $post->category }}</span>
                            <h3>{{ Str::limit($post->title, 62) }}</h3>
                            <span class="sc-blog-date">{{ optional($post->published_at)->format('d M Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</main>
@endsection
