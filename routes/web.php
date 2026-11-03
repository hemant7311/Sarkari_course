<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// ── Public Pages ──────────────────────────────────────────────
Route::get('/', function () {
    $totalStudents = \App\Models\User::where('role', 'user')->count();
    $totalCourses = \App\Models\Course::active()->count();
    $categories = \App\Models\Category::orderBy('name')->get();
    $featuredCourses = \App\Models\Course::active()->latest()->take(6)->get();

    return view('home', compact('totalStudents', 'totalCourses', 'categories', 'featuredCourses'));
})->name('home');

Route::get('/about', function () {
    $totalStudents = \App\Models\User::where('role', 'user')->count();
    $totalCourses = \App\Models\Course::active()->count();

    return view('about', compact('totalStudents', 'totalCourses'));
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:public-forms')->name('contact.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->middleware('throttle:public-forms')->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
// ── Legal pages ──────────────────────────────────────────────
Route::get('/privacy-policy', function () {
    return view('legal', [
        'title' => 'Privacy Policy',
        'content' => "Welcome to SarkariCourse. We value your privacy and are committed to protecting your personal information.\n\n"
            ."1. We collect only the information you provide through registration or contact forms, such as your name, email address, and phone number.\n"
            ."2. We do not sell, trade, or share your personal information with third parties.\n"
            ."3. Your data is securely stored on protected servers.\n"
            ."4. You may request to delete your account at any time, and your personal data will be removed from our system.\n"
            ."5. If you have any questions regarding our Privacy Policy, please contact us through our Contact page.",
    ]);
})->name('privacy');

Route::get('/terms-and-conditions', function () {
    return view('legal', [
        'title' => 'Terms & Conditions',
        'content' => "By using SarkariCourse, you agree to the following Terms & Conditions:\n\n"
            ."1. All courses available on SarkariCourse are provided for educational purposes only.\n"
            ."2. You are responsible for maintaining the confidentiality of your account credentials and password.\n"
            ."3. Copying, redistributing, or reselling any course content without permission is strictly prohibited.\n"
            ."4. SarkariCourse reserves the right to update, modify, or remove any course or content at any time without prior notice.\n"
            ."5. Accounts found engaging in fraudulent, abusive, or inappropriate activities may be suspended or permanently terminated.",
    ]);
})->name('terms');

Route::get('/refund-policy', function () {
    return view('legal', [
        'title' => 'Refund Policy',
        'content' => "Currently, all courses available on SarkariCourse are provided free of charge; therefore, no refund policy is applicable.\n\n"
            ."If paid courses are introduced in the future, this Refund Policy will be updated accordingly with the applicable refund terms and conditions.",
    ]);
})->name('refund');
// ── Courses (public, dynamic) ────────────────────────────────
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/course_details/{course}', [CourseController::class, 'show'])->name('course_details');

// ── Blog (public, dynamic + youtube) ─────────────────────────
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

// ── Login/Register page (custom design, posts to Breeze routes) ──
Route::get('/userlogin', function () {
    return view('profile.userlogin');
})->middleware('guest')->name('userlogin');

// ── Enroll / Add to Course ────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
    Route::delete('/courses/{course}/enroll', [EnrollmentController::class, 'destroy'])->name('courses.unenroll');
    Route::post('/chapters/{chapter}/complete', [LearningController::class, 'complete'])->name('chapters.complete');
});

// ── Phase 3 — frontend-only pages (same lightweight closure pattern as the
//    Legal pages above). No new models/migrations: Wishlist and Notifications
//    render the approved UI with the current user's real enrolled courses as
//    sample content (no persistence table exists yet for saved/unread state,
//    same "UI ready" spirit as the Google/Apple social buttons). Settings only
//    wires the fields that already have a backend home (profile.update /
//    password.update / profile.destroy) — everything else is a UI-ready
//    placeholder section. Search is fully live: read-only queries against the
//    existing Course and Blog models. ─────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [StudentController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/{course}', [StudentController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::get('/notifications', [StudentController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/read-all', [StudentController::class, 'markAllNotificationsRead'])->name('notifications.read-all');
    Route::post('/notifications/{notification}/read', [StudentController::class, 'markNotificationRead'])->name('notifications.read');
    Route::get('/settings', function () {
        return view('user.settings', ['user' => auth()->user()->load('preference')]);
    })->name('settings');
    Route::put('/settings/preferences', [StudentController::class, 'updatePreferences'])->name('settings.preferences');
    Route::get('/certificates/{certificate}', [StudentController::class, 'certificate'])->name('certificates.show');
});

Route::get('/certificates/verify/{verificationCode}', [StudentController::class, 'verifyCertificate'])->name('certificates.verify');

Route::get('/search', function (\Illuminate\Http\Request $request) {
    $q = trim((string) $request->get('q', ''));

    $courseResults = collect();
    $blogResults = collect();

    if ($q !== '') {
        $courseResults = \App\Models\Course::active()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")->orWhere('teacher_name', 'like', "%{$q}%");
            })
            ->latest()->take(9)->get();

        $blogResults = \App\Models\Blog::published()
            ->where('title', 'like', "%{$q}%")
            ->latest('published_at')->take(6)->get();
    }

    return view('search-results', compact('q', 'courseResults', 'blogResults'));
})->name('search');

// ── Dashboard (role-aware: admin sees admin panel, user sees their dashboard) ──
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ── Admin-only routes ─────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', function () {
        return view('admin.users', [
            'users' => \App\Models\User::where('role', 'user')->latest()->paginate(10),
        ]);
    })->name('users');

    Route::delete('/users/{user}', function (\App\Models\User $user) {
        abort_if($user->role === 'admin', 403, 'Admin account delete nahi kiya ja sakta.');
        $user->delete();

        return back()->with('status', 'User delete kar diya gaya hai.');
    })->name('users.destroy');

    Route::get('/addcourses', [AdminCourseController::class, 'index'])->name('addcourses');
    Route::post('/addcourses', [AdminCourseController::class, 'store'])->name('courses.store');
    Route::put('/addcourses/{course}', [AdminCourseController::class, 'update'])->name('courses.update');
    Route::delete('/addcourses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/courses/{course}/chapters', [AdminChapterController::class, 'index'])->name('admin.chapters');
    Route::post('/courses/{course}/chapters', [AdminChapterController::class, 'store'])->name('admin.chapters.store');
    Route::put('/courses/{course}/chapters/{chapter}', [AdminChapterController::class, 'update'])->name('admin.chapters.update');
    Route::delete('/courses/{course}/chapters/{chapter}', [AdminChapterController::class, 'destroy'])->name('admin.chapters.destroy');

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs');
    Route::post('/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
    Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');

    Route::get('/inquiry', [AdminInquiryController::class, 'index'])->name('inquiry');
    Route::put('/inquiry/{inquiry}', [AdminInquiryController::class, 'updateStatus'])->name('inquiry.update');
    Route::delete('/inquiry/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiry.destroy');

    Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});

// ── Profile Routes (any logged in user) ───────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';
