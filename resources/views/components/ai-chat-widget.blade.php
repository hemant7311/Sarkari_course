{{--
  SarkariCourse — AI Chat Support Widget (Phase 3)
  Frontend-only: canned quick-reply responses, no live AI backend wired yet
  (same "UI ready" spirit as the Google/Apple social login buttons).
  Included globally from layouts/first.blade.php and layouts/user.blade.php.
--}}
<div class="sc-scope sc-ai-widget" id="scAiWidget">

    <button type="button" class="sc-ai-fab" id="scAiFab" aria-label="Open AI support chat">
        <span class="sc-ai-fab-icon">
            <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="4" y="7" width="16" height="12" rx="3"/><circle cx="9" cy="13" r="1.2" fill="#fff" stroke="none"/><circle cx="15" cy="13" r="1.2" fill="#fff" stroke="none"/><path d="M12 7V4"/><circle cx="12" cy="3" r="1" fill="#fff" stroke="none"/>
            </svg>
        </span>
        <span class="sc-ai-fab-close">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </span>
    </button>

    <div class="sc-ai-panel" id="scAiPanel" aria-hidden="true">
        <div class="sc-ai-header">
            <span class="sc-ai-avatar"><img src="{{ asset('images/icons/ai-assistant-robot-3d.webp') }}" alt="AI assistant"></span>
            <div>
                <strong>AI Support</strong>
                <span class="sc-ai-status"><i></i> Online</span>
            </div>
            <button type="button" class="sc-icon-btn" id="scAiRefresh" aria-label="Restart chat">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
            </button>
        </div>

        <div class="sc-ai-messages" id="scAiMessages">
            <div class="sc-ai-bubble">
                <p>Hi 👋 I'm your study assistant. How can I help you today?</p>
                <span class="sc-ai-time">Just now</span>
            </div>
            <div class="sc-ai-quick-replies" id="scAiQuickReplies">
                <button type="button" data-q="courses">🔍 Find the best courses for me</button>
                <button type="button" data-q="plan">📅 Help with my preparation plan</button>
                <button type="button" data-q="mocks">📝 How to access mock tests?</button>
                <button type="button" data-q="issue">⚙️ Any technical issues?</button>
            </div>
        </div>

        <form class="sc-ai-input-row" id="scAiForm">
            <input type="text" id="scAiInput" placeholder="Type your message…" autocomplete="off">
            <button type="submit" aria-label="Send">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
        </form>
        <span class="sc-ai-powered">⚡ Powered by AI</span>
    </div>
</div>

@push('scripts')
@vite(['resources/js/ai-chat.js'])
@endpush
