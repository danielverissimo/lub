<?php namespace App\Models;

use App\Traits\ModelTrait;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    use ModelTrait;

    protected $gridColumns = [
        'id' => 'ID',
        'name' => 'Nome',
        'display_name' => 'Nome Apresentável',
        'description' => 'Descrição'
    ];

    protected $fillable = ['name', 'display_name', 'description'];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function permissions(){
        return $this->belongsToMany('App\Models\Permission');
    }
}