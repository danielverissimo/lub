<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use ModelTrait;

    protected $fillable = ['title', 'body', 'count', 'date'];
}
