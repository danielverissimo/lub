<?php

namespace App\Providers;

use App\Repositories\RevisionRepository;
use Illuminate\Support\ServiceProvider;

class RevisionServiceProvider extends ServiceProvider
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

        $this->app->bind('\App\Repositories\RevisionRepositoryInterface', function($app)
        {
            return new RevisionRepository($app);
        });

    }
}