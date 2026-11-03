@extends('layouts.first')

@section('title', $title.' - SarkariCourse')
@section('meta_description', $title.' for SarkariCourse - India\'s free SSC, Railway, Banking, UPSC and Police exam preparation platform.')

@section('content')

{{-- Parse the plain-text $content (passed by the route) into an intro
     and numbered points — purely a display-layer transform, no backend
     or route changes. Handles both numbered (Privacy/Terms) and plain
     paragraph (Refund) formats gracefully. --}}
@php
    $lines = collect(explode("\n", $content))->map(fn ($l) => trim($l))->filter()->values();
    $introParas = [];
    $points = [];
    foreach ($lines as $line) {
        if (preg_match('/^(\d+)\.\s*(.+)$/', $line, $m)) {
            $shortTitle = preg_split('/[.,]/', $m[2], 2)[0];
            $points[] = ['num' => $m[1], 'title' => \Illuminate\Support\Str::limit($shortTitle, 46), 'body' => $m[2]];
        } else {
            $introParas[] = $line;
        }
    }
    $icons = ['🛡️', '📋', '🔒', '💳', '⚙️', '📞', '👤', '🔐', '📜', '✅'];
    $pageIcon = match(true) {
        str_contains($title, 'Refund') => '💰',
        str_contains($title, 'Terms') => '📋',
        default => '🔒',
    };
@endphp

<main class="sc-scope sc-legal">

    {{-- ══════════════════ HERO ══════════════════ --}}
    <section class="sc-legal-hero" aria-label="{{ $title }} hero">
        <div class="sc-container">
            <nav class="sc-breadcrumb reveal-up" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a> <span>›</span> <span>Policies</span> <span>›</span> <span>{{ $title }}</span>
            </nav>
            <div class="sc-legal-hero-inner reveal-up">
                <div>
                    <h1>{{ $title }}</h1>
                    <p>Last Updated: {{ now()->format('d M Y') }}</p>
                </div>
                <span class="sc-legal-hero-icon">{{ $pageIcon }}</span>
            </div>
        </div>
    </section>

    <div class="sc-container sc-legal-layout">

        {{-- ── Sidebar: On this page ── --}}
        @if(count($points))
        <aside class="sc-legal-nav reveal-left">
            <div class="sc-legal-nav-card">
                <h2>On This Page</h2>
                <ol>
                    @foreach($points as $p)
                        <li><a href="#point-{{ $p['num'] }}">{{ $p['title'] }}</a></li>
                    @endforeach
                </ol>
            </div>
            <div class="sc-legal-help-card">
                <strong>Need Help?</strong>
                <p>If you have any questions regarding this policy, feel free to reach out to our support team.</p>
                <a href="{{ route('contact') }}" class="sc-btn sc-btn-primary sc-btn-sm">Contact Support</a>
            </div>
        </aside>
        @endif

        {{-- ── Content ── --}}
        <div class="sc-legal-content">
            @if(count($introParas))
                <div class="sc-legal-intro reveal-up">
                    @foreach($introParas as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>
            @endif

            @if(count($points))
                <div data-reveal-group>
                    @foreach($points as $i => $p)
                        <div class="sc-legal-point" id="point-{{ $p['num'] }}">
                            <span class="sc-legal-point-icon">{{ $icons[$i % count($icons)] }}</span>
                            <div>
                                <h3>{{ $p['num'] }}. {{ $p['title'] }}</h3>
                                <p>{{ $p['body'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(!count($points))
                <div class="sc-legal-help-card sc-legal-help-standalone reveal-up">
                    <strong>Need Help?</strong>
                    <p>If you have any questions regarding this policy, feel free to reach out to our support team.</p>
                    <a href="{{ route('contact') }}" class="sc-btn sc-btn-primary sc-btn-sm">Contact Support</a>
                </div>
            @endif
        </div>
    </div>

</main>
@endsection
