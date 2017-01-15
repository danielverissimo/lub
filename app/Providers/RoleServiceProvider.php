<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Services\RoleService;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
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

        $this->app->bind('\App\Repositories\RoleRepositoryInterface', function($app)
        {
            return new RoleRepository($app);
        });

        $this->app->bind('\App\Services\RoleServiceInterface', function($app)
        {
            return new RoleService(new RoleRepository($app));
        });

    }
}