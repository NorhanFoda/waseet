<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Image;
use App\Classes\Upload;

class AnnouncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announces = Announce::all();
        return view('admin.announces.index', compact('announces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['image' => 'required']);

        $announce = Announce::create([
            'url' => $request->url,
            'appear_in_home' => $request->appear_in_home == 'on' ? 1 : 0,
        ]);

        $image_url = Upload::uploadImage($request->image);
        $image = Image::create([
            'path' => $image_url,
            'imageRef_id' => $announce->id,
            'imageRef_type' => 'App\Models\Announce'
        ]);
        $announce->image()->save($image);

        if($announce){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('announces.index');
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
        $announce = Announce::with('image')->find($id);
        return view('admin.announces.edit', compact('announce'));
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
        $announce = Announce::find($id);

        $announce->update([
            'appear_in_home' => $request->appear_in_home == 'on' ? 1 : 0,
            'url' => $request->url,
        ]);
        
        if($removed->has('iamge')){
            $removed = Upload::deleteImage($announce->image->path);
            if($removed){
                $image_url = Upload::uploadImage($request->image);
                $announce->image->update([
                    'path' => $image_url
                ]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return redirect()->back();
            }
        }

        session()->flash('success', trans('admin.created'));
        return redirect()->route('announces.index');
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

    public function deleteAnnounce(Request $request){
        
        $announce = Announce::find($request->id);
        $removed = false;
        
        if($announce->image != null){
            $removed = Upload::deleteImage($announce->image->path);
        }

        if($removed){
            Image::where('imageRef_id', $announce->id)->first()->delete();
        }

        if($removed){
            $announce->delete();
            return response()->json([
                'data' => 1,
            ], 200);
        }
        else{
            return response()->json([
                'data' => 0,
            ], 200);
        }
        
    }
}
