<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\Teachers\TeacherResource;

class TeacherController extends Controller
{
    public function index(){
        $teachers = User::with(['image', 'materials', 'ratings', 'nationality'])->whereHas('roles', function($q){
            $q->where('name', 'direct_teacher')->orWhere('name', 'online_teacher');
        })->get();

        return response()->json([
            'data' => TeacherResource::collection($teachers),
        ], 200);

    }
}
