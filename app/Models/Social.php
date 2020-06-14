<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['link', 'appear_in_footer'];

    public function images(){
        return $this->morphMany(Image::class, 'imagable');
    }
}
