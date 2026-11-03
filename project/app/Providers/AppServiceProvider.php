<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
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
