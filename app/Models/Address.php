<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Country;
use App\Models\City;

class Address extends Model
{
    protected $fillable = ['country_id', 'city_id', 'user_id', 'address', 'postal_code'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}