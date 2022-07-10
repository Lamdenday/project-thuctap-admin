<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::if('isPermission', function ($permission) {
            return Auth::user()->hasPermission($permission) || Auth::user()->isSuperAdmin();
        });

        Blade::if('hasRole', function ($role) {
            return auth()->user()->hasRole($role);
        });
    }
}
