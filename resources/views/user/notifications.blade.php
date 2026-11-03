@extends('layouts.user')

@section('title', 'Notifications')

@section('content')

@php
    // No Notification model/migration exists yet — this renders the approved
    // UI with representative sample content, same "UI ready" spirit as the
    // Google/Apple social login buttons in Phase 3. Swap $groups for real
    // data once a notifications table lands.
    $groups = [
        'Today' => [
            ['icon' => '🎉', 'title' => 'New batch launched', 'text' => 'SSC CGL 2024 Complete Batch is now live — enroll for free.', 'unread' => true],
            ['icon' => '📝', 'title' => 'Mock test reminder', 'text' => "Today's current affairs mock test closes at 9 PM.", 'unread' => true],
        ],
        'Yesterday' => [
            ['icon' => '📚', 'title' => 'New study material added', 'text' => 'Fresh notes added to Railway NTPC course.', 'unread' => false],
        ],
        'Earlier' => [
            ['icon' => '✅', 'title' => 'Welcome to SarkariCourse!', 'text' => 'Your account was created successfully.', 'unread' => false],
        ],
    ];
    $hasAny = collect($groups)->flatten(1)->isNotEmpty();
    $unreadCount = collect($groups)->flatten(1)->where('unread', true)->count();
@endphp

<div class="sc-dash-banner reveal-up">
    <div>
        <h1>Notifications</h1>
        <p>Stay updated with your latest activity and announcements.</p>
    </div>
    @if($unreadCount)
        <button type="button" class="sc-btn sc-btn-outline sc-btn-sm" id="scMarkAllRead">Mark all as read</button>
    @endif
</div>

@if($hasAny)
    <div class="sc-notif-list" data-reveal-group>
        @foreach($groups as $label => $items)
            @if(count($items))
                <div class="sc-notif-group">
                    <h2 class="sc-notif-group-label">{{ $label }}</h2>
                    @foreach($items as $n)
                        <div class="sc-notif-card {{ $n['unread'] ? 'unread' : '' }}">
                            <span class="sc-notif-icon">{{ $n['icon'] }}</span>
                            <div class="sc-notif-body">
                                <strong>{{ $n['title'] }}</strong>
                                <p>{{ $n['text'] }}</p>
                            </div>
                            @if($n['unread'])
                                <span class="sc-notif-dot" aria-label="Unread"></span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@else
    <div class="sc-empty-panel">
        <img src="{{ asset('images/notifications/notifications-empty-3d.webp') }}" alt="Empty notification bell illustration" width="220" height="180" loading="lazy" style="display:block;margin:0 auto 14px;">
        <h2>No notifications yet</h2>
        <p>We'll let you know when there's something new.</p>
    </div>
@endif

@push('scripts')
<script>
    document.getElementById('scMarkAllRead')?.addEventListener('click', function () {
        document.querySelectorAll('.sc-notif-card.unread').forEach((c) => c.classList.remove('unread'));
        document.querySelectorAll('.sc-notif-dot').forEach((d) => d.remove());
        this.remove();
    });
</script>
@endpush
@endsection
