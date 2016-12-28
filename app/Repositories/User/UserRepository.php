<?php namespace App\Repositories\User;

use App\Traits\Firework\CrudTrait;

class UserRepository implements UserRepositoryInterface {

    use CrudTrait;

    public function listUsers(){

        return $this->findAllPaginated();
    }

}