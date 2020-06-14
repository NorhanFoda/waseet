<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'short_description_ar',
        'short_description_en', 'full_description_ar', 
        'full_description_en', 'appear_in_footer',
    ];
}
