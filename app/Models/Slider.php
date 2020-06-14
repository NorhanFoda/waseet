<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Slider extends Model
{
    protected $fillable = [
        'title', 'body',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imagable');
    }
}
