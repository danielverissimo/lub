<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Repositories\PermissionRepositoryInterface;
use App\Services\PermissionServiceInterface;
use App\Traits\CrudTrait;

class PermissionController extends Controller
{

    use CrudTrait;

    protected $gridModel = Permission::class;
    protected $permissions;
    protected $service;

    protected $prefix = 'permissions';


    /**
     * Create a new controller instance.
     *
     * @param PermissionRepositoryInterface $permissions
     */
    public function __construct(PermissionRepositoryInterface $permissions, PermissionServiceInterface $service)
    {
        $this->init($permissions);
        $this->permissions = $permissions;
        $this->service = $service;
        $this->middleware('auth');

    }
}