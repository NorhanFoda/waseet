<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Resources\Bags\SavedBagResource;
use App\Http\Resources\Teachers\SavedTeacherResource;
use App\Http\Resources\Job\SavedJobResource;
use App\Http\Resources\User\SeekerResource;
use App\Http\Resources\Teachers\MaterialResource;
use App\Http\Requests\User\UpdatePersonalInfoProfileRequest;
use App\Models\Stage;
use App\Models\EduLevel;
use App\Models\EduType;
use App\Models\Material;
use App\Models\Nationality;
use App\User;

class ProfileController extends Controller
{
    // View job seeker CV
    public function getCV(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                if(auth()->user()->hasRole('job_seeker') && !auth()->user()->hasRole('admin')){
                    return response()->json([
                        'data' => new SeekerResource(auth()->user())
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('web.no_cv_uploaded')
                    ], 404);
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

    // get saved posts of auth user
    public function getSavedPosts(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                return response()->json([
                    'jobs'=> SavedJobResource::collection(auth()->user()->saved_jobs),
                    'teachers' => SavedTeacherResource::collection(auth()->user()->saved_teachers),
                    'bags' => SavedBagResource::collection(auth()->user()->saved_bags),
                ], 200);
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

    //get edit personal info data
    public function getEditPersonalInfoData(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                return response()->json([
                    'user' => User::with('image', 'document', 'stage', 'materials', 'edu_level', 'edu_type', 'nationality', 'addresses')->find(auth()->user()->id),
                    'stages' => MaterialResource::collection(Stage::all()),
                    'materials' => MaterialResource::collection(Material::all()),
                    'nationalities' => MaterialResource::collection(Nationality::all()),
                    'edu_levels' => MaterialResource::collection(EduLevel::all()),
                    'edu_types' => MaterialResource::collection(EduType::all()),
                ]);
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

    // Update auth user personal info
    public function updatePersonalInfo(UpdatePersonalInfoProfileRequest $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
        
                auth()->user()->update($request->all());
                auth()->user()->update(['salary_month' => $request->salary]);
        
                if((auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher')) && $request->has('material_ids')){
                    foreach($request->material_ids as $id){
                        auth()->user()->materials()->sync($id);
                    }
                }
        
                if(auth()->user()->hasRole('job_seeker')){
                    if($request->has('cv')){
                        $removed = Upload::deletePDF(auth()->user()->document->path);
                        if($removed){
                            $new_cv = Upload::uploadPDF($request->cv);
                            auth()->user()->document->update([
                                'path' => $new_cv
                            ]);
                        }
                        else{
                            return response()->json([
                                'error' => trans('admin.error')
                            ], 404);
                        }
                    }
                }
        
                if($request->has('image')){  
                    if(auth()->user()->image != null)          {
                        $removed = Upload::deleteImage(auth()->user()->image->path);
                        if($removed){
                            $new_image = Upload::uploadImage($request->image);
                            auth()->user()->image->update([
                                'path' => $new_image
                            ]);
                        }
                        else{
                            return response()->json([
                                'error' => trans('admin.error')
                            ], 404);
                        }
                    }
                    else{
                        $image_url = Upload::uploadImage($request->image);
                        $image = Image::create([
                            'path' => $image_url,
                            'imageRef_id' => Auth()->user()->id,
                            'imageRef_type' => 'App\User'
                        ]);
                        auth()->user()->image()->save($image);
                    }
                }
        
                return response()->json([
                    'success' => trans('web.personal_info_updated')
                ], 200);
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
