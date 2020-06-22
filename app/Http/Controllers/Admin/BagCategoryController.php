<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bags\BagCategoryRequest;
use App\Http\Requests\Bags\EditBagCategoryRequest;
use App\Models\BagCategory;
use App\Models\Image;
use App\Classes\Upload;

class BagCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BagCategory::all();
        return view('admin.bag_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bag_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BagCategoryRequest $request)
    {
        $category = BagCategory::create($request->all());
        
        if($request->has('image')){
            $url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $url,
                'imageRef_id' => $category->id,
                'imageRef_type' => 'App\Models\BagCategory'
            ]);
            $category->image()->save($image);
        }

        session()->flash('message', trans('admin.created'));
        return redirect()->route('bag_categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = BagCategory::find($id);
        $bags = $cat->bags;
        
        return view('admin.bag_categories.show', compact('cat', 'bags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = BagCategory::find($id);
        return view('admin.bag_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditBagCategoryRequest $request, $id)
    {
        $category = BagCategory::find($id);
        $category->update($request->all());

        if($request->has('image')){
            $removed = Upload::deleteImage($category->image->path);
            if($removed){
                $url = Upload::uploadImage($request->image);
                $category->image->update([
                    'path' => $url,
                ]);
            }
            else{
                session()->flash('message', trans('admin.error'));
                return redirect()->route('bag_categories.index');     
            }
        }

        session()->flash('message', trans('admin.updated'));
        return redirect()->route('bag_categories.index');
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

    public function deleteBagCategory(Request $request){
        $category = BagCategory::find($request->id);

        $removed = Upload::deleteImage($category->image->path);
        if($removed){
            $category->delete();
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
