<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bag;

class Video extends Model
{
    protected $fillable = ['path', 'videoRef_id', 'poster', 'videoRef_type'];

    public function videoRef(){
        return $this->morphTo();
    }
}
