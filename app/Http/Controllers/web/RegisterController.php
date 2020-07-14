<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Students\WebStudentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Stage;
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
        $user->update(['password' => Hash::make($request->password)]);
        $user->assignRole(DB::table('roles')->find($role_id)->name);

        if($role_id == 3 || $role_id == 4){
            foreach($request->material_ids as $id){
                $user->materials()->attach($id);
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

        if($request->has('image')){            

            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $user->id,
                'imageRef_type' => 'App\User'
            ]);
            $user->image()->save($image);
        }

        $code = $this->createVerificationCode();
        $user->update(['code' => $code]);
        $email = $user->email;

        SendEmail::sendVerificationCode($code, $user->email);

        $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};

        session()->flash('success', trans('web.verification_code_sent'));
        return view('web.auth.verify', compact('welcome_text', 'email'));

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
            Auth::login($user);
            session()->flash('success', trans('web.registred'));
            return redirect()->route('home');
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

        SendEmail::sendVerificationCode($code, $user->email);
    }

    private function createVerificationCode(){
        return rand ( 1000 , 9999 );
    }

    public function validateEmail($email){
        return !!User::where('email', $email)->first();
    }
}
