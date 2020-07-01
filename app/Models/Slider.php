<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Slider extends Model
{
    protected $fillable = [
        'title_ar', 'title_en', 'body_ar', 'body_en'
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }
}
