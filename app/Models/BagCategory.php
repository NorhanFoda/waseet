<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Bag;

class BagCategory extends Model
{
    protected $fillable = [
        'name_ar', 'name_en',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imagable');
    }

    public function bags(){
        return $this->hasMany(Bag::class);
    }
}
