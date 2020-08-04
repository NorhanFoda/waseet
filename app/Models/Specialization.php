<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Specialization extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
