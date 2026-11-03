@extends('layouts.user')

@section('title', 'My Wishlist')

@section('content')

<div class="sc-dash-banner reveal-up">
    <div>
        <h1>My Wishlist</h1>
        <p>Your saved courses will appear here. Start learning and achieve your goals.</p>
    </div>
    <div class="sc-wishlist-total">
        <span class="sc-avatar-dot">♡</span>
        <div><strong>Total Saved</strong><span class="sc-num">{{ $wishlistCourses->count() }}</span></div>
    </div>
</div>

@if($wishlistCourses->count())
    <div class="sc-wishlist-grid" data-reveal-group>
        @foreach($wishlistCourses as $course)
            <div class="sc-wishlist-card sc-card">
                <button type="button" class="sc-wishlist-remove" aria-label="Remove from wishlist" title="Wishlist removal requires the upcoming saved-items backend">♡</button>
                <a href="{{ route('course_details', $course) }}" class="sc-course-thumb" style="@if($course->thumbnail_url) background-image:url('{{ $course->thumbnail_url }}'); @endif">
                    <span class="sc-course-badge">Free</span>
                </a>
                <div class="sc-course-body">
                    <span class="sc-course-cat">{{ $course->category }}</span>
                    <h3><a href="{{ route('course_details', $course) }}">{{ $course->title }}</a></h3>
                    <p class="sc-wishlist-desc">{{ Str::limit(strip_tags($course->description), 80) }}</p>
                    <a href="{{ route('course_details', $course) }}" class="sc-btn sc-btn-primary sc-btn-sm" style="width:100%">View Details</a>
                </div>
            </div>
        @endforeach
    </div>

    <p class="sc-wishlist-note">Showing your recently added courses. Full save/remove persistence is on our roadmap.</p>
@else
    <div class="sc-empty-illustration reveal-scale">
        <img src="{{ asset('images/wishlist/wishlist-empty-3d.webp') }}" alt="Empty heart-shaped wishlist illustration" width="220" height="180" loading="lazy">
        <h2>Your wishlist is empty</h2>
        <p>Save courses you're interested in and find them here anytime.</p>
        <a href="{{ route('courses') }}" class="sc-btn sc-btn-primary">Browse Courses</a>
    </div>
@endif

@endsection
