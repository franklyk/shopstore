<?php

namespace App\Providers;

use App\Models\Address;
use App\Listeners\MergeCartOnLogin;
use App\Models\Category;
use App\Policies\AddressPolicy;
use Illuminate\Auth\Events\Login;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
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
        // ================================//
        // Force HTTPS                    //
        // ================================//

        if (! app()->environment('local')) {
            URL::forceScheme('https');
        }

        // ================================//
        // Super Admin Bypass             //
        // ================================//

        Gate::before(function ($user, $ability) {

            return $user->hasRole('super-admin')
                ? true
                : null;

        });

        // ================================//
        // Global Categories              //
        // ================================//

        View::composer('layouts.store', function ($view) {

            $categories = Category::with('children')
                ->whereNull('parent_id')
                ->get();

            $view->with('navCategories', $categories);

        });

        View::composer('layouts.partials.headers.*', function ($view) {

            $menuCategories = Category::with('children')
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            $view->with('menuCategories', $menuCategories);
        });

        // ================================//
        // Cart Merge On Login            //
        // ================================//

        Event::listen(Login::class, MergeCartOnLogin::class);

        // ================================//
        // Address Policy                  //
        // ================================//
        Gate::policy(Address::class, AddressPolicy::class);

        // ================================//
        // Supplier Policy                 //
        // ================================//
        Gate::policy(Supplier::class, SupplierPolicy::class);

        // ================================//
        // Pagination                     //
        // ================================//

        Paginator::useBootstrapFive();
    }
}
