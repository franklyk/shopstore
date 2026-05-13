<?php

namespace App\Providers;

use App\Listeners\MergeCartOnLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
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

        Event::listen(Login::class, function () {
            // dd('EVENTO LOGIN DISPARADO');
        });
        // Event::listen(Login::class, MergeCartOnLogin::class);
        Paginator::useBootstrapFive();
    }
}
