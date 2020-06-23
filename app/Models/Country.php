<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\City;
use App\Models\Job;

class Country extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
