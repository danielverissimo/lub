<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use App\User;

/**
 * Created by PhpStorm.
 * User: danyelsanches
 * Date: 25/12/16
 * Time: 15:20
 */
class UserController extends Controller
{

    protected $service;
    /**
     * Create a new controller instance.
     *
     * @param UserRepositoryInterface $users
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;

    }

    public function getData()
    {

        $paginator = $this->service->listUsers();//\App\User::paginate(10);

        $columns = User::$gridColumns;

        return response()
            ->json([
                'model' => $paginator,
                'columns' => $columns
            ]);

        return response()
            ->json([
                'model' => $model,
                'columns' => $columns
            ]);
    }

}