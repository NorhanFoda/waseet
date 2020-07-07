<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\StaticPage;

class HomeController extends Controller
{
    public function index(){
        $lang = \App::getLocale();

        $set = Setting::find(1);

        $header_title = $set->{'text_after_add_'.$lang};
        $header_image = $set->text_after_add_image;

        $search_for_job_title = $set->{'section_1_text_'.$lang};
        $search_for_job_image = $set->section_1_image;

        $edu_bags_title = $set->{'section_3_text_'.$lang};
        $edu_bags_image = $set->section_3_image;

        $teacher_text = $set->section_2_image;

        $about_waseet_text = trans('api.about_waseet_text');
        $about_waseet_image = $set->text_after_add_image;

        return response()->json([
            'header_title' => $header_title,
            'header_image' => $header_image,
            'search_for_job_title' => $search_for_job_title,
            'search_for_job_image' => $search_for_job_image,
            'edu_bags_title' => $edu_bags_title,
            'edu_bags_image' => $edu_bags_image,
            'teacher_text' => $teacher_text,
            'about_waseet_text' => $about_waseet_text,
            'about_waseet_image' => $about_waseet_image,
        ], 200);
    }
}
