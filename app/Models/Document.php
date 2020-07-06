<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Document extends Model
{
    protected $fillable = ['doucmentRef_id', 'path', 'doucmentRef_type'];

    public function doucmentRef(){
        return $this->morphTo(__FUNCTION__, 'doucmentRef_type', 'doucmentRef_id');
    }
}
