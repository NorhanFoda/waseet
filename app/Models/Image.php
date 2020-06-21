<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path', 'imageRef_id', 'imageRef_type',
    ];

    public function imageRef(){
        return $this->morphTo();
    }
}
