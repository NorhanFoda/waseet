<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    protected $fillable = [
        'user_id', 'saveRef_id', 'saveRef_type',
    ];

    public function saveRef(){
        return $this->morphTo(__FUNCTION__, 'saveRef_type', 'saveRef_id');
    }
}
