<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\Setting;
use App\Models\ContactUs;
use App\Http\Resources\Socials\SocialResurce;

class ContactUsController extends Controller
{
    public function index(){
        $lang = \App::getLocale();
        $set = Setting::find(1);

        $phone = $set->phone;
        $email = $set->email;
        $location = $set->{'location_'.$lang};

        $socials = SocialResurce::collection(Social::all());

        return response()->json([
            'phone' => $phone,
            'email' => $email,
            'location' => $location,
            'socials' => $socials
        ], 200);
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = ContactUs::create($request->all());

        if($contact == null){
            return response()->json([
                'errpr' => trans('api.error')
            ], 200);
        }

        return response()->json([
            'success' => trans('api.success')
        ], 200);
    }
}
