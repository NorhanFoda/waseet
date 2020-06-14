<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    protected $fillable = [
        'user_id', 'model_id', 'model_type',
    ];

    public function savable(){
        return $this->morphTo();
    }
}
