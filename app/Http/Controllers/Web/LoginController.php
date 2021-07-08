<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
use App\Models\Bank;
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
            'email' => 'required|email',
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
            $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};

            //user account not verified
            if($user->is_verified == 0){
                session()->flash('error', trans('web.account_not_verified'));
                return view('web.auth.verify', compact('welcome_text', 'email'));
            }

            // user did not pay for register
            if(($user->hasRole('direct_teacher') || $user->hasRole('online_teacher') || $user->hasRole('job_seeker')) && $user->receipt == null){
                $banks = Bank::all();
                $user_id = $user->id;
                session()->flash('error', trans('web.complete_payment'));
                return view('web.auth.payment', compact('banks', 'user_id'));
            }

            //user account not approved from admin
            if($user->approved == 0){
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
