<?php

namespace App\Providers;

use App\Models\MenuGroup;
use App\Models\MenuNavigation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
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
        Schema::defaultMorphKeyType('uuid');

        RateLimiter::for('subscription-emails', function () {
            return Limit::perMinute(60);
        });

        RateLimiter::for('ticketing', function () {
            return Limit::perMinute(120);
        });

        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super_admin')) {
                return true;
            }
        });

        // Share menu data to all views
        View::composer('*', function ($view) {
            $menuGroups = MenuGroup::with(['menu_navigations' => function ($query) {
                $query->where('is_active', true)->orderBy('order')->orderBy('id');
            }])->orderBy('order')->orderBy('id')->get();

            // Create uncategorized group for menu items without group
            $uncategorizedMenus = MenuNavigation::where('is_active', true)
                ->whereNull('menu_group_id')
                ->orderBy('order')
                ->orderBy('id')
                ->get();

            $view->with(compact('menuGroups', 'uncategorizedMenus'));
        });
    }
}
