<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{

    public function index(){
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'student']);
        // Role::create(['name' => 'teacher']);
        // Role::create(['name' => 'direct_teacher']);
        // Role::create(['name' => 'private_teacher']);
        // Role::create(['name' => 'organization']);
        // Role::create(['name' => 'job_seeker']);

        // User::find(1)->assignRole('admin');
        // User::find(2)->assignRole('student');



        // User::find(1)->assignRole('admin');
        return view('admin.home.index');
    }

    public function change_locale($locale){
        \LaravelLocalization::setLocale($locale);
	    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), \URL::previous());
		return \Redirect::to($url);
    }
}
