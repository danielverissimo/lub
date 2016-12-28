<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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

        $this->app->bind('\App\Repositories\User\UserRepositoryInterface', function($app)
        {
            return new UserRepository($app);
        });

        $this->app->bind('\App\Services\User\UserServiceInterface', function($app)
        {
            return new UserService(new UserRepository($app));
        });

    }
}
