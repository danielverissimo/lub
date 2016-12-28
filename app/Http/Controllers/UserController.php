<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    use CrudTrait{
        store as storeFromTrait;
        update as updateFromTrait;
        grid as gridFromTrait;
    }

    protected $gridModel = User::class;
    protected $users;
    protected $service;

    protected $prefix = 'users';

    /**
     * Create a new controller instance.
     *
     * @param UserRepositoryInterface $users
     */
    public function __construct(UserRepositoryInterface $users, UserServiceInterface $service)
    {
        $this->init($users);
        $this->users = $users;
        $this->service = $service;
        $this->middleware('auth');

    }

    public function index(){

        $paginator = $this->service->listUsers();//\App\User::paginate(10);
        return view('users.index')->with('paginator', $paginator)->with('items', $this->service->findAll());
    }

    public function store(){

        $input['password'] = Hash::make(Input::get('password'));
        request()->merge($input);
        return $this->storeFromTrait($input);

    }

    public function getGrid()
    {

        $paginator = $this->grid();

        return response()
            ->json([
                'model' => $paginator,
                'columns' => User::$gridColumns
            ]);
    }

}
