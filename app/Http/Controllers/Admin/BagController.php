<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bag;
use App\Models\BagCategory;
use App\Models\Image;
use App\Models\Video;
use App\Classes\Upload;
use App\Http\Requests\Bags\BagRequest;

class BagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bags = Bag::all();
        return view('admin.bags.index', compact('bags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BagCategory::all();
        return view('admin.bags.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BagRequest $request)
    {
        $bag = Bag::create($request->all());

        if($request->has('image')){
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $bag->id,
                'imageRef_type' => 'App\Models\Bag'
            ]);
            $bag->image()->save($image);
        }

        if($request->has('poster') && $request->has('video')){
            $this->validate($request,[
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            ]);

            $poster_url = Upload::uploadImage($request->poster);
            $video_url = Upload::uploadVideo($request->video);
            $video = Video::create([
                'path' => $video_url,
                'poster' => $poster_url,
                'bag_id' => $bag->id,
            ]);
            $bag->video()->save($video);
        }

        session()->flash('message', trans('admin.created'));
        return redirect()->route('bags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bag = Bag::find($id);

        return view('admin.bags.show', compact('bag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = BagCategory::all();
        $bag = Bag::find($id);

        return view('admin.bags.edit', compact('categories', 'bag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BagRequest $request, $id)
    {
        $bag = Bag::find($id);
        $bag->update($request->all());

        if($request->has('image')){
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $removed = Upload::deleteImage($bag->image->path);
            if($removed){
                $image_url = Upload::uploadImage($request->image);
                $bag->image->update([
                    'path' => $image_url,
                ]);
            }
            else{
                session()->flash('message', trans('admin.error'));
                return redirect()->route('bags.index');        
            }
        }

        if($request->has('poster') && $request->has('video')){
            $this->validate($request,[
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            ]);

            $video_removed = Upload::deleteVideo($bag->video->path);
            $poster_removed = Upload::deleteImage($bag->video->poster);
            // dump($bag->video->path);
            // dd($bag->video->path);

            if($video_removed && $poster_removed){
                $poster_url = $bag->video->poster;
                $video_url = Upload::uploadVideo($request->video);
                $bag->video->update([
                    'path' => $video_url,
                    'poster' => $poster_url,
                ]);
                session()->flash('message', trans('admin.created'));
                return redirect()->route('bags.index');
            }
            else{
                session()->flash('message', trans('admin.error'));
                return redirect()->route('bags.index');        
            }
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
        //
    }
}
