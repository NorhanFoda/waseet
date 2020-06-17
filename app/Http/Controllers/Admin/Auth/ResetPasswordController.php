<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function showResetForm($email){
        return view('admin.auth.passwords.reset', compact('email'));
    }

    public function update(Request $request){
        $admin = User::where('email', $request->email)->first();
        if($admin){
            $admin->update(['password' => Hash::make($request->password)]);   
            session()->flash('success', trans('admin.password_changed'));
            return redirect('admin/login');
        }
        session()->flash('error', trans('admin.password_changed'));
        return redirect('admin/login');
    }
}
