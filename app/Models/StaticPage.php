<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;

class StaticPage extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'short_description_ar',
        'short_description_en', 'full_description_ar', 
        'full_description_en', 'appear_in_footer',
        'vision_ar', 'vision_en',
        'message_ar' , 'message_ar',
    ];

    public function goals(){
        return $this->hasMany(Goal::class);
    }
}
