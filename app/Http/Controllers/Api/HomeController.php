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
use Auth;
use App\Models\Save;
use App\Models\Rating;

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
            if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
                if(Auth::guard('api')->user()->hasRole('job_seeker') || Auth::guard('api')->user()->hasRole('organization')){

                    $jobs = Job::where('name_ar', 'LIKE', '%'.$request->token.'%')
                        ->orWhere('name_en', 'LIKE', '%'.$request->token.'%')
                        ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
                        ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
                        ->get();

                    return response()->json([
                        'data' => JobResource::collection($jobs),
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'data' => [],
                ], 200);
            }
        }
        else if($request->type == 'Teacher'){
            if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
                if(Auth::guard('api')->user()->hasRole('online_teacher') || Auth::guard('api')->user()->hasRole('organization') ||
                    Auth::guard('api')->user()->hasRole('direct_teacher') || Auth::guard('api')->user()->hasRole('student')){

                        $teachers = User::whereHas('roles', function($q) use ($request){
                            $q->where('name', 'online_teacher')->orWhere('name', 'direct_teacher');
                        })
                        ->where(function($query) use ($request){
                            $query->where('name', 'LIKE', '%'.$request->token.'%')
                            ->orWhere('email', 'LIKE', '%'.$request->token.'%')
                            ->orWhere('phone_main', 'LIKE', '%'.$request->token.'%')
                            ->orWhere('phone_secondary', 'LIKE', '%'.$request->token.'%')
                            ->orWhere('bio_ar', 'LIKE', '%'.$request->token.'%')
                            ->orWhere('bio_en', 'LIKE', '%'.$request->token.'%');
                        })
                        ->get();

                        return response()->json([
                            'data' => TeacherResource::collection($teachers),
                        ], 200);
                }
            }
            else{
                return response()->json([
                    'data' => [],
                ], 200);
            }
        }
    }

    // Save posts
    public function save(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                $this->validate($request, [
                    'type' => 'required|in:User,Bag,Job', 
                    'id' => 'required',
                ]);
        
                $save;
                $saved;
        
                if($request->type != 'User'){
                    $saved = Save::where('user_id', auth()->user()->id)->where('saveRef_id', $request->id)->where('saveRef_type', 'App\Models\\'.$request->type)->first();
                }
                else{
                    $saved = Save::where('user_id', auth()->user()->id)->where('saveRef_id', $request->id)->where('saveRef_type', 'App\\'.$request->type)->first();
                }
        
                if($saved != null){
                    $saved->delete();
                    return response()->json([
                        'success' => trans("web.deleted_from_saved")
                    ], 200);
                }
                else{
                    if($request->type != 'User'){
                        $save = Save::create([
                            'user_id' => auth()->user()->id,
                            'saveRef_id' => $request->id,
                            'saveRef_type' => 'App\Models\\'.$request->type
                        ]);
                    }
                    else{
                        if($request->id == 1){
                            return response()->json([
                                'error' => trans('api.wrong_item')
                            ], 400);
                        }
                        
                        $save = Save::create([
                            'user_id' => auth()->user()->id,
                            'saveRef_id' => $request->id,
                            'saveRef_type' => 'App\\'.$request->type
                        ]);
                    }
        
                    if($request->type == 'Job'){
                        $job = Job::find($request->id);
                        $job->saves()->save($save);
                        auth()->user()->saved_jobs()->save($save);
                    }
                    else if($request->type == 'Bag'){
                        $bag = Bag::find($request->id);
                        $bag->saves()->save($save);
                        auth()->user()->saved_bags()->save($save);
                    }
                    else if($request->type == 'User'){
                        $user = User::find($request->id);
                        $user->saves()->save($save);
                        auth()->user()->saved_teachers()->save($save);
                    }
        
                    return response()->json([
                        'success' => trans("web.added_to_saved")
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // Rate posts
    public function rate(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                $this->validate($request, [
                    'type' => 'required|in:User,Bag,Job', 
                    'id' => 'required',
                    'rate' => 'required|numeric',
                ]);

                $rate;

                if($request->type != 'User'){
                    $rating = Rating::where('user_id', auth()->user()->id)->where('rateRef_id', $request->id)->where('rateRef_type', 'App\Models\\'.$request->type)->first();
                }
                else{
                    $rating = Rating::where('user_id', auth()->user()->id)->where('rateRef_id', $request->id)->where('rateRef_type', 'App\\'.$request->type)->first();
                }

                if($rating != null){
                    $rating->update(['rate' => $request->rate]);
                    return response()->json([
                        'msg' => trans("web.rating_updated")
                    ], 200);
                }
                else{
                    if($request->type != 'User'){
                        $rate = Rating::create([
                            'user_id' => auth()->user()->id,
                            'rateRef_id' => $request->id,
                            'rateRef_type' => 'App\Models\\'.$request->type,
                            'rate' => $request->rate,
                        ]);
                        
                    auth()->user()->rated_bags()->save($rate);
                    }
                    else{
                        $rate = Rating::create([
                            'user_id' => auth()->user()->id,
                            'rateRef_id' => $request->id,
                            'rateRef_type' => 'App\\'.$request->type,
                            'rate' => $request->rate
                        ]);
                        auth()->user()->rated_teachers()->save($rate);

                    }

                    return response()->json([
                        'msg' => trans("web.rated")
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }
}
