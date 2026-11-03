@extends('layouts.first')

@section('title', 'Something Went Wrong - SarkariCourse')
@section('meta_description', "We're facing some technical difficulties. Our team has been notified.")

@section('content')
<main class="sc-scope sc-error-page">
    <div class="sc-container">
        <div class="sc-error-panel reveal-scale">
            <img src="{{ asset('images/errors/500-illustration-3d.webp') }}" alt="Sad robot mascot holding disconnected plugs beside a server warning icon, representing an internal server error" class="sc-error-illustration" width="380" height="290" loading="eager">

            <h1 class="sc-visually-hidden">500 - Internal Server Error</h1>
            <h2>Internal Server Error</h2>
            <p>Something went wrong on our end. Our team has been notified and is working to fix the issue. Please try again shortly.</p>

            <div class="sc-error-actions">
                <a href="{{ route('home') }}" class="sc-btn sc-btn-primary">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
                    Go to Homepage
                </a>
                <button type="button" onclick="location.reload()" class="sc-btn sc-btn-outline">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                    Try Again
                </button>
            </div>

            <div class="sc-error-help">
                <span>Need Help?</span>
                <p>If the problem persists, our support team is here to help.</p>
                <a href="{{ route('contact') }}" class="sc-btn sc-btn-outline sc-btn-sm">Contact Support</a>
            </div>
        </div>
    </div>
</main>
@endsection
