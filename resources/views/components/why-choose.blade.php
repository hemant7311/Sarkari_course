@php
    $features = [
        ['icon' => 'gem', 'iconBg' => 'bg-violet-50 text-violet-500', 'title' => '100% Free Courses', 'desc' => 'All courses, study materials and resources are completely free for everyone.'],
        ['icon' => 'user-check', 'iconBg' => 'bg-sky-50 text-sky-500', 'title' => 'Expert Faculty', 'desc' => 'Learn from experienced educators and toppers with proven teaching track records.'],
        ['icon' => 'monitor-play', 'iconBg' => 'bg-emerald-50 text-emerald-500', 'title' => 'Live Classes', 'desc' => 'Join daily live classes and interact with faculty in real-time.'],
        ['icon' => 'clipboard-list', 'iconBg' => 'bg-indigo-50 text-indigo-500', 'title' => 'Mock Tests', 'desc' => 'Practice unlimited mock tests with detailed performance analysis.'],
        ['icon' => 'file-text', 'iconBg' => 'bg-teal-50 text-teal-500', 'title' => 'Study Materials', 'desc' => 'Download free high-quality notes, PDFs and eBooks.'],
        ['icon' => 'newspaper', 'iconBg' => 'bg-rose-50 text-rose-500', 'title' => 'Current Affairs', 'desc' => 'Stay updated with daily, weekly and monthly current affairs.'],
        ['icon' => 'message-circle-question', 'iconBg' => 'bg-amber-50 text-amber-500', 'title' => 'Doubt Support', 'desc' => 'Get your doubts cleared by experts through our support system.'],
        ['icon' => 'trending-up', 'iconBg' => 'bg-orange-50 text-orange-500', 'title' => 'Progress Tracking', 'desc' => 'Track your progress and improve your preparation every day.'],
    ];
@endphp

<section class="bg-surface-soft">
    <div class="section section-y">
        <div class="mx-auto max-w-2xl text-center">
            <span class="eyebrow justify-center">Why Choose SarkariCourse?</span>
            <h2 class="section-heading">Quality Education, Completely Free</h2>
            <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-brand-500"></div>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($features as $feature)
                <div data-animate data-animate-group="features" class="flex items-start gap-4">
                    <span class="stat-icon shrink-0 {{ $feature['iconBg'] }}">
                        <i data-lucide="{{ $feature['icon'] }}" class="h-5 w-5"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-bold text-ink-900">{{ $feature['title'] }}</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-ink-500">{{ $feature['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
