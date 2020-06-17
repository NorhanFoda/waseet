<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminResetPassword;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function showLinkRequestForm(){
        return view('admin.auth.passwords.email');
    }

    public function sendResetSendEmail(Request $request){
        $email = $request->email;
        if(User::where('email', $email)->first()){
            Mail::to($email)->send(new AdminResetPassword($email));
            session()->flash('success', trans('admin.email_sent'));
            return redirect()->back();
        }
        session()->flash('error', trans('admin.email_not_found'));
        return redirect()->back();
    }

}
