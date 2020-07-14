<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function getRegisterForm($role_id){
        return view('web.auth.register', compact('role_id'));
    }
}
