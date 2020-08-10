<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\SendEmail;
use App\Classes\Verify;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Roles\RoleResource;
use Auth;

class ResetPasswordController extends Controller
{
    public function reset(Request $request){

        $this->validate($request, ['email' => 'required']);

        $user = User::where('email', $request->email)->first();

        if($user == null){
            return response()->json([
                'error' => trans('api.email_not_found')
            ], 400);
        }

        $code = $this->createVerificationCode();
        $user->update(['code' => $code, 'is_verified' => 0]);

        SendEmail::sendResetPasswordEmail($code, $user->email);

        return response()->json([
            'success' => trans('api.verification_code_sent'),
        ], 200);

    }

    public function verifyEmailToReset(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'code' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        $verified = Verify::verifyEmail($user, $request->code);

        if($verified){
            return response()->json([
                'data' => trans('api.email_is_verified'),
            ], 200);
        }
        
        return response()->json([
            'error' => trans('api.invalid_code'),
        ], 400);
    }

    public function setNewPassword(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'min:9|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:9',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user == null){
            return response()->json([
                'error' => trans('api.email_not_found'),
            ], 400);
        }

        if($user->is_verified == 0){
            return response()->json([
                'error' => trans('api.email_not_verified'),
            ], 400);
        }

        $user->update(['password' => Hash::make($request->password)]);
        return response()->json([
            'data' => Auth::loginUsingId($user->id),
            'roles' => RoleResource::collection($user->roles),
        ], 200);
    }

    private function createVerificationCode(){
        return rand ( 1000 , 9999 );
    }
}
