<?php

namespace App\Services;

use App\Repositories\PermissionRepositoryInterface;
use App\Traits\ServiceTrait;

class PermissionService implements PermissionServiceInterface
{
    use ServiceTrait;

    public $rules = [
        'name' => 'required|unique:permissions,name,{id}',
    ];

    public function __construct(PermissionRepositoryInterface $permissions)
    {
        $this->items = $permissions;
    }

}