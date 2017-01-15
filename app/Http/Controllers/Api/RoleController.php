<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\User\RoleServiceInterface;
use App\Traits\CrudTraitApi;

class RoleController extends Controller
{

    use CrudTraitApi;

    protected $service;
    /**
     * Create a new controller instance.
     *
     * @param RoleServiceInterface $users
     */
    public function __construct(\App\Services\RoleServiceInterface $service)
    {
        $this->service = $service;

        $this->middleware('auth:api');

    }
}