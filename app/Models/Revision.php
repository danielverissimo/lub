<?php

namespace App\Models;

use App\Traits\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Revision extends Model
{
    use ModelTrait;

    protected $gridColumns = [
        'id' => 'ID',
        'revisionable_type' => 'Revision Type',
        'revisionable_id' => 'Revision',
        'user.name' => 'User',
        'key' => 'Key',
        'old_value' => 'Old Value',
        'new_value'=> 'New Value',
        'updated_at' => 'Updated At'
    ];

    protected $relationsLoading = ['user'];

    protected $fillable = ['user_id'];

    public function user(){
        return $this->belongsTo(User::class );
    }
}
