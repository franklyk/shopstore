<?php

namespace App\Providers;

use App\Listeners\MergeCartOnLogin;
use App\Models\Category;
use Illuminate\Auth\Events\Login;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
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
        if (app()->environment('local') === false) {
            URL::forceScheme('https');
        }

        View::composer('layouts.app', function ($view) {
            $categories = Category::with('children')
                ->whereNull('parent_id')
                ->get();

            $view->with('navCategories', $categories);
        });

        Event::listen(Login::class, function () {
            // dd('EVENTO LOGIN DISPARADO');
        });

        // Event::listen(Login::class, MergeCartOnLogin::class);
        Paginator::useBootstrapFive();
    }
}
