<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialization;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specializations = Specialization::all();
        return view('admin.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $spc = Specialization::create($request->all());

        if($spc){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('specializations.index');    
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
        $spc = Specialization::with('jobs')->find($id);
        return view('admin.specializations.show', compact('spc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spc = Specialization::find($id);

        return view('admin.specializations.edit', compact('spc'));
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
        $this->validate($request, [
            'name_ar' => 'required',
            'name_en' => 'required',
        ]);

        $spc = Specialization::find($id);

        $spc->update($request->all());

        if($spc){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('specializations.index');    
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

    public function deleteSpecialization(Request $request){
        $spc = Specialization::find($request->id);
        $flag = false;

        if(count($spc->jobs) > 0){
            return response()->json([
                'data' => 0
            ], 200);
        }
        else{
            $spc->delete();
            return response()->json([
                'data' => 1
            ], 200);
        }
        
    }
}
