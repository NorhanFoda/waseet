<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
use App\User;
use DB;
use Auth;

class LoginController extends Controller
{
    public function getLoginForm(){
        $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};
        $roles = DB::table('roles')->where('name', '!=', 'admin')->get();

        return view('web.auth.login', compact('welcome_text', 'roles'));
    }

    public function loginUser(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        $email;
        if($user){
            $email = $user->email;
        }

        if($user == null){
            session()->flash('error', trans('web.email_or_password_wrong'));
            return redirect()->back();
        }
        else{
            if($user->is_verified == 0){
                $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};
                session()->flash('error', trans('web.account_not_verified'));
                return view('web.auth.verify', compact('welcome_text', 'email'));
            }

            if($user->approved == 0){
                $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};
                session()->flash('error', trans('web.account_not_approved'));
                return redirect()->back();
            }
            
            if(Hash::check($request->password, $user->password)){ 
                Auth::login($user);
                return redirect()->route('home');
            }
            else{
                session()->flash('error', trans('web.email_or_password_wrong'));
                return redirect()->back();
            }
        }
    }
}
