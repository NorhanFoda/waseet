<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EduType extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
