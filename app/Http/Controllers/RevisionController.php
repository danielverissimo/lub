<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use App\Repositories\RevisionRepositoryInterface;
use App\Repositories\TweetRepositoryInterface;
use App\Traits\CrudTrait;

class RevisionController extends Controller
{

    use CrudTrait;

    protected $gridModel = Revision::class;
    protected $revisions;

    protected $prefix = 'revisions';


    /**
     * Create a new controller instance.
     *
     * @param TweetRepositoryInterface $tweets
     */
    public function __construct(RevisionRepositoryInterface $revisions)
    {
        $this->init($revisions);
        $this->revisions = $revisions;
        $this->middleware('auth');
    }
}