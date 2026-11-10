@php
    $stats = [
        ['icon' => 'users', 'value' => 10000, 'suffix' => '+', 'label' => 'Active Students', 'iconBg' => 'bg-brand-50 text-brand-500'],
        ['icon' => 'book-open-check', 'value' => 500, 'suffix' => '+', 'label' => 'Free Courses', 'iconBg' => 'bg-sky-50 text-sky-500'],
        ['icon' => 'shield-check', 'value' => 1500, 'suffix' => '+', 'label' => 'Selections', 'iconBg' => 'bg-emerald-50 text-emerald-500'],
        ['icon' => 'award', 'value' => 95, 'suffix' => '%', 'label' => 'Success Rate', 'iconBg' => 'bg-amber-50 text-amber-500'],
    ];
@endphp

<section class="section -mt-8 relative z-10 sm:-mt-10">
    <div class="card grid grid-cols-2 divide-y divide-ink-900/5 lg:grid-cols-4 lg:divide-x lg:divide-y-0">
        @foreach ($stats as $stat)
            <div data-animate data-animate-group="stats" class="flex items-center gap-4 px-6 py-6 sm:px-8">
                <span class="stat-icon {{ $stat['iconBg'] }}">
                    <i data-lucide="{{ $stat['icon'] }}" class="h-5 w-5"></i>
                </span>
                <div>
                    <p class="text-xl font-bold text-ink-900 sm:text-2xl">
                        <span data-counter="{{ $stat['value'] }}" data-counter-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</span>
                    </p>
                    <p class="text-xs text-ink-500 sm:text-sm">{{ $stat['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
