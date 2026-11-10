@php
    $categories = [
        ['icon' => 'users-round', 'iconBg' => 'bg-brand-50 text-brand-500', 'title' => 'SSC', 'desc' => 'Staff Selection Commission', 'count' => '120+ Courses', 'href' => '/exams/ssc'],
        ['icon' => 'train-front', 'iconBg' => 'bg-sky-50 text-sky-500', 'title' => 'Railway', 'desc' => 'Railway Recruitment Board', 'count' => '85+ Courses', 'href' => '/exams/railway'],
        ['icon' => 'landmark', 'iconBg' => 'bg-blue-50 text-blue-500', 'title' => 'Banking', 'desc' => 'Bank PO, Clerk & Other Exams', 'count' => '95+ Courses', 'href' => '/exams/banking'],
        ['icon' => 'scroll-text', 'iconBg' => 'bg-amber-50 text-amber-500', 'title' => 'UPSC', 'desc' => 'Union Public Service Commission', 'count' => '75+ Courses', 'href' => '/exams/upsc'],
        ['icon' => 'building-2', 'iconBg' => 'bg-emerald-50 text-emerald-500', 'title' => 'State PSC', 'desc' => 'State Public Service Commissions', 'count' => '95+ Courses', 'href' => '/exams/state-psc'],
        ['icon' => 'graduation-cap', 'iconBg' => 'bg-rose-50 text-rose-500', 'title' => 'Police', 'desc' => 'Police Recruitment Exams', 'count' => '95+ Courses', 'href' => '/exams/police'],
    ];
@endphp

<section class="section section-y">
    <div class="mx-auto max-w-2xl text-center">
        <span class="eyebrow justify-center">Popular Exam Categories</span>
        <h2 class="section-heading">Choose Your Exam, Start Your Preparation</h2>
        <p class="section-subheading">All government exam preparation in one place</p>
    </div>

    <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        @foreach ($categories as $category)
            <a
                href="{{ $category['href'] }}"
                data-animate
                data-animate-group="categories"
                class="card group flex flex-col items-center gap-3 px-4 py-7 text-center"
            >
                <span class="stat-icon h-14 w-14 {{ $category['iconBg'] }} transition-transform duration-300 group-hover:scale-110">
                    <i data-lucide="{{ $category['icon'] }}" class="h-6 w-6"></i>
                </span>
                <span>
                    <span class="block text-sm font-bold text-ink-900">{{ $category['title'] }}</span>
                    <span class="mt-1 hidden text-xs text-ink-500 sm:block">{{ $category['desc'] }}</span>
                </span>
                <span class="text-xs font-medium text-brand-500">{{ $category['count'] }}</span>
            </a>
        @endforeach
    </div>

    <div class="mt-10 flex justify-center">
        <a href="/exams" class="btn-primary">
            View All Categories
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
        </a>
    </div>
</section>
