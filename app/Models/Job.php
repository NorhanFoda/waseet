<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Save;
use App\Models\City;
use App\Models\Country;
use App\Models\Specialization;
use App\User;

class Job extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'work_hours',
        'exper_years', 'required_number',
        'free_places', 'description_ar', 'description_en', 'approved',
        'required_age', 'salary', 'country_id', 'user_id', 'city_id', 
        // 'address',
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageRef');
    }

    public function applicants(){
        return $this->belongsToMany(User::class);
    }

    public function announcer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function cities(){
    //     return $this->belongsToMany(City::class);
    // }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function saves(){
        return $this->morphMany(Save::class, 'saveRef');
    }

    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }
}
