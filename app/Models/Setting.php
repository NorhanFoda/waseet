<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'welcome_text', 'header_logo', 'text_before_add',
        'text_after_add', 'text_after_add_image', 'sestion_1_title',
        'sestion_1_text', 'sestion_2_title', 'sestion_2_text', 
        'sestion_3_title', 'sestion_3_text', 'footer_text', 
        'footer_logo', 'contact_us_title', 'contact_us_text',
        'saved_title', 'saved_text',
    ];
}
