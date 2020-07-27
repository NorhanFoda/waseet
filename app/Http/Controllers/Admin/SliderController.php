<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Slider;
use App\Classes\Upload;
use App\Classes\SliderImage;
use App\Http\Requests\Slider\SliderRequest;
use App\Http\Requests\Slider\EditSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = SliderImage::getPossibleStatuses();
        return view('admin.slider.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider = Slider::create($request->all());
        $image_url = Upload::uploadImage($request->image);
        $image = Image::create([
            'path' => $image_url,
            'imageRef_id' => $slider->id,
            'imageRef_type' => 'App\Models\Slider',
            'type' => $request->type,
        ]);
        $slider->image()->save($image);

        if($slider){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('sliders.index');
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
        $slider = Slider::with('image')->find($id);

        return view('admin.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::with('image')->find($id);
        $options = SliderImage::getPossibleStatuses();
        return view('admin.slider.edit', compact('slider', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSliderRequest $request, $id)
    {
        $slider = Slider::find($id);
        $slider->update($request->all());
        $slider->image->update([
            'type' => $request->type,
        ]);

        if($request->has('image')){
            $removed = Upload::deleteImage($slider->image->path);
            if($removed){
                $image_url = Upload::uploadImage($request->image);
                $slider->image->update([
                    'path' => $image_url,
                    'type' => $request->type,
                ]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return redirect()->route('sliders.index');        
            }
        }

        if($slider){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('sliders.index');
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

    public function deleteSlider(Request $request){
        $slider = Slider::find($request->id);
        $removed = false;
        
        if($slider->image != null){
            $removed = Upload::deleteImage($slider->image->path);
        }

        if($removed){
            Image::where('imageRef_id', $slider->id)->first()->delete();
        }
        
        $slider->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
