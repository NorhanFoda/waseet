<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Country;
use App\Models\Job;
use App\Models\Address;


class City extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'country_id'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function jobs(){
        return $this->belongsToMany(Job::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
