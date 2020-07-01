<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Image;
use App\Classes\Upload;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = PaymentMethod::with('image')->get();

        return view('admin.payment_methods.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_methods.create');
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
            'image' => 'required|image||mimes:jpeg,png,jpg,gif,svg|max:2048']);

        $method = PaymentMethod::create($request->all());
        $image_url = Upload::uploadImage($request->image);
        $image = Image::create([
            'path' => $image_url,
            'imageRef_id' => $method->id,
            'imageRef_type' => 'App\Models\PaymentMethod'
        ]);
        $method->image()->save($image);

        if($method){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('methods.index');
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
        $method = PaymentMethod::with('image')->find($id);
        return view('admin.payment_methods.edit', compact('method'));
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
            'name_en' => 'required']);

        $method = PaymentMethod::find($id);
        $method->update($request->all());

        if($request->has('image')){
            $removed = Upload::deleteImage($method->image->path);
            if($removed){
                $image_url = Upload::uploadImage($request->image);
                $method->image->update([
                    'path' => $image_url,
                ]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return redirect()->route('methods.index');        
            }
        }

        if($method){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('methods.index');
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

    public function deleteMethod(Request $request){
        $method = PaymentMethod::find($request->id);
        $removed = false;
        
        if($method->image != null){
            $removed = Upload::deleteImage($method->image->path);
        }

        if($removed){
            Image::where('imageRef_id', $method->id)->first()->delete();
        }
        
        $method->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
