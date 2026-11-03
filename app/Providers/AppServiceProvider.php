<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        RateLimiter::for('public-forms', fn (Request $request) => Limit::perMinute(8)->by($request->ip()));
        RateLimiter::for('api-auth', fn (Request $request) => Limit::perMinute(10)->by($request->ip()));
        RateLimiter::for('ai-chat', fn (Request $request) => Limit::perMinute(12)->by((string) optional($request->user())->id ?: $request->ip()));

        // Site settings + categories are needed on every page (header/footer),
        // so we inject them via a composer instead of every controller.
        View::composer(['components.header', 'components.footer', 'contact'], function ($view) {
            $view->with('settings', SiteSetting::current());
        });

        View::composer('components.footer', function ($view) {
            $view->with('footerCategories', Category::orderBy('name')->get());
        });
    }
}
