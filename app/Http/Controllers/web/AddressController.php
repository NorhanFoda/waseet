<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(){
        $addresses = auth()->user()->addresses;
        // $countries = Country::all();
        // $cities = count($countries) > 0 ? $countries[0]->cities : [];

        return view('web.addresses.index', compact('addresses'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
        ]);

        // if($request->city != 'الرياض' && $request->city != 'Al Riyadh' && $request->city != 'Riyadh'){
        //     session()->flash('error', trans('web.shipping_not_allowed_here'));
        //     return redirect()->back();
        // }

        $address = Address::create($request->all());
        $address->update(['user_id' => auth()->user()->id]);
        session()->flash('success', trans('web.address_added'));
        return redirect()->back();

        // $this->validate($request, [
        //     'country_id' => 'required',
        //     'address' => 'required',
        //     'postal_code' => 'required',
        // ]);

        // if($request->has('city_id')){
        //     $address = Address::create($request->all());
        //     $address->update(['user_id' => auth()->user()->id]);
        //     session()->flash('success', trans('web.address_added'));
        //     return redirect()->back();
        // }
        // else{
        //     $this->validate($request, [
        //         'name_ar' => 'required',
        //         'name_en' => 'required'
        //     ]);

        //     $city = City::create([
        //         'country_id' => $request->country_id,
        //         'name_ar' => $request->name_ar,
        //         'name_en' => $request->name_en
        //     ]);

        //     $address = Address::create([
        //         'country_id' => $request->country_id,
        //         'city_id' => $city->id,
        //         'address' => $request->address,
        //         'postal_code' => $request->postal_code,
        //         'user_id' =>  auth()->user()->id,
        //     ]);

        //     session()->flash('success', trans('web.address_added'));
        //     return redirect()->back();

        // }

    }

    public function delete(Request $request){
        $address = Address::findOrFail($request->address_id);
        $address->delete();
    }
}
