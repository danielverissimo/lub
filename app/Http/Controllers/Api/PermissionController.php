<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\User\PermissionServiceInterface;
use App\Traits\CrudTraitApi;

class PermissionController extends Controller
{

    use CrudTraitApi;

    protected $service;
    /**
     * Create a new controller instance.
     *
     * @param PermissionServiceInterface $users
     */
    public function __construct(\App\Services\PermissionServiceInterface $service)
    {
        $this->service = $service;

        $this->middleware('auth:api');

    }
}