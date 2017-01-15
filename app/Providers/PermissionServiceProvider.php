<?php

namespace App\Providers;

use App\Repositories\PermissionRepository;
use App\Services\PermissionService;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('\App\Repositories\PermissionRepositoryInterface', function($app)
        {
            return new PermissionRepository($app);
        });

        $this->app->bind('\App\Services\PermissionServiceInterface', function($app)
        {
            return new PermissionService(new PermissionRepository($app));
        });

    }
}