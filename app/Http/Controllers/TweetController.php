<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\Repositories\TweetRepositoryInterface;
use App\Services\TweetServiceInterface;
use App\Traits\CrudTrait;

class TweetController extends Controller
{

    use CrudTrait;

    protected $gridModel = Tweet::class;
    protected $tweets;
    protected $service;

    protected $prefix = 'tweets';


    /**
     * Create a new controller instance.
     *
     * @param TweetRepositoryInterface $tweets
     */
    public function __construct(TweetRepositoryInterface $tweets, TweetServiceInterface $service)
    {
        $this->init($tweets);
        $this->tweets = $tweets;
        $this->service = $service;
        $this->middleware('auth');

    }
}