<?php

namespace App\Providers;

use App\Http\Composers\CategoryComposer;
use App\Http\Composers\PermissionComposer;
use App\Http\Composers\ProductComposer;
use App\Http\Composers\RoleComposer;
use App\Http\Composers\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['roles.create', 'roles.edit'], PermissionComposer::class);
        View::composer(['users.index', 'users.create', 'users.edit', 'home'], RoleComposer::class);
        View::composer([
            'categories.index', 'categories.create', 'categories.edit',
            'products.create', 'products.edit', 'products.index',
            'home'
        ], CategoryComposer::class);
        View::composer(['home'], UserComposer::class);
        View::composer(['home'], ProductComposer::class);
    }
}
