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

    public function __construct()
    {
        // $this->middleware('auth:admin');
    }

    public function index()
    {
        if(auth()->user() == null){
            return redirect()->route('admin.login');
        }
        else if(auth()->user() != null && auth()->user()->is_admin == 0){
            return redirect('/');
        }

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
        if(auth()->user() == null){
            return redirect()->route('admin.login');
        }
        else if(auth()->user() != null && auth()->user()->is_admin == 0){
            return redirect('/');
        }

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
        if(auth()->user() == null){
            return redirect()->route('admin.login');
        }
        else if(auth()->user() != null && auth()->user()->is_admin == 0){
            return redirect('/');
        }

        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required'
        ]);

        Country::create($request->all());
        session()->flash('message', trans('admin.country_created'));
        return redirect()->route('countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user() == null){
            return redirect()->route('admin.login');
        }
        else if(auth()->user() != null && auth()->user()->is_admin == 0){
            return redirect('/');
        }

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
        if(auth()->user() == null){
            return redirect()->route('admin.login');
        }
        else if(auth()->user() != null && auth()->user()->is_admin == 0){
            return redirect('/');
        }

        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required'
        ]);

        Country::find($id)->update($request->all());
        session()->flash('message', trans('admin.country_updated'));
        return redirect()->route('countries.index');
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
    
    public function delete(Request $request){
        if(auth()->user() == null){
            return redirect()->route('admin.login');
        }
        else if(auth()->user() != null && auth()->user()->is_admin == 0){
            return redirect('/');
        }
        
        if($request->ajax()){
            $country = Country::find($request->id);
            $country->delete();
            session()->flash('success', 'country deleted successfuly');
            return response()->json([
                'data' => 1,
            ], 200);
        }
    }
}
