<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard for admins, or the personal dashboard for regular users.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            return view('admin.dashboard', $this->adminDashboardData());
        }

        $enrolledCourses = $user->courses()->latest('enrollments.created_at')->get();

        return view('user.dashboard', compact('enrolledCourses'));
    }

    private function adminDashboardData(): array
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $totalBlogs = Blog::count();

        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();
        $recentCourses = Course::latest()->take(5)->get();
        $latestInquiries = Inquiry::latest()->take(5)->get();

        // ── Enrollments trend: last 12 months ──────────────────────
        $months = collect(range(11, 0))->map(fn ($i) => Carbon::now()->subMonths($i)->startOfMonth());
        $enrollmentTrend = $months->map(function (Carbon $month) {
            return Enrollment::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });
        $enrollmentTrendLabels = $months->map(fn (Carbon $m) => $m->format('M'));

        // ── Enrollments by category ─────────────────────────────────
        $categoryDistribution = Enrollment::join('courses', 'courses.id', '=', 'enrollments.course_id')
            ->selectRaw('courses.category as category, count(*) as total')
            ->groupBy('courses.category')
            ->pluck('total', 'category');

        // ── New users trend: last 6 months ──────────────────────────
        $sixMonths = collect(range(5, 0))->map(fn ($i) => Carbon::now()->subMonths($i)->startOfMonth());
        $newUsersTrend = $sixMonths->map(function (Carbon $month) {
            return User::where('role', 'user')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        });
        $newUsersTrendLabels = $sixMonths->map(fn (Carbon $m) => $m->format('M'));

        // ── Recent activity feed (merged) ───────────────────────────
        $recentActivities = collect()
            ->concat(User::where('role', 'user')->latest()->take(3)->get()->map(fn ($u) => [
                'icon' => '👤', 'text' => 'New User Registered: '.$u->name, 'at' => $u->created_at,
            ]))
            ->concat(Course::latest()->take(3)->get()->map(fn ($c) => [
                'icon' => '📚', 'text' => 'New Course Added: '.$c->title, 'at' => $c->created_at,
            ]))
            ->concat(Inquiry::latest()->take(3)->get()->map(fn ($i) => [
                'icon' => '📩', 'text' => 'New Inquiry: '.$i->name, 'at' => $i->created_at,
            ]))
            ->sortByDesc('at')
            ->take(5)
            ->values();

        // ── Platform overview percentages ───────────────────────────
        $activeCoursesPct = $totalCourses > 0 ? round(Course::active()->count() / $totalCourses * 100) : 0;
        $verifiedUsersPct = $totalUsers > 0 ? round(User::where('role', 'user')->whereNotNull('email_verified_at')->count() / $totalUsers * 100) : 0;
        $categoriesWithCoursesPct = \App\Models\Category::count() > 0
            ? round(\App\Models\Category::get()->filter(fn ($c) => $c->courses_count > 0)->count() / \App\Models\Category::count() * 100)
            : 0;
        $publishedBlogsPct = $totalBlogs > 0 ? round(Blog::published()->count() / $totalBlogs * 100) : 0;

        return compact(
            'totalUsers', 'totalCourses', 'totalEnrollments', 'totalBlogs',
            'recentUsers', 'recentCourses', 'latestInquiries',
            'enrollmentTrend', 'enrollmentTrendLabels',
            'categoryDistribution', 'newUsersTrend', 'newUsersTrendLabels',
            'recentActivities',
            'activeCoursesPct', 'verifiedUsersPct', 'categoriesWithCoursesPct', 'publishedBlogsPct'
        );
    }
}
