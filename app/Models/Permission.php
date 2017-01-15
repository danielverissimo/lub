<?php namespace App\Models;

use App\Traits\ModelTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    use ModelTrait;

    protected $gridColumns = [
        'id' => 'ID',
        'name' => 'Nome',
        'display_name' => 'Nome Apresentável',
        'description' => 'Descrição'
    ];

    protected $fillable = ['name', 'display_name', 'description'];

}