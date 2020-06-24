<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Stage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();

        return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();
        return view('admin.materials.create', compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['stage_id' => 'required', 'name_ar' => 'required', 'name_en' => 'required']);

        $material = Material::create($request->all());
        $stage = Stage::find($request->stage_id);

        $stage->materials()->attach($material);

        if($material){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('materials.index');    
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
        $material = Material::with(['users.roles' => function($q){
            $q->where('name', 'student')->orWhere('name', 'direct_teacher')->orWhere('name', 'online_teacher')->get();
        }, 'stages'],)->where('id', $id)->first();

        return view('admin.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stages = Stage::all();
        $material = Material::with('stages')->where('id', $id)->first();
        return view('admin.materials.edit', compact('stages', 'material'));
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
        $this->validate($request, ['stage_id' => 'required', 'name_ar' => 'required', 'name_en' => 'required']);

        $material = Material::find($id);
        $material->update($request->all());
        $stage = Stage::find($request->stage_id);

        $stage->materials()->sync($material);

        if($material){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('materials.index');    
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

    public function deleteMaterial(Request $request){
        $material = Material::find($request->id);
        $material->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
