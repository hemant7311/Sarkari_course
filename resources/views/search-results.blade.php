@extends('layouts.first')

@section('title', ($q !== '' ? 'Search results for "'.$q.'"' : 'Search').' - SarkariCourse')
@section('meta_description', 'Search SarkariCourse for free SSC, Railway, Banking, UPSC and Police exam courses, mock tests and articles.')

@section('content')
<main class="sc-scope sc-search-results">

    <section class="sc-search-results-hero">
        <div class="sc-container">
            <h1 class="sc-visually-hidden">{{ $q !== '' ? 'Search results for "'.$q.'"' : 'Search SarkariCourse' }}</h1>
            <form action="{{ route('search') }}" method="GET" class="sc-search-results-bar reveal-up">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" name="q" value="{{ $q }}" placeholder="Search courses, exams, topics…" autofocus>
                <button type="submit" class="sc-btn sc-btn-primary">Search</button>
            </form>

            @if($q !== '')
                <p class="sc-search-results-count reveal-up">
                    {{ $courseResults->count() + $blogResults->count() }} result{{ ($courseResults->count() + $blogResults->count()) === 1 ? '' : 's' }} for "<strong>{{ $q }}</strong>"
                </p>
            @endif
        </div>
    </section>

    @if($q === '')
        {{-- No query yet: show popular suggestions --}}
        <section class="sc-section" style="padding-top:0">
            <div class="sc-container">
                <div class="sc-section-head reveal-up" style="margin-bottom:20px">
                    <span class="sc-badge">Popular Searches</span>
                </div>
                <div class="sc-course-chips reveal-up">
                    @foreach(['SSC CGL', 'Railway NTPC', 'UPSC Prelims', 'Banking PO', 'Current Affairs', 'CTET'] as $term)
                        <a href="{{ route('search', ['q' => $term]) }}" class="sc-chip">{{ $term }}</a>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif($courseResults->isEmpty() && $blogResults->isEmpty())
        {{-- No results --}}
        <section class="sc-section">
            <div class="sc-container">
                <div class="sc-empty-panel reveal-scale">
                    <img src="{{ asset('images/search/search-empty-3d.webp') }}" alt="No search results found illustration" width="220" height="180" loading="lazy" style="display:block;margin:0 auto 14px;">
                    <h2>No results for "{{ $q }}"</h2>
                    <p>Try a different keyword, or browse our full course catalog instead.</p>
                    <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">Browse All Courses</a>
                </div>
            </div>
        </section>
    @else
        @if($courseResults->count())
        <section class="sc-section" style="padding-top:0">
            <div class="sc-container">
                <div class="sc-section-head reveal-up" style="margin-bottom:20px;text-align:left;max-width:none;">
                    <h2 style="font-size:1.3rem">Courses ({{ $courseResults->count() }})</h2>
                </div>
                <div class="sc-course-grid-full" data-reveal-group>
                    @foreach($courseResults as $course)
                        <a href="{{ route('course_details', $course) }}" class="sc-course-card sc-card">
                            <div class="sc-course-thumb" style="@if($course->thumbnail_url) background-image:url('{{ $course->thumbnail_url }}'); @endif">
                                <span class="sc-course-badge">Free</span>
                            </div>
                            <div class="sc-course-body">
                                <span class="sc-course-cat">{{ $course->category }}</span>
                                <h3>{{ $course->title }}</h3>
                                <div class="sc-course-meta">
                                    <span>👤 {{ $course->teacher_name }}</span>
                                    <span>{{ ucfirst($course->level) }}</span>
                                </div>
                                <span class="sc-course-link">View Details →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        @if($blogResults->count())
        <section class="sc-section sc-section-alt">
            <div class="sc-container">
                <div class="sc-section-head reveal-up" style="margin-bottom:20px;text-align:left;max-width:none;">
                    <h2 style="font-size:1.3rem">Articles ({{ $blogResults->count() }})</h2>
                </div>
                <div class="sc-blog-grid" data-reveal-group>
                    @foreach($blogResults as $post)
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
    @endif

</main>
@endsection
