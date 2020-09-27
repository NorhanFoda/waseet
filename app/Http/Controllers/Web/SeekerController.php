<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class SeekerController extends Controller
{
    public function index(){
        //only organization cat view list of seekers
        if(Auth::check() && auth()->user()->hasRole('organization')){
            $seekers = User::with(['image', 'document'])->whereHas('roles', function($q){
                $q->where('name', 'job_seeker');
            })->where('is_verified', 1)->get();

            return view('web.seekers.index', compact('seekers'));
        }
        else{
            session()->flash('warning', trans('web.login_as_org'));
            return redirect()->back();
        }
    }
}
