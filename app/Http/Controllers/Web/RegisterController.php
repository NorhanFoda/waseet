<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Students\WebStudentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Stage;
use App\Models\Bank;
use App\Models\BankReceipt;
use App\User;
use App\Classes\Upload;
use App\Classes\SendEmail;
use App\Classes\Verify;
use App\Models\Image;
use App\Models\Setting;
use App\Models\EduLevel;
use App\Models\EduType;
use App\Models\Material;
use App\Models\Nationality;
use App\Models\Country;
use App\Models\City;
use App\Models\Document;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Models\SubScriber;
use App\Jobs\SendEmailJob;
use Mail;
use App\Mail\VerificationEmail;

class RegisterController extends Controller
{
    public function getRegisterForm($role_id){
        $stages = Stage::all();
        $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};
        $nationalities = Nationality::all();
        $materials = Material::all();
        $levels = EduLevel::all();
        $types = EduType::all();
        $countries = Country::all();
        return view('web.auth.register', compact('role_id', 'welcome_text', 'nationalities', 
                        'materials', 'levels', 'countries', 'types', 'stages'));          
    }


    public function register(UserRequest $request, $role_id){

        $old = User::where('email', $request->email)->first();

        // check if this user is registered before but not verified then delete it
        if($old != null){
            if($old->is_verified == 0){
                if($old->image != null){
                    $removed = Upload::deleteImage($old->image->path);
                    if($removed){
                        $old->delete();
                    }
                    else{
                        session()->flash('error', trans('web.error'));
                        return redirect()->back();
                    }
                }
                else{
                    $old->delete();
                }
            }
            else{
                session()->flash('warning', trans('web.email_exsit'));
                return redirect()->back();
            }
        }

        $user = User::create($request->all());
        $user->update([
            'password' => Hash::make($request->password),
            'teaching_lat' => $request->lat2,
            'teaching_long' => $request->long2,
        ]);
    
        
        if($role_id != 'visitor'){
            $user->assignRole(DB::table('roles')->find($role_id)->name);
        }

        if($role_id == 3 || $role_id == 4){
            foreach($request->material_ids as $id){
                $user->materials()->attach($id);
                if($id == 4){
                    auth()->user()->materials()->where('material_id', 4)->first()->pivot->update(['other_material' => $request->other_material]);
                }
            }

        }

        if($role_id == 6){
            $image_url = Upload::uploadPDF($request->cv);
            $cv = Document::create([
                'path' => $image_url,
                'doucmentRef_id' => $user->id,
                'doucmentRef_type' => 'App\User',
            ]);
            $user->document()->save($cv);
        }

        // Student, organization, and visitor accounts are approved by default because they do not pay for register
        if($role_id != 3 && $role_id != 4 && $role_id != 6){
            $user->update(['approved' => 1]);
        }

        if($request->has('image')){            

            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $user->id,
                'imageRef_type' => 'App\User'
            ]);
            $user->image()->save($image);
        }

        
        // If the registered user is direct/online teacher or job seeker then redirect user to payment page
        // if($role_id == 3 || $role_id == 4 || $role_id == 6){
        //     $banks = Bank::all();
        //     $user_id = $user->id;
        //     return view('web.auth.payment', compact('banks', 'user_id'));
        // }
        // If the registred user is student or visitor or organozation then send verification code
        // else{
            $code = $this->createVerificationCode();
            $user->update(['code' => $code]);
            $email = $user->email;

            // $details['code'] = $code;
            // $details['email'] = $user->email;
            // $details['type'] = 'send_verification_code';
            // dispatch(new SendEmailJob($details));
            SendEmail::sendVerificationCode($code, $user->email);

            $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};

            session()->flash('success', trans('web.verification_code_sent'));
            return view('web.auth.verify', compact('welcome_text', 'email'));
        // }

    }

    public function verify(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'code' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        $email = $request->email;
        
        $verified = Verify::verifyEmail($user, $request->code);

        if($verified){
            // login user directly after code verification if user role is 
            //student/organozation or user is visitor because they do not need admin approve
            if(!$user->hasRole('direct_teacher') && !$user->hasRole('online_teacher') && !$user->hasRole('job_seeker')){
                Auth::login($user);
                session()->flash('success', trans('web.registred'));
                return redirect()->route('home');
            }
            else{
                $banks = Bank::all();
                $user_id = $user->id;
                session()->flash('success', trans('web.account_verified'));
                return view('web.auth.payment', compact('banks', 'user_id'));
            }
        }
        else{
            $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};
            session()->flash('error', trans('web.invalid_code'));
            return view('web.auth.verify', compact('welcome_text', 'email'));
        }
    }

    public function resendCode(Request $request){

        $code = $this->createVerificationCode();
        $user = User::where('email', $request->email)->first();
        $user->update(['code' => $code]);
        $email = $user->email;

        SendEmail::sendVerificationCode($code, $user->email);

        $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};

        session()->flash('success', trans('web.verification_code_sent'));
        // return redirect()->back();
        return view('web.auth.verify', compact('welcome_text', 'email'));
    }

    private function createVerificationCode(){
        return rand ( 1000 , 9999 );
    }

    public function validateEmail($email){
        return !!User::where('email', $email)->first();
    }

    // Store register payment data
    public function StoreRegisterPayment(Request $request){
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

        // Send verification code
        $code = $this->createVerificationCode();
        $user = User::find($request->user_id);
        $user->update(['code' => $code]);
        $email = $user->email;

        session()->flash('success', trans('api.wait_for_approve'));
        return redirect()->route('home');

        // $details['code'] = $code;
        // $details['email'] = $user->email;
        // $details['type'] = 'send_verification_code';
        // dispatch(new SendEmailJob($details));
        // SendEmail::sendVerificationCode($code, $email);

        // $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};

        // session()->flash('success', trans('web.verification_code_sent'));
        // return view('web.auth.verify', compact('welcome_text', 'email'));
    }
}
