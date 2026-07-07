<?php

namespace App\Providers;

use App\Listeners\MergeCartOnLogin;
use App\Models\Catalog\Category;
use App\Models\Supplier\Supplier;
use App\Models\User\Address;
use App\Policies\AddressPolicy;
use App\Policies\SupplierPolicy;
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

        View::composer([
            'layouts.store',
            'components.layout.store.header',
        ], function ($view) {

            $categories = Category::query()
                ->whereHas('status', function ($query) {
                    $query->where('domain', 'category')
                        ->where('slug', 'active');
                })
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('name')
                ->get();

            $view->with('menuCategories', $categories);
        });

        View::composer([
            'layouts.store',
            'components.layout.profile.header',
        ], function ($view) {

            $categories = Category::query()
                ->whereHas('status', function ($query) {
                    $query->where('domain', 'category')
                        ->where('slug', 'active');
                })
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('name')
                ->get();

            $view->with('menuCategories', $categories);
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
