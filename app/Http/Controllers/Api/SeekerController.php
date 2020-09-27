<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Http\Resources\Seeker\SeekerResource;
use App\Http\Resources\User\editProfileResource;
use App\Http\Resources\Roles\RoleResource;

class SeekerController extends Controller
{
    public function index(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            //only organization cat view list of seekers
            if(auth()->user()->hasRole('organization')){
                $seekers = User::with(['image', 'document'])->whereHas('roles', function($q){
                    $q->where('name', 'job_seeker')->where('name', '!=', 'admin');
                })->where('is_verified', 1)->get();

                return response()->json([
                    'seekers' => SeekerResource::collection($seekers)
                ], 200);
            }
            else{
                return response()->json([
                    'data' => trans('web.login_as_org')
                ], 200);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function getSeekerData($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            // only organization can view seeker details
            if(auth()->user()->hasRole('organization')){

                $user = User::find($id);

                if($user == null){
                    return response()->json([
                        'error' => trans('api.user_not_exsite')
                    ], 400);
                }
                
                if(!$user->hasRole('job_seeker')){
                    return response()->json([
                        'error' => trans('api.invalid_seeker')
                    ], 400);
                }

                return response()->json([
                    'user' => new editProfileResource($user),
                    'roles' => RoleResource::collection(auth()->user()->roles),
                ]);

            }
            else{
                return response()->json([
                    'error' => trans('web.login_as_org')
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
