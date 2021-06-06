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
use App\Http\Resources\User\editProfileResource;
use App\Http\Resources\Roles\RoleResource;
use Illuminate\Support\Facades\Hash;
use App\Models\Stage;
use App\Models\EduLevel;
use App\Models\EduType;
use App\Models\Material;
use App\Models\Nationality;
use App\Classes\Upload;
use App\Models\Image;
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
                    // 'user' => User::with('image', 'document', 'stage', 'materials', 'edu_level', 'edu_type', 'nationality', 'addresses', 'roles')->find(auth()->user()->id),
                    'user' => new editProfileResource(auth()->user()),
                    'roles' => RoleResource::collection(auth()->user()->roles),
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
                    auth()->user()->materials()->sync($request->material_ids);

                    foreach($request->material_ids as $id){
                        // auth()->user()->materials()->sync($id);
                        if($id == 4){
                            auth()->user()->materials()->where('material_id', 4)->first()->pivot->update(['other_material' => $request->other_material]);
                        }
                    }
                }
        
                if(auth()->user()->hasRole('job_seeker')){
                    if($request->has('cv')){

                        if(auth()->user()->document){

                            $removed = Upload::deletePDF(auth()->user()->document->path);
                        }
                        
                        $new_cv = Upload::uploadPDF($request->cv);
                        auth()->user()->document->update([
                            'path' => $new_cv
                        ]);
                    }
                }
        
                if($request->has('image')){  
                    if(auth()->user()->image != null)          {
                        $removed = Upload::deleteImage(auth()->user()->image->path);
                        // if($removed){
                            $new_image = Upload::uploadImage($request->image);
                            auth()->user()->image->update([
                                'path' => $new_image
                            ]);
                        // }
                        // else{
                        //     return response()->json([
                        //         'error' => trans('admin.error')
                        //     ], 404);
                        // }
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
                    'success' => trans('web.personal_info_updated'),
                    'image' => auth()->user()->image != null ? auth()->user()->image->path : 'http://waset-elmo3lm.jadara.work/web/images/man.png'
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

    public function updateCV(Request $request){
        $this->validate($request, [
            'cv' => 'required|mimetypes:application/pdf|max:10000',
        ]);

        if(auth()->user()->document){

            $removed = Upload::deletePDF(auth()->user()->document->path);
        }
        
        $new_cv = Upload::uploadPDF($request->cv);
        auth()->user()->document->update([
            'path' => $new_cv
        ]);

        return response()->json([
            'success' => trans('admin.updated')
        ], 200);

    }

    public function changePassword(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){

                $this->validate($request, [
                    'password' => 'required|min:9|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'required|min:9',
                ]);
        
                $user = auth()->user();
                if($user == null){
                    return response()->json([
                        'error' => trans('api.email_not_found'),
                    ], 400);
                }
        
                if($user->is_verified == 0){
                    return response()->json([
                        'error' => trans('api.email_not_verified'),
                    ], 400);
                }
        
                $user->update(['password' => Hash::make($request->password)]);
                return response()->json([
                    'data' => trans('api.password_changed'),
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
