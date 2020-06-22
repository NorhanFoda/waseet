<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bag;

class Video extends Model
{
    protected $fillable = ['path', 'bag_id', 'poster'];

    public function bag(){
        return $this->belongsto(Bag::class);
    }
}
