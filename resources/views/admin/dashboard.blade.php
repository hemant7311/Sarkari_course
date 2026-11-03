@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="sa-page-head">
    <div>
        <h2>Dashboard Overview</h2>
        <p>Real-time snapshot of your platform.</p>
    </div>
</div>

{{-- ══════════════════ STAT CARDS ══════════════════ --}}
<div class="sa-stat-grid">
    <div class="sa-stat-card">
        <div><strong>{{ $totalUsers }}</strong><span>Total Users</span></div>
        <span class="sa-stat-icon sa-c1">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </span>
    </div>
    <div class="sa-stat-card">
        <div><strong>{{ $totalCourses }}</strong><span>Total Courses</span></div>
        <span class="sa-stat-icon sa-c2">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </span>
    </div>
    <div class="sa-stat-card">
        <div><strong>{{ $totalEnrollments }}</strong><span>Total Enrollments</span></div>
        <span class="sa-stat-icon sa-c3">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1.66 2.69 3 6 3s6-1.34 6-3v-5"/></svg>
        </span>
    </div>
    <div class="sa-stat-card">
        <div><strong>{{ $totalBlogs }}</strong><span>Total Blogs</span></div>
        <span class="sa-stat-icon sa-c4">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4"/><path d="M14 2v5h5"/><path d="M2 15h10M2 11h6M2 19h10"/></svg>
        </span>
    </div>
</div>

{{-- ══════════════════ CHARTS ROW 1 ══════════════════ --}}
<div class="sa-dash-grid-8-4">
    <div class="sa-card">
        <div class="sa-card-head"><h3>Enrollments (Last 12 Months)</h3></div>
        <div class="sa-card-body">
            <div class="sa-chart-wrap"><canvas id="revenueChart" style="display:block; width:100% !important; height:280px !important;"></canvas></div>
        </div>
    </div>
    <div class="sa-card">
        <div class="sa-card-head"><h3>Enrollments by Category</h3></div>
        <div class="sa-card-body">
            <div class="sa-chart-wrap"><canvas id="salesChart" style="display:block; width:100% !important; height:280px !important;"></canvas></div>
        </div>
    </div>
</div>

{{-- ══════════════════ CHARTS ROW 2 ══════════════════ --}}
<div class="sa-dash-grid-8-4">
    <div class="sa-card">
        <div class="sa-card-head"><h3>New Users (Last 6 Months)</h3></div>
        <div class="sa-card-body">
            <div class="sa-chart-wrap"><canvas id="monthlySalesChart" style="display:block; width:100% !important; height:280px !important;"></canvas></div>
        </div>
    </div>
    <div class="sa-card">
        <div class="sa-card-head"><h3>Recent Activity</h3></div>
        <div class="sa-card-body">
            <div class="sa-activity-list">
                @forelse($recentActivities as $activity)
                    <div class="sa-activity-item">
                        <span class="sa-activity-icon">{{ $activity['icon'] }}</span>
                        <div><p>{{ $activity['text'] }}</p><small>{{ $activity['at']->diffForHumans() }}</small></div>
                    </div>
                @empty
                    <div class="sa-empty"><span>🕓</span>Abhi tak koi activity nahi hai.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════ LATEST INQUIRIES ══════════════════ --}}
<div class="sa-card">
    <div class="sa-card-head">
        <h3>Latest Inquiries</h3>
        <a href="{{ route('inquiry') }}" class="sa-btn sa-btn-outline sa-btn-sm">View All</a>
    </div>
    <div class="sa-card-body sa-p0">
        <div class="sa-table-wrap">
            <table class="sa-table">
                <thead><tr><th>Name</th><th>Email</th><th>Course</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($latestInquiries as $inquiry)
                    <tr>
                        <td>{{ $inquiry->name }}</td>
                        <td>{{ $inquiry->email }}</td>
                        <td>{{ $inquiry->course ?? '—' }}</td>
                        <td>
                            @if($inquiry->status === 'active')
                                <span class="sa-badge sa-badge-success">Active</span>
                            @elseif($inquiry->status === 'inactive')
                                <span class="sa-badge sa-badge-muted">Inactive</span>
                            @else
                                <span class="sa-badge sa-badge-warning">Pending</span>
                            @endif
                        </td>
                        <td>{{ $inquiry->created_at->format('d M') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="sa-table-empty">Abhi tak koi inquiry nahi hai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ══════════════════ RECENT USERS + PLATFORM OVERVIEW ══════════════════ --}}
<div class="sa-dash-grid-6-6">
    <div class="sa-card">
        <div class="sa-card-head">
            <h3>Recent Users</h3>
            <a href="{{ route('users') }}" class="sa-btn sa-btn-outline sa-btn-sm">View All</a>
        </div>
        <div class="sa-card-body sa-p0">
            <div class="sa-table-wrap">
                <table class="sa-table">
                    <tbody>
                        @forelse($recentUsers as $ru)
                        <tr>
                            <td style="width:52px"><span class="sa-table-avatar">{{ strtoupper(substr($ru->name, 0, 1)) }}</span></td>
                            <td><strong>{{ $ru->name }}</strong><span class="sa-table-sub">{{ $ru->email }}</span></td>
                            <td style="text-align:right">
                                <span class="sa-badge {{ $ru->email_verified_at ? 'sa-badge-success' : 'sa-badge-warning' }}">
                                    {{ $ru->email_verified_at ? 'Verified' : 'Unverified' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td class="sa-table-empty">Abhi tak koi user register nahi hua.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="sa-card">
        <div class="sa-card-head"><h3>Platform Overview</h3></div>
        <div class="sa-card-body">
            <div class="sa-progress-row">
                <div class="sa-progress-label"><span>Active Courses</span><strong>{{ $activeCoursesPct }}%</strong></div>
                <div class="sa-progress-track"><div class="sa-progress-fill" style="width:{{ $activeCoursesPct }}%"></div></div>
            </div>
            <div class="sa-progress-row">
                <div class="sa-progress-label"><span>Verified Users</span><strong>{{ $verifiedUsersPct }}%</strong></div>
                <div class="sa-progress-track"><div class="sa-progress-fill" style="width:{{ $verifiedUsersPct }}%"></div></div>
            </div>
            <div class="sa-progress-row">
                <div class="sa-progress-label"><span>Categories with Courses</span><strong>{{ $categoriesWithCoursesPct }}%</strong></div>
                <div class="sa-progress-track"><div class="sa-progress-fill" style="width:{{ $categoriesWithCoursesPct }}%"></div></div>
            </div>
            <div class="sa-progress-row">
                <div class="sa-progress-label"><span>Published Blogs</span><strong>{{ $publishedBlogsPct }}%</strong></div>
                <div class="sa-progress-track"><div class="sa-progress-fill" style="width:{{ $publishedBlogsPct }}%"></div></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .sa-dash-grid-8-4 { display: grid; grid-template-columns: 2fr 1fr; gap: 18px; margin-bottom: 22px; }
    .sa-dash-grid-6-6 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    @media (max-width: 1180px) { .sa-dash-grid-8-4, .sa-dash-grid-6-6 { grid-template-columns: 1fr; } }
</style>
@endpush

@push('scripts')
<script>
    // ✅ Preserved exactly as before — responsive:false intentionally fixes a
    // canvas zoom/growth loop bug. Do not change to responsive:true.
    Chart.defaults.animation = false;
    Chart.defaults.responsive = false;
    Chart.defaults.maintainAspectRatio = false;

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: @json($enrollmentTrendLabels),
            datasets: [{
                label: 'Enrollments',
                data: @json($enrollmentTrend),
                borderColor: '#6D28D9',
                backgroundColor: 'rgba(109,40,217,.12)',
                borderWidth: 3,
                tension: .4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#6D28D9'
            }]
        },
        options: {
            animation: false, responsive: false, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { grid: { display: false } }, y: { grid: { color: '#f0f0f0' }, ticks: { precision: 0 } } }
        }
    });

    new Chart(document.getElementById('salesChart'), {
        type: 'doughnut',
        data: {
            labels: @json($categoryDistribution->keys()),
            datasets: [{
                data: @json($categoryDistribution->values()),
                backgroundColor: ['#6D28D9', '#8B5CF6', '#F59E0B', '#22C55E', '#EF4444', '#0891B2']
            }]
        },
        options: { animation: false, responsive: false, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('monthlySalesChart'), {
        type: 'bar',
        data: {
            labels: @json($newUsersTrendLabels),
            datasets: [{ label: 'New Users', data: @json($newUsersTrend), backgroundColor: '#6D28D9', borderRadius: 10 }]
        },
        options: {
            animation: false, responsive: false, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { x: { grid: { display: false } }, y: { grid: { color: '#f0f0f0' }, ticks: { precision: 0 } } }
        }
    });
</script>
@endpush
