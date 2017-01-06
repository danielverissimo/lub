<?php namespace App\Repositories\User;

use App\Traits\Firework\CrudTrait;
use App\Traits\Firework\RepositoryCrudTrait;

class UserRepository implements UserRepositoryInterface {

    use RepositoryCrudTrait;

    public function listUsers(){

        return $this->findAllPaginated();
    }

}