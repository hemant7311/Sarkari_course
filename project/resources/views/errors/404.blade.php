@extends('layouts.first')

@section('title', 'Page Not Found - SarkariCourse')
@section('meta_description', "The page you're looking for doesn't exist or has been moved.")

@section('content')
<main class="sc-scope sc-error-page">
    <div class="sc-container">
        <div class="sc-error-panel reveal-scale">
            <img src="{{ asset('images/errors/404-illustration-3d.webp') }}" alt="Confused robot mascot beside a signpost pointing two directions, representing a page that could not be found" class="sc-error-illustration" width="380" height="290" loading="eager">

            <h1 class="sc-visually-hidden">404 - Page Not Found</h1>
            <h2>Oops! Page Not Found</h2>
            <p>The page you're looking for doesn't exist or has been moved. Let's get you back on track!</p>

            <div class="sc-error-actions">
                <a href="{{ route('home') }}" class="sc-btn sc-btn-primary">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
                    Go to Homepage
                </a>
                <button type="button" onclick="history.back()" class="sc-btn sc-btn-outline">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Go Back
                </button>
            </div>
        </div>
    </div>
</main>
@endsection
