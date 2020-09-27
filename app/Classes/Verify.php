<?php

namespace App\Classes;

class Verify{
    
    static function verifyEmail($user, $code){
        if($user == null){
            return response()->json([
                'error' => trans('web.error')
            ],404);
        }
        if($user->code == $code){
            $user->update(['is_verified' => 1]);
            return true;
        }
        return false;
    }
}