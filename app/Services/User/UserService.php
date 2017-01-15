<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ServiceTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class UserService implements UserServiceInterface
{
    use ServiceTrait{
        store as storeFromTrait;
    }

    public $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
    ];

    public function __construct(UserRepositoryInterface $users)
    {
        $this->items = $users;
    }

    public function listUsers(){
        return $this->items->listUsers();
    }

    public function store($id, $input){

        $messages = new MessageBag();

        Validator::make($input, [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ]
        ])->validate();

        return [$messages, $this->items->store($id, $input)];
    }
}