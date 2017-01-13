<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Tweet extends Model
{
    use ModelTrait, RevisionableTrait;

    protected $gridColumns = [
        'id' => 'ID',
        'user.name' => 'User'
    ];

    protected $relationsLoading = ['user'];

    protected $fillable = ['title', 'body', 'count', 'date', 'user_id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    public function user(){
        return $this->belongsTo(User::class );
    }

    public function setDateAttribute($date){
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function getDateAttribute($date){
        return Carbon::parse($date)->format('d/m/Y');
    }
}
