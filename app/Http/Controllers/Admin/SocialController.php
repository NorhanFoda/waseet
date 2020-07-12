<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\Image;
use App\Classes\Upload;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::all();

        return view('admin.socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.socials.create');
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
            'link' => 'required',
            'icon' => 'required'
        ]);

        $social = Social::create([
            'link' => $request->link,
            'appear_in_footer' => $request->has('appear_in_footer') ? 1 : 0,
            'icon' => $request->icon
        ]);

        if($social){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('socials.index');
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
        $social = Social::find($id);
        return view('admin.socials.edit', compact('social'));
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
            'link' => 'required',
            'icon' => 'required',
        ]);
        
        $social = Social::find($id);
        $social->update([
            'link' => $request->link,
            'appear_in_footer' => $request->has('appear_in_footer') ? 1 : 0,
            'icon' => $request->icon
        ]);

        if($social){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('socials.index');
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

    public function deleteSocial(Request $request){
        $social = Social::find($request->id);
        $social->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
