<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\User\TweetServiceInterface;
use App\Traits\CrudTraitApi;

class TweetController extends Controller
{

    use CrudTraitApi;

    protected $service;
    /**
     * Create a new controller instance.
     *
     * @param TweetServiceInterface $users
     */
    public function __construct(\App\Services\TweetServiceInterface $service)
    {
        $this->service = $service;

        $this->middleware('auth:api');

    }
}