<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\Teachers\TeacherResource;
use App\Http\Resources\Teachers\TeacherProfileResource;
use Auth;

class TeacherController extends Controller
{
    // Get all teachers
    public function index(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            // only teachers, students and organizations can view list of teachers
            if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('student') || auth()->user()->hasRole('organization')){
                
                $teachers = User::with(['image', 'materials', 'ratings', 'nationality'])->whereHas('roles', function($q){
                    $q->where('name', 'direct_teacher')->orWhere('name', 'online_teacher');
                })->where('is_verified', 1)->get();
        
                return response()->json([
                    'data' => TeacherResource::collection($teachers),
                ], 200);
            }
            else{
                return response()->json([
                    'data' => trans('web.login_as_teacher_org_std')
                ], 200);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // View teacher profile only for auth users
    public function show($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){

                // only teachers, students and organizations can view teacher details
                if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('student') || auth()->user()->hasRole('organization')){
                    $teacher = User::with('image', 'materials', 'ratings', 'nationality', 'roles', 'edu_level')->find($id);
                    return response()->json([
                        'data' => new TeacherProfileResource($teacher)
                    ], 200);
                }
                else{
                    return response()->json([
                        'data' => trans('web.login_as_teacher_org_std')
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
