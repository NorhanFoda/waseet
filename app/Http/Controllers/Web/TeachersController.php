<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Setting;
use Auth;
use DB;

class TeachersController extends Controller
{
    // Get all teachers
    public function index(){

        if(Auth::check()){
            // only teachers, students and organizations can view list of teachers
            if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('student') || auth()->user()->hasRole('organization')){

                $teachers = User::with(['image', 'materials', 'ratings', 'nationality'])->whereHas('roles', function($q){
                    $q->where('name', 'direct_teacher')->orWhere('name', 'online_teacher');
                })->where('approved', 1)->where('is_verified', 1)->get();
        
                $title = Setting::find(1)->{'section_2_title_'.session('lang')};
                $text = Setting::find(1)->{'section_2_text_'.session('lang')};
                $roles = DB::table('roles')->where('name', 'online_teacher')->orWhere('name', 'direct_teacher')->get();
        
                return view('web.teachers.index', compact('teachers', 'title', 'text', 'roles'));
            }
        }
        else{
            session()->flash('warning', trans('web.login_as_teacher_org_std'));
            return redirect()->back();
        }
    }
    
    // View teacher profile only for auth users
    public function show($id){

        if(Auth::check()){
            // only teachers, students and organizations can view teacher details
            if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('student') || auth()->user()->hasRole('organization')){

                $teacher = User::with('image', 'materials', 'ratings', 'nationality', 'roles', 'edu_level')->find($id);
                $title = Setting::find(1)->{'section_2_title_'.session('lang')};
                $text = Setting::find(1)->{'section_2_text_'.session('lang')};

                return view('web.teachers.show', compact('teacher', 'title', 'text'));
            }
        }
        else{
            session()->flash('warning', trans('web.login_as_teacher_org_std'));
            return redirect()->back();
        }
    }

    public function getTeachersByType($type){

        if(Auth::check()){
            // only teachers, students and organizations can view list of teachers
            if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('student') || auth()->user()->hasRole('organization')){
                
                $title = Setting::find(1)->{'section_2_title_'.session('lang')};
                $text = Setting::find(1)->{'section_2_text_'.session('lang')};
                $roles = DB::table('roles')->where('name', 'online_teacher')->orWhere('name', 'direct_teacher')->get();

                if($type == 'online'){
                    $teachers = User::with(['image', 'materials', 'ratings', 'nationality'])->whereHas('roles', function($q){
                        $q->where('name', 'online_teacher');
                    })->where('approved', 1)->get();

                    return view('web.teachers.index', compact('teachers', 'title', 'text', 'roles'));
                }
                else if($type == 'direct'){
                    $teachers = User::with(['image', 'materials', 'ratings', 'nationality'])->whereHas('roles', function($q){
                        $q->where('name', 'direct_teacher');
                    })->where('approved', 1)->get();
                    
                    return view('web.teachers.index', compact('teachers', 'title', 'text', 'roles'));
                }
            }
        }

        else{
            session()->flash('warning', trans('web.login_as_teacher_org_std'));
            return redirect()->back();
        }

    }
}
