<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Resources\Roles\RoleResource;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'logout']]);
    }


    //------------------------------------------------- login user start --------------------------------------------------//
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user != null){
            if($user->is_verified == 0){
                return response()->json([
                    'error' => trans('api.email_not_verified'),
                    // 'active' => $user->is_verified == 0 ? false : true,
                ], 400);
            }

            if($user->approved == 0){
                return response()->json([
                    'error' => trans('web.account_not_approved'),
                ], 400);
            }
            
            if($user->api_token == null){
                if(Hash::check($request->password, $user->password)){ 
                    $user->update([
                        'api_token' => Str::random(191),
                        'api_token_create_date' => carbon::now(),
                        'api_token_expire_date' => Carbon::now()->addDays(15),
                    ]);
                    return response()->json([
                        'data' => Auth::loginUsingId($user->id, true),
                        'roles' => RoleResource::collection($user->roles),
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('api.unauthorized'),
                    ], 401);
                }
            }
            else{
                if (Hash::check($request->password, $user->password)){
                    return response()->json([
                        'data' => Auth::loginUsingId($user->id, true),
                        'roles' => RoleResource::collection($user->roles),
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('api.unauthorized'),
                    ], 401);
                }
            }
        }

        return response()->json([
            'error' => trans('api.unauthorized'),
        ], 401);
    }
    //------------------------------------------------- login user end --------------------------------------------------//

    //------------------------------------------------- logout user start ------------------------------------------------//
    public function logout()
    {
        $user = Auth::guard('api')->user();
        if($user != null){
            $user->update(['api_token' => null]);
            return response()->json([
                'success' => trans('api.logout_success'),
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.user_not_logged'),
            ], 401);
        }
    }

    //------------------------------------------------- logout user end --------------------------------------------------//
}
