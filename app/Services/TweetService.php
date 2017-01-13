<?php

namespace App\Services;

use App\Repositories\TweetRepositoryInterface;
use App\Traits\ServiceTrait;

class TweetService implements TweetServiceInterface
{
    use ServiceTrait;

    public $rules = [
        'user_id' => 'required',
        'title'   => 'required|startsWith:t|lowercase'
    ];

    const startsWithRule = 't';

    public function __construct(TweetRepositoryInterface $tweets)
    {
        $this->items = $tweets;
    }

}