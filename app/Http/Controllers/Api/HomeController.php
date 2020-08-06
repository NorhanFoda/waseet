<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\StaticPage;
use App\Models\Slider;
use App\Http\Resources\Slider\SliderResource;
use App\Http\Resources\Teachers\TeacherResource;
use App\Http\Resources\Job\JobResource;
use App\Http\Resources\Bags\BagResource;
use App\Models\Bag;
use App\Models\Job;
use App\User;

class HomeController extends Controller
{
    public function index(){
        $lang = \App::getLocale();

        $set = Setting::find(1);

        $search_for_job_title = $set->{'section_1_text_'.$lang};
        $search_for_job_image = $set->section_1_image;

        $edu_bags_title = $set->{'section_3_text_'.$lang};
        $edu_bags_image = $set->section_3_image;

        $teacher_text = $set->{'section_2_text_'.$lang};
        $teacher_image = $set->section_2_image;

        $about_waseet_text = trans('api.about_waseet_text');
        $about_waseet_image = $set->text_after_add_image;

        $slider = Slider::with('image')->where('type', 'mobile')->get();

        return response()->json([
            'search_for_job_title' => $search_for_job_title,
            'search_for_job_image' => $search_for_job_image,
            'edu_bags_title' => $edu_bags_title,
            'edu_bags_image' => $edu_bags_image,
            'teacher_text' => $teacher_text,
            'teacher_image' => $teacher_image,
            'about_waseet_text' => $about_waseet_text,
            'about_waseet_image' => $about_waseet_image,
            'slider' => SliderResource::collection($slider)
        ], 200);
    }

    // search
    public function search(Request $request){
        $this->validate($request, ['token' => 'required', 'type' => 'required|in:Bag,Job,Teacher']);

        // search in bags
        if($request->type == 'Bag'){
            $bags = Bag::where('name_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('name_en', 'LIKE', '%'.$request->token.'%')
                ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('contents_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('contents_en', 'LIKE', '%'.$request->token.'%')
                ->orWhere('benefits_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('benefits_en', 'LIKE', '%'.$request->token.'%')
                ->get();

            return response()->json([
                'data' => BagResource::collection($bags),
            ], 200);
        }
        else if($request->type == 'Job'){
            $jobs = Job::where('name_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('name_en', 'LIKE', '%'.$request->token.'%')
                ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
                ->get();

            return response()->json([
                'data' => JobResource::collection($jobs),
            ], 200);
        }
        else if($request->type == 'Teacher'){
            $teachers = User::where('name', 'LIKE', '%'.$request->token.'%')
                ->orWhere('email', 'LIKE', '%'.$request->token.'%')
                ->orWhere('phone_main', 'LIKE', '%'.$request->token.'%')
                ->orWhere('phone_secondary', 'LIKE', '%'.$request->token.'%')
                ->orWhere('bio_ar', 'LIKE', '%'.$request->token.'%')
                ->orWhere('bio_en', 'LIKE', '%'.$request->token.'%')
                ->get();

            return response()->json([
                'data' => TeacherResource::collection($teachers),
            ], 200);
        }
    }
}
