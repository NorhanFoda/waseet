<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Video;
use App\Models\BagCategory;
use App\Models\Rating;
use App\Models\Save;

class Bag extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'description_ar',
        'description_en', 'price', 'conents_ar',
        'conents_en', 'benefits_ar', 'benefits_en',
        'category_id',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imagable');
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function category(){
        return $this->belongTo(BagCategory::class);
    }

    public function ratings(){
        return $this->morphMany(Rating::class, 'ratable');
    }
}
