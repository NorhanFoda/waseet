<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Job;
use App\Models\Document;
use App\Models\BagCategory;
use App\Models\Bag;
use App\Models\Stage;
use App\Models\EduType;
use App\Models\EduLevel;
use App\Models\Material;
use App\Models\Country;
use App\Models\City;
use App\Models\Nationality;
use App\Models\PaymentMethod;
use App\Models\Announce;
use DB;

class HomeController extends Controller
{

    public function index(){
        $jobs = count(Job::all());

        $organizations = count(User::whereHas('roles', function($q){
                $q->where('name', 'organization');
            })->where('id', '!=', 1)->get());

        $seekers = count(User::whereHas('roles', function($q){
                $q->where('name', 'job_seeker');
            })->where('id', '!=', 1)->get());

        $cvs = count(Document::all());

        $applicants = DB::table('job_user')->distinct()->count();

        $online_teachers = count(User::whereHas('roles', function($q){
                $q->where('name', 'online_teacher');
            })->where('id', '!=', 1)->get());

        $direct_teachers = count(User::whereHas('roles', function($q){
                $q->where('name', 'direct_teacher');
            })->where('id', '!=', 1)->get());

        $students = count(User::whereHas('roles', function($q){
                $q->where('name', 'student');
            })->where('id', '!=', 1)->get());

        $users = count(User::where('id', '!=', 1)->get());

        $cats = count(BagCategory::all());

        $bags = count(Bag::all());

        $edu_types = count(EduType::all());

        $stages = count(Stage::all());

        $edu_levels = count(EduLevel::all());

        $materials = count(Material::all());

        $countries = count(Country::all());

        $cities = count(City::all());

        $nations = count(Nationality::all());

        $methods = count(PaymentMethod::all());

        $announces = count(Announce::all());
        

        return view('admin.home.index', compact('jobs', 'organizations', 'seekers', 'cvs',
                    'applicants', 'online_teachers', 'direct_teachers', 'students', 'users', 
                    'cats', 'bags', 'edu_types', 'stages', 'edu_levels', 'materials', 'countries',
                    'cities', 'nations', 'methods', 'announces'));
    }

    public function change_locale($locale){
        \LaravelLocalization::setLocale($locale);
        session(['lang' => $locale]);
	    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), \URL::previous());
		return \Redirect::to($url);
    }
}
