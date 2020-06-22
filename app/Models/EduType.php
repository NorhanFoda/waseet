<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EduType extends Model
{
    protected $fillable = ['type_ar', 'type_en', 'other'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
