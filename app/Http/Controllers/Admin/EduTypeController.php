<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EduType;

class EduTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edu_types = EduType::all();
        return view('admin.edu_types.index', compact('edu_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.edu_types.create');
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
        $type = EduType::create($request->all());
        if($type){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('edu_types.index');
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
        $type = EduType::with(['users.roles' => function($q){
            $q->where('name', 'organization')->get();
        }])->find($id);

        return view('admin.edu_types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = EduType::find($id);
        return view('admin.edu_types.edit', compact('type'));
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
        $type = EduType::find($id);
        $type->update($request->all());
        if($type){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('edu_types.index');
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

    public function deleteEduType(Request $request){
        $type = EduType::find($request->id);
        if(count($type->users) > 0){
            return response()->json([
                'data' => 0
            ], 200);
        }
        else{
            $type->delete();
            return response()->json([
                'data' => 1
            ], 200);
        }
    }
}
