<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use App\Http\Resources\Register\RegisterResource;

class CountryController extends Controller
{
    public function getCountries(){
        return response()->json([
            'countries' => RegisterResource::collection(Country::all()),
        ], 200);
    }

    public function getCities(){
        return response()->json([
            'cities' => RegisterResource::collection(City::all()),
        ], 200);
    }

    public function getCitiesOfCountry($id){
        return response()->json([
            'cities' => RegisterResource::collection(Country::find($id)->cities),
        ], 200);
    }
}
