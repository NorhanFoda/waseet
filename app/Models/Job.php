<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Save;
use App\Models\City;
use App\Models\Country;
use User;

class Job extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'work_hours',
        'exper_years', 'address', 'required_number',
        'free_places', 'description_ar', 'description_en',
        // 'organization_name', 'organization_phone', 'organization_email',
        'required_age', 'salary', 'country_id', 'user_id',
    ];

    public function images(){
        return $this->morphMany(Image::class, 'imageRef');
    }

    public function applicants(){
        return $this->belongsToMany(User::class);
    }

    public function announcer(){
        return $this->belongsTo(User::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
