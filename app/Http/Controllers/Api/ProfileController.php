<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Resources\Bags\SavedBagResource;
use App\Http\Resources\Teachers\SavedTeacherResource;
use App\Http\Resources\Job\SavedJobResource;
use App\Http\Resources\User\SeekerResource;

class ProfileController extends Controller
{
    // View job seeker CV
    public function getCV(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
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

    // get saved posts of auth user
    public function getSavedPosts(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
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

    // Update auth user personal info
    public function updatePersonalInfo(Request $request){

        $this->validate($request, [
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        auth()->user()->update($request->all());

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
}
