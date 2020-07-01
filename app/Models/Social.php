<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['link', 'appear_in_footer'];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }
}
