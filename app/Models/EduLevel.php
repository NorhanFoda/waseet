<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EduLevel extends Model
{
    protected $fillable = ['level_ar', 'level_en', 'other'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
