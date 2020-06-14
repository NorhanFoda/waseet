<?php

namespace App\Models;
use App\Models\Stage;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name_ar', 'name_en'];

    public function stages(){
        return $this->belongsToMany(Stage::class);
    }
}
