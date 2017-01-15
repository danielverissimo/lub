<?php

namespace App\Services;

use App\Repositories\RoleRepositoryInterface;
use App\Traits\ServiceTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class RoleService implements RoleServiceInterface
{

    use ServiceTrait{
        rules as rulesFromTrait;
    }

    public $rules = [
            'name' => 'required|unique:roles,name,{id}',
    ];

    public function __construct(RoleRepositoryInterface $roles)
    {
        $this->items = $roles;
    }
}