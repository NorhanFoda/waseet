<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nationality;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Nationality::all();
        return view('admin.nationalities.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nationalities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name_ar' => 'required', 'name_en' => 'required']);

        $nation = Nationality::create($request->all());

        if($nation){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('nationalities.index');
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
        $nation = Nationality::with('users')->find($id);
        return view('admin.nationalities.show', compact('nation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nation = Nationality::find($id);

        return view('admin.nationalities.edit', compact('nation'));
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
        $this->validate($request, ['name_ar' => 'required', 'name_en' => 'required']);

        $nation = Nationality::find($id);
        $nation->update($request->all());

        if($nation){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('nationalities.index');
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

    public function deleteNationality(Request $request){
        $nation = Nationality::find($request->id);
        if(count($nation->users) > 0){
            return response()->json([
                'data' => 0
            ], 200);
        }
        
        $nation->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
