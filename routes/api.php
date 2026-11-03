<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AiChatApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\CourseApiController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\NewsletterApiController;
use App\Http\Controllers\Api\MockTestApiController;
use App\Http\Controllers\Api\StudentApiController;
use Illuminate\Support\Facades\Route;

// ── Auth (public) ─────────────────────────────────────────────
Route::prefix('auth')->name('api.auth.')->group(function () {
    Route::post('/register', [AuthApiController::class, 'register'])->middleware('throttle:api-auth')->name('register');
    Route::post('/login', [AuthApiController::class, 'login'])->middleware('throttle:api-auth')->name('login');
});

// ── Courses (public) ────────────────────────────────────────────
Route::get('/courses', [CourseApiController::class, 'index'])->name('api.courses.index');
Route::get('/courses/{course}', [CourseApiController::class, 'show'])->name('api.courses.show');
Route::get('/categories', [CourseApiController::class, 'categories'])->name('api.categories');
Route::get('/mock-tests', [MockTestApiController::class, 'index'])->name('api.mock-tests.index');
Route::get('/mock-tests/{mockTest}', [MockTestApiController::class, 'show'])->name('api.mock-tests.show');

// ── Blog (public) ─────────────────────────────────────────────
Route::prefix('blog')->name('api.blog.')->group(function () {
    Route::get('/posts', [BlogApiController::class, 'posts'])->name('posts');
    Route::get('/categories', [BlogApiController::class, 'categories'])->name('categories');
    Route::get('/videos', [BlogApiController::class, 'videos'])->name('videos');
});

// ── Home & pages (public) ───────────────────────────────────────
Route::get('/home', [HomeApiController::class, 'home'])->name('api.home');
Route::get('/about', [HomeApiController::class, 'about'])->name('api.about');
Route::post('/contact', [ContactApiController::class, 'store'])->middleware('throttle:public-forms')->name('api.contact');
Route::post('/newsletter', [NewsletterApiController::class, 'store'])->middleware('throttle:public-forms')->name('api.newsletter');

// ── Protected routes (Bearer token) ─────────────────────────────
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->name('api.auth.')->group(function () {
        Route::get('/user', [AuthApiController::class, 'user'])->name('user');
        Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');
    });

    Route::post('/courses/{course}/enroll', [CourseApiController::class, 'enroll'])->name('api.courses.enroll');
    Route::delete('/courses/{course}/enroll', [CourseApiController::class, 'unenroll'])->name('api.courses.unenroll');

    Route::prefix('account')->group(function () {
        Route::get('/', [StudentApiController::class, 'profile'])->name('api.account.show');
        Route::put('/', [StudentApiController::class, 'updateProfile'])->name('api.account.update');
        Route::put('/password', [StudentApiController::class, 'updatePassword'])->name('api.account.password');
        Route::get('/wishlist', [StudentApiController::class, 'wishlist'])->name('api.wishlist.index');
        Route::post('/wishlist/{course}', [StudentApiController::class, 'toggleWishlist'])->name('api.wishlist.toggle');
        Route::get('/notifications', [StudentApiController::class, 'notifications'])->name('api.notifications.index');
        Route::post('/notifications/read-all', [StudentApiController::class, 'markAllNotificationsRead'])->name('api.notifications.read-all');
        Route::post('/notifications/{notification}/read', [StudentApiController::class, 'markNotificationRead'])->name('api.notifications.read');
        Route::put('/preferences', [StudentApiController::class, 'updatePreferences'])->name('api.preferences.update');
        Route::post('/chapters/{chapter}/complete', [StudentApiController::class, 'completeChapter'])->name('api.chapters.complete');
        Route::get('/certificates', [StudentApiController::class, 'certificates'])->name('api.certificates.index');
    });

    Route::post('/mock-tests/{mockTest}/submit', [MockTestApiController::class, 'submit'])->name('api.mock-tests.submit');
    Route::get('/mock-test-attempts', [MockTestApiController::class, 'attempts'])->name('api.mock-tests.attempts');
    Route::post('/ai/chat', [AiChatApiController::class, 'send'])->middleware('throttle:ai-chat')->name('api.ai.chat');
    Route::get('/ai/conversations/{conversation}', [AiChatApiController::class, 'history'])->middleware('throttle:ai-chat')->name('api.ai.history');
});
