<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Address;
use App\Models\Country;
use App\Models\City;

class AddressController extends Controller
{
    public function getCountries(){
        
    }

    public function store(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $this->validate($request, [
                'country_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postal_code' => 'required',
            ]);

            $address = Address::create($request->all());

            if($address == null){
                return response()->json([
                    'error' => trans('api.error')
                ], 400);
            }

            return response()->json([
                'success' => trans('api.success')
            ], 400);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }
}
