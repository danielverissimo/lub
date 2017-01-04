<?php

namespace App\Services;

use App\Repositories\TweetRepositoryInterface;
use App\Traits\ServiceTrait;

class TweetService implements TweetServiceInterface
{
    use ServiceTrait;

    public $rules = [
        'title' => 'required',
        'user_id' => 'required'
    ];

    public function __construct(TweetRepositoryInterface $tweets)
    {
        $this->items = $tweets;
    }

}