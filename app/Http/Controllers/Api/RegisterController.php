<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\SendEmail;
use App\Classes\Verify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'verify', 'resendCode']]);
    }

    //--------------------------------- store user data and send verification email start ---------------------------------------------//
    public function register(Request $request){
        $this->validateRegister($request);

        $user = $this->create($request->all());

        $code = $this->createVerificationCode();

        $user->update(['code' => $code]);

        return $this->sendEmail($request->email, $user->code);   
    }

    public function validateRegister(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'phone_main' => 'required|unique:users',
            'password' => 'min:9|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:9',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_main' => $data['phone_main'],
            'is_verified' => 0,
            'api_token' => Str::random(191),
            'password' => Hash::make($data['password']),
        ]);
    }

    //-------------------------------------------------------- store user data end ---------------------------------------------------//

    //-------------------------------------------------- send verification code start ------------------------------------------------//

    public function sendEmail($email, $code){
        if(!$this->validateEmail($email)){
            return response()->json([
                'error' => trans('api.email_not_found'),
            ], 404);
        }

        SendEmail::sendVerificationCode($code, $email);

        return response()->json([
            'success' => trans('api.verification_code_sent'),
        ], 200);
    }

    //-------------------------------------------------- send verification code end -------------------------------------------------//

    //----------------------------------------------- resend verification code start -------------------------------------------------//
    public function resendCode(Request $request){
        $this->validate($request, ['email' => 'required']);

        $code = $this->createVerificationCode();
        $user = User::where('email', $request->email)->first();

        if($user->is_verified == 0){
            $user->update(['code' => $code]);
            return $this->sendEmail($request->email, $code);
        }
        else{
            return response()->json([
                'error' => trans('api.email_is_verified_before'),
            ], 400);
        }
    }
    //----------------------------------------------- resend verification code end -------------------------------------------------//


    //---------------------------------------------- verify user email start --------------------------------------------------------//
    public function verify(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'code' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        $verified = Verify::verifyEmail($user, $request->code);

        if($verified){
            return response()->json([
                'data' => Auth::loginUsingId($user->id, true)
            ], 200);
        }
        
        return response()->json([
            'error' => trans('api.invalid_code'),
        ], 400);
    }
    //---------------------------------------------- verify user email end ----------------------------------------------------------//



    private function createVerificationCode(){
        return rand ( 1000 , 9999 );
    }

    public function validateEmail($email){
        return !!User::where('email', $email)->first();
    }
}
