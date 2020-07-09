<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Video;
use App\Models\BagCategory;
use App\Models\Rating;
use App\Models\Save;
use App\Models\BagContent;
use App\Models\Cart;

class Bag extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'description_ar',
        'description_en', 'price', 'contents_ar',
        'contents_en', 'benefits_ar', 'benefits_en',
        'bag_category_id', 'image', 'video', 'poster',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imageRef');
    }

    public function videos(){
        return $this->morphMany(Video::class, 'videoRef');
    }

    public function documents(){
        return $this->morphMany(Document::class, 'doucmentRef');
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

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
