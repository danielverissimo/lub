<?php

namespace App\Providers;

use App\Repositories\TweetRepository;
use App\Services\TweetService;
use Illuminate\Support\ServiceProvider;

class TweetServiceProvider extends ServiceProvider
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

        $this->app->bind('\App\Repositories\TweetRepositoryInterface', function($app)
        {
            return new TweetRepository($app);
        });

        $this->app->bind('\App\Services\TweetServiceInterface', function($app)
        {
            return new TweetService(new TweetRepository($app));
        });

    }
}