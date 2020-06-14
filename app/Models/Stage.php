<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Stage extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

    public function materials(){
        return $this->belongsToMany(Material::class);
    }

}
