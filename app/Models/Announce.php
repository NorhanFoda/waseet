<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    protected $fillable = ['appear_in_home', 'link'];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }
}
