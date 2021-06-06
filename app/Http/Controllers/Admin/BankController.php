<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Image;
use App\Classes\Upload;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::with('image')->get();
        return view('admin.banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banks.create');
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
            'account_number' => 'required',
            'iban' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $bank = Bank::create($request->all());
        
        $image_url = Upload::uploadImage($request->image);
        $image = Image::create([
            'path' => $image_url,
            'imageRef_id' => $bank->id,
            'imageRef_type' => 'App\Models\Bank'
        ]);
        $bank->image()->save($image);

        if($bank){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('banks.index');
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
        $bank = Bank::with('image')->find($id);
        return view('admin.banks.edit', compact('bank'));
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
            'account_number' => 'required|numeric',
            'iban' => 'required|numeric',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $bank = Bank::find($id);
        $bank->update($request->all());

        if($request->has('image')){

            if($bank->image){

                Upload::deleteImage($bank->image->path);

                $image_url = Upload::uploadImage($request->image);
                $bank->image->update([
                    'path' => $image_url
                ]);
            }
            else{

                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => $bank->id,
                    'imageRef_type' => 'App\Models\Bank'
                ]);
                $bank->image()->save($image);
            }
        }

        if($bank){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('banks.index');
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

    public function deleteBank(Request $request){

        $bank = Bank::with('image')->find($request->id);

        if($bank->image){

            upload::deleteImage($bank->image->path);
        }
        
        Image::where('imageRef_id', $bank->id)->where('imageRef_type', 'App\Models\Bank')->first()->delete();

        $bank->delete();

        return response()->json([
            'data' => 1
        ], 200);
    }
}
