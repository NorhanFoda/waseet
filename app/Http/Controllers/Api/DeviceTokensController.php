<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\DeviceToken;

class DeviceTokensController extends Controller
{
    public function index(){

        $user = auth()->user();
        if($user){
            if($user->allow_notification == 0){
                return response()->json([
                    'errpr' => 'Notification is disabled'
                ], 400);    
            }
            return response()->json([
                'data' => $user->tokens
            ], 200);    
        }
        return response()->json([
            'error' => "User not found"
        ], 400);   
        
    }

    public function create(Request $request){
        
        $this->validate($request, [
            'token' => 'required'
        ]);
    
        $user = auth()->user();

        $user_token = DeviceToken::where('user_id', $user->id)->where('token', $request->token)->first();
        if(!$user_token){
            $token = DeviceToken::create([
                'user_id' => $user->id,
                'token' => $request->token
            ]);
    
            if($token){
                return response()->json([
                    'data' => $token
                ], 200);
            }
            else{
                return response()->json([
                    'error' => 'Creation failed'
                ], 400);
            }   
        }
        else{
            return response()->json([
                'error' => 'Token is repeated for this user'
            ], 400);
        }
    }
}
