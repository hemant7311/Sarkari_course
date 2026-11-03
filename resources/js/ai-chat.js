// SarkariCourse — AI Chat Support Widget (Phase 3)
// Frontend-only canned responses; auto-scroll, typing indicator, quick replies.
document.addEventListener('DOMContentLoaded', () => {
    const widget = document.getElementById('scAiWidget');
    if (!widget) return;

    const fab = document.getElementById('scAiFab');
    const panel = document.getElementById('scAiPanel');
    const messages = document.getElementById('scAiMessages');
    const form = document.getElementById('scAiForm');
    const input = document.getElementById('scAiInput');
    const refreshBtn = document.getElementById('scAiRefresh');

    const RESPONSES = {
        courses: "We have 500+ free courses across SSC, Railway, Banking, UPSC, Police and State exams. Head to the Courses page and filter by your target exam — I'd recommend starting with the category that matches your goal!",
        plan: "A solid prep plan: 1) Pick one primary exam, 2) Follow the course's structured curriculum, 3) Take a mock test every week, 4) Review current affairs daily. Want me to point you to a course to get started?",
        mocks: "Mock tests are available inside each course under 'All Classes' once you're enrolled — just click Enroll Now (it's free) and they'll unlock instantly.",
        issue: "Sorry you're facing an issue! For technical problems, please reach out on our Contact page and our support team will get back within 24 hours.",
        default: "Thanks for your message! For anything specific, our support team can help in detail — feel free to visit the Contact page, or ask me about courses, your prep plan, or mock tests.",
    };

    function scrollToBottom() {
        messages.scrollTop = messages.scrollHeight;
    }

    function addBubble(text, fromUser = false) {
        const bubble = document.createElement('div');
        bubble.className = fromUser ? 'sc-ai-bubble sc-ai-bubble-user' : 'sc-ai-bubble';
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        bubble.innerHTML = `<p></p><span class="sc-ai-time">${time}</span>`;
        bubble.querySelector('p').textContent = text;
        messages.appendChild(bubble);
        scrollToBottom();
    }

    function showTyping() {
        const typing = document.createElement('div');
        typing.className = 'sc-ai-bubble sc-ai-typing';
        typing.id = 'scAiTypingIndicator';
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            typing.innerHTML = '<span></span><span></span><span></span>';
        } else {
            const lottieEl = document.createElement('div');
            lottieEl.className = 'sc-ai-typing-lottie';
            lottieEl.setAttribute('data-lottie', '/lottie/loading-dots.json');
            typing.appendChild(lottieEl);
            messages.appendChild(typing);
            scrollToBottom();
            window.scLottieMount?.(lottieEl);
            return;
        }
        messages.appendChild(typing);
        scrollToBottom();
    }

    function respond(key) {
        showTyping();
        setTimeout(() => {
            document.getElementById('scAiTypingIndicator')?.remove();
            addBubble(RESPONSES[key] || RESPONSES.default);
        }, 900 + Math.random() * 500);
    }

    fab?.addEventListener('click', () => {
        const isOpen = widget.classList.toggle('open');
        panel.setAttribute('aria-hidden', String(!isOpen));
        if (isOpen) setTimeout(scrollToBottom, 50);
    });

    document.getElementById('scAiQuickReplies')?.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-q]');
        if (!btn) return;
        addBubble(btn.textContent.trim().replace(/^\S+\s/, ''), true);
        respond(btn.dataset.q);
    });

    form?.addEventListener('submit', (e) => {
        e.preventDefault();
        const val = input.value.trim();
        if (!val) return;
        addBubble(val, true);
        input.value = '';
        const lower = val.toLowerCase();
        let key = 'default';
        if (lower.includes('course')) key = 'courses';
        else if (lower.includes('plan') || lower.includes('prepar')) key = 'plan';
        else if (lower.includes('mock') || lower.includes('test')) key = 'mocks';
        else if (lower.includes('issue') || lower.includes('bug') || lower.includes('problem')) key = 'issue';
        respond(key);
    });

    refreshBtn?.addEventListener('click', () => {
        messages.innerHTML = `
            <div class="sc-ai-bubble"><p>Hi 👋 I'm your study assistant. How can I help you today?</p><span class="sc-ai-time">Just now</span></div>
            <div class="sc-ai-quick-replies" id="scAiQuickReplies">
                <button type="button" data-q="courses">🔍 Find the best courses for me</button>
                <button type="button" data-q="plan">📅 Help with my preparation plan</button>
                <button type="button" data-q="mocks">📝 How to access mock tests?</button>
                <button type="button" data-q="issue">⚙️ Any technical issues?</button>
            </div>`;
    });
});
