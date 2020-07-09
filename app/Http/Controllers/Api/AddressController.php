<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Address;
use App\Models\Country;
use App\Models\City;
use App\Http\Resources\Address\CountryResource;
use App\Http\Resources\Address\CityResource;
use App\Http\Resources\Address\AddressResource;

class AddressController extends Controller
{

    public function index(){

        return response()->json([
            'addresses' => AddressResource::collection(auth()->user()->addresses)
        ], 200);
    }
    
    public function getAddressesDetails(){
        return response()->json([
            'countries' => CountryResource::collection(Country::all()),
            'cities' => CityResource::collection(City::all()),
        ], 200);
    }

    public function store(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            // dd(app('request')->header('Authorization'));
            $this->validate($request, [
                'country_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postal_code' => 'required',
            ]);

            $address = Address::create($request->all());
            $address->update(['user_id' => auth()->user()->id]);
            auth()->user()->addresses()->save($address);

            if($address == null){
                dd('1');
                return response()->json([
                    'error' => trans('api.error')
                ], 400);
            }

            return response()->json([
                'success' => trans('api.success')
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function update(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            $this->validate($request, [
                'id' => 'required',
                'country_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postal_code' => 'required',
            ]);

            $address = auth()->user()->addresses()->find($request->id);

            if($address == null){
                return response()->json([
                    'error' => trans('api.error')
                ], 400);
            }

            $address->update($request->all());

            if(!$address){
                return response()->json([
                    'error' => trans('api.error')
                ], 400);
            }

            return response()->json([
                'success' => trans('api.success')
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    public function destroy(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            $this->validate($request, ['id' => 'required']);

            $address = auth()->user()->addresses()->find($request->id);

            if($address == null){
                return response()->json([
                    'error' => trans('api.error')
                ], 400);
            }

            $address->delete();

            return response()->json([
                'success' => trans('api.success')
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }
}
