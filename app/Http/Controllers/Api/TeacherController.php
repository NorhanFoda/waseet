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
        $teachers = User::with(['image', 'materials', 'ratings', 'nationality'])->whereHas('roles', function($q){
            $q->where('name', 'direct_teacher')->orWhere('name', 'online_teacher');
        })->get();

        return response()->json([
            'data' => TeacherResource::collection($teachers),
        ], 200);
    }

    // View teacher profile only for auth users
    public function show($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                $teacher = User::with('image', 'materials', 'ratings', 'nationality', 'roles', 'edu_level')->find($id);
                return response()->json([
                    'data' => new TeacherProfileResource($teacher)
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
