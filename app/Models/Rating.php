<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rate', 'user_id', 'model_id', 'model_type'];

    public function ratable(){
        return $this->morphTo();
    }
}
