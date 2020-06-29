<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Nationality;
use App\Models\Material;
use App\Models\EduLevel;
use App\Models\Country;
use App\Models\Image;
use App\Classes\Upload;
use App\Http\Requests\Teachers\DirectTeacherRequest;
use App\Http\Requests\Teachers\EditDirectTeacherRequest;

class DirectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::whereHas('roles', function($q){
            $q->where('name', 'direct_teacher');
        })->get();

        return view('admin.direct_teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalities = Nationality::all();
        $materials = Material::all();
        $levels = EduLevel::all();
        $countries = Country::all();
        return view('admin.direct_teachers.create', compact('nationalities', 'materials', 'levels', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectTeacherRequest $request)
    {
        $teacher = User::create($request->all());
        $teacher->assignRole('direct_teacher');
        foreach($request->material_ids as $id){
            $teacher->materials()->attach($id);
        }

        if($request->has('image')){
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $teacher->id,
                'imageRef_type' => 'App\User'
            ]);
            $teacher->image()->save($image);
        }

        if($teacher){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('direct_teachers.index');
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
        $teacher = User::with('image', 'ratings.user', 'country', 'city', 'materials', 'edu_level', 'nationality')->find($id);
        return view('admin.direct_teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nationalities = Nationality::all();
        $materials = Material::all();
        $levels = EduLevel::all();
        $countries = Country::all();
        $teacher = User::find($id);
        return view('admin.direct_teachers.edit', compact('nationalities', 'materials', 'levels', 'countries', 'teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDirectTeacherRequest $request, $id)
    {
        $teacher = User::find($id);
        $teacher->update($request->all());
        foreach($request->material_ids as $id){
            $teacher->materials()->attach($id);
        }

        if($request->has('image')){
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if($teacher->image != null){
                $removed = Upload::deleteImage($teacher->image->path);
                if($removed){
                    $image_url = Upload::uploadImage($request->image);
                    $teacher->image->update([
                        'path' => $image_url,
                    ]);
                }
                else{
                    session()->flash('message', trans('admin.error'));
                    return redirect()->route('direct_teachers.index');        
                }
            }
            else{
                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => $teacher->id,
                    'imageRef_type' => 'App\User'
                ]);
                $teacher->image()->save($image);
            }
        }

        if($teacher){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('direct_teachers.index');
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

    public function deleteDirectTeacher(Request $request){
        $teacher = User::find($request->id);
        $removed = false;
        
        if($teacher->image != null){
            $removed = Upload::deleteImage($teacher->image->path);
        }

        if($removed){
            Image::where('imageRef_id', $teacher->id)->first()->delete();
        }
        
        $teacher->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
