<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Video;
use App\Models\BagCategory;
use App\Models\Rating;
use App\Models\Save;
use App\Models\BagContent;

class Bag extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'description_ar',
        'description_en', 'price', 'contents_ar',
        'contents_en', 'benefits_ar', 'benefits_en',
        'bag_category_id',
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }

    public function video(){
        return $this->hasOne(Video::class);
    }

    public function category(){
        return $this->belongsTo(BagCategory::class, 'bag_category_id');
    }

    public function ratings(){
        return $this->morphMany(Rating::class, 'rateRef');
    }

    public function contents(){
        return $this->hasMany(BagContent::class);
    }
}
