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
        $countries = Country::all();
        $cities = count($countries) > 0 ? $countries[0]->cities : [];

        return view('web.addresses.index', compact('addresses', 'countries', 'cities'));
    }

    public function create(){
        $countries = Country::all();
        $cities = count($countries) > 0 ? $countries[0]->cities : [];

        return view('web.addresses.create', compact('countries', 'cities'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);

        $address = Address::create($request->all());
        $address->update(['user_id' => auth()->user()->id]);

        session()->flash('success', trans('web.address_added'));
        return redirect()->route('addresses.index');
    }

    public function addCity(Request $request){
        $this->validate($request, [
            'country_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required'
        ]);

        $city = City::create($request->all());

        if($city != null){
            session()->flash('success', trans('web.city_added'));
            return redirect()->back();
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }

    public function delete(Request $request){
        $address = Address::findOrFail($request->address_id);
        $address->delete();
    }
}
