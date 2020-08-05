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
        $bank = Bank::with('image')->find(1);
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
            'account_number' => 'required',
            'iban' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $bank = Bank::find($id);
        $bank->update($request->all());

        if($request->has('image')){
            $removed = Upload::deleteImage($bank->image->path);
            if($removed){
                $image_url = Upload::uploadImage($request->image);
                $bank->image->update([
                    'path' => $image_url
                ]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return redirect()->back();
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

        $removed = upload::deleteImage($bank->image->path);
        
        if($removed){
            Image::where('imageRef_id', $bank->id)->where('imageRef_type', 'App\Models\Bank')->first()->delete();

            $bank->delete();

            return response()->json([
                'data' => 1
            ], 200);
        }
        else{
            return response()->json([
                'data' => 0
            ], 200);
        }
    }
}
