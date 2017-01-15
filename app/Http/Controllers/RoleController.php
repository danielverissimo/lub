<?php

namespace App\Http\Controllers;

use App\Role;
use App\Repositories\RoleRepositoryInterface;
use App\Services\RoleServiceInterface;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{

    use CrudTrait;

    protected $gridModel = Role::class;
    protected $roles;
    protected $service;

    protected $prefix = 'roles';


    /**
     * Create a new controller instance.
     *
     * @param RoleRepositoryInterface $roles
     */
    public function __construct(RoleRepositoryInterface $roles, RoleServiceInterface $service)
    {
        $this->init($roles);
        $this->roles = $roles;
        $this->service = $service;
        $this->middleware('auth');
    }

    public function permissions($roleId)
    {
        $role = $this->service->find($roleId);

        return response()
            ->json([
                'model' => $role->permissions
            ]);
    }

    public function addRolePermission($roleId)
    {
        $role = $this->service->find($roleId);
        $role->permissions()->attach(Input::get('permissions'));

        return response()
            ->json([
                'model' => $role->permissions
            ]);
    }

    public function removeRolePermission($roleId)
    {
        $role = $this->service->find($roleId);
        $role->permissions()->detach(Input::get('permissions'));

        return response()
            ->json([
                'model' => $role->permissions
            ]);
    }
}