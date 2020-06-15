<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Country;
use App\Models\Job;


class City extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'country_id'];

    public function users(){
        return $this->hansMany(User::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function jobs(){
        return $this->belongsToMany(Job::class);
    }
}
