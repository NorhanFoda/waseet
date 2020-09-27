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
use App\Models\Image;
use App\Models\EduType;
use App\Models\EduLevel;
use App\Models\Material;
use App\Models\Country;
use App\Models\City;
use App\Models\Nationality;
// use App\Models\PaymentMethod;
use App\Models\Bank;
use App\Models\Announce;
use App\Models\BankReceipt;
use App\Classes\Upload;
use App\Models\SubScriber;
use DB;
use App\Jobs\SendEmailJob;
use App\Classes\SendEmail;
use Carbon\Carbon;

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

        // $methods = count(PaymentMethod::all());

        $banks = count(Bank::all());

        $announces = count(Announce::all());
        

        return view('admin.home.index', compact('jobs', 'organizations', 'seekers', 'cvs',
                    'applicants', 'online_teachers', 'direct_teachers', 'students', 'users', 
                    'cats', 'bags', 'edu_types', 'stages', 'edu_levels', 'materials', 'countries',
                    'cities', 'nations', 'announces', 'banks'));
    }

    public function change_locale($locale){
        \LaravelLocalization::setLocale($locale);
        session(['lang' => $locale]);
	    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), \URL::previous());
		return \Redirect::to($url);
    }

    // public function registerPayment(){
    //     $banks = Bank::all();
    //     return view('admin.auth.payment', compact('banks'));
    // }

    public function storeRegisterPayment(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'bank_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'cost' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //Store receipt data
        $receipt = BankReceipt::create($request->all());
        $receipt->update(['user_id' => $request->user_id]);

        // Upload reciept image
        $image_url = Upload::uploadImage($request->image);
        $image = Image::create([
            'path' => $image_url,
            'imageRef_id' => $receipt->id,
            'imageRef_type' => 'App\Models\BankReceipt'
        ]);
        $receipt->image()->save($image);

        $user = User::find($request->user_id);
        $user->update(['approved' => 1]);

        session()->flash('success', trans('admin.created'));

        if($request->type == 'seeker'){
            return redirect()->route('seekers.index');
        }

        if($request->type == 'online_teacher' || $request->type == 'direct_teacher'){
            
            //Send mail to subscripers
            $subs = SubScriber::get(['email']);
            // SendEmail::Subscripe($subs[2]->email,route('teachers.show', $user->id), 'teacher');
            foreach($subs as $sub){
                $details['emails'] = $sub->email;
                $details['link'] = route('teachers.show', $user->id);
                $details['type2'] = 'subscripe';
                $details['type'] = 'teacher';
                dispatch(new SendEmailJob($details));
            }
        }

        if($request->type == 'online_teacher'){
            return redirect()->route('online_teachers.index');
        }
        if($request->type == 'direct_teacher'){
            return redirect()->route('direct_teachers.index');
        }
    }
}
