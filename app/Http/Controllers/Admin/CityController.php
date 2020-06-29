<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name_ar' => 'required', 'name_en' => 'required', 'country_id' => 'required']);

        $city = City::create($request->all());

        if($city){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('cities.index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::with(['users.roles' => function($q){
            $q->where('name', 'student')->orWhere('name', 'direct_teacher')->orWhere('name', 'online_teacher')->get();
        }, 'jobs', 'country'])->find($id);

        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::all();

        return view('admin.cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name_ar' => 'required', 'name_en' => 'required', 'country_id' => 'required']);

        $city = City::find($id);

        $city->update($request->all());

        if($city){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('cities.index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }

    public function deleteCity(Request $request){
        $city = City::find($request->id);

        if(count($city->users) > 0){
            return response()->json([
                'data' => 0
            ], 200);
        }
        else{
            $city->delete();
            return response()->json([
                'data' => 1
            ], 200);
        }
    }
}
