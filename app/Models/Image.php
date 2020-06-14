<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path', 'model_id', 'model_type',
    ];

    public function imagable(){
        return $this->morphTo();
    }
}
