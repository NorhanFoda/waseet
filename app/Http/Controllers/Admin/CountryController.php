<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name_ar' => 'required', 'name_en' => 'required']);

        $country = Country::create($request->all());

        if($country){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('countries.index');    
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
        $country = Country::with(['users.roles' => function($q){
            $q->where('name', 'student')->orWhere('name', 'direct_teacher')->orWhere('name', 'online_teacher')->get();
        }, 'jobs', 'cities'])->where('id', $id)->first();

        return view('admin.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);

        return view('admin.countries.edit', compact('country'));
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
        $this->validate($request,['name_ar' => 'required', 'name_en' => 'required']);

        $country = Country::find($id)->update($request->all());

        if($country){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('countries.index');    
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

    public function deleteCountry(Request $request){
        $country = Country::find($request->id);
        $flag = false;

        if(count($country->cities) > 0){
            foreach($country->cities as $city){
                if(count($city->users) > 0){
                    $flag = true;
                }
            }
        }

        if($flag == true){
            return response()->json([
                'data' => 0
            ], 200);
        }
        else{
            $country->delete();
            return response()->json([
                'data' => 1
            ], 200);
        }
    }

    public function getCities(Request $request){
        $cities = Country::find($request->id)->cities;

        return view('admin.organizations.ajax.cities', compact('cities'));
    }
}
