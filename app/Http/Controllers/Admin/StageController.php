<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stage;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages = Stage::all();

        return view('admin.stages.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stages.create');
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

        Stage::create($request->all());

        session()->flash('message', trans('admin.created'));
        return redirect()->route('stages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stage = Stage::with(['users.roles' => function($q){
            $q->where('name', 'student')->orWhere('name', 'direct_teacher')->orWhere('name', 'online_teacher')->get();
        }], 'materials')->where('id', $id)->first();

        return view('admin.stages.show', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stage = Stage::find($id);

        return view('admin.stages.edit', compact('stage'));
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

        Stage::find($id)->update($request->all());

        session()->flash('message', trans('admin.updated'));
        return redirect()->route('stages.index');
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

    public function deleteStage(Request $request){
        
        $stage = Stage::find($request->id);
        if(count($stage->users) > 0){
            return response()->json([
                'data' => 0
            ], 200);    
        }
        else{
            $stage->delete();
            return response()->json([
                'data' => 1
            ], 200);
        }
    }
}
