<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'phone', 'email', 'location_ar', 'location_en',
        
        'welcome_text_ar',
        'welcome_text_en',

        'header_logo',

        'text_before_add_ar',
        'text_before_add_en',

        'text_after_add_ar',
        'text_after_add_en',

        'text_after_add_image',

        'section_1_image',

        'section_1_title_ar',
        'section_1_title_en',

        'section_1_text_ar',
        'section_1_text_en',

        'step_1_image',

        'step_1_title_ar',
        'step_1_title_en',

        'step_1_text_ar',
        'step_1_text_en',

        'step_2_image',

        'step_2_title_ar',
        'step_2_title_en',

        'step_2_text_ar',
        'step_2_text_en',

        'step_3_image',

        'step_3_title_ar',
        'step_3_title_en',

        'step_3_text_ar',
        'step_3_text_en',

        'section_2_image',

        'section_2_title_ar',
        'section_2_title_en',

        'section_2_text_ar',
        'section_2_text_en',

        'section_3_image',

        'section_3_title_ar',
        'section_3_title_en',

        'section_3_text_ar',
        'section_3_text_en',

        'footer_text_ar',
        'footer_text_en',

        'footer_logo',

        'contact_us_title_ar',
        'contact_us_title_en',

        'contact_us_text_ar',
        'contact_us_text_en',

        'saved_title_ar',
        'saved_title_en',
        
        'saved_text_ar',
        'saved_text_en',

        'online_teacher_image',

        'online_teacher_title_ar',
        'online_teacher_title_en',

        'online_teacher_text_ar',
        'online_teacher_text_en',

        'direct_teacher_image',

        'direct_teacher_title_ar',
        'direct_teacher_title_en',
        
        'direct_teacher_text_ar',
        'direct_teacher_text_en',
    ];
}
