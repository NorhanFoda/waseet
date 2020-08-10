<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rate', 'user_id', 'rateRef_id', 'rateRef_type'];

    public function rateRef(){
        return $this->morphTo(__FUNCTION__, 'rateRef_type', 'rateRef_id');
    }
}
