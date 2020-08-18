<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Stage;
use App\Http\Requests\Students\StudentRequest;
use App\Http\Requests\Students\EditStudentRequest;
use App\Classes\Upload;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::with('stage')->whereHas('roles', function($q){
            $q->where('name', 'student');
        })->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::all();

        return view('admin.students.create', compact('stages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $student = User::create($request->all());
        $student->update(['is_verified' => 1, 'password' => Hash::make($request->password)]);
        $student->assignRole('student');

        if($request->has('image')){
            $image_url = Upload::uploadImage($request->image);

            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $student->id,
                'imageRef_type' => 'App\User'
            ]);
            $student->image()->save($image);
        }

        if($student){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('students.index');
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
        $std = User::with(['image', 'stage'])->find($id);

        return view('admin.students.show', compact('std'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $std = User::with(['image', 'stage'])->find($id);
        $stages = Stage::all();

        return view('admin.students.edit', compact('std', 'stages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStudentRequest $request, $id)
    {
        $std = User::find($id);
        $std->update($request->all());

        if($request->has('image')){

            if($std->image != null){
                $removed = Upload::deleteImage($std->image->path);
                if($removed){
                    $image_url = Upload::uploadImage($request->image);
                    $std->image->update([
                        'path' => $image_url,
                    ]);
                }
                else{
                    session()->flash('error', trans('admin.error'));
                    return redirect()->route('students.index');        
                }
            }
            else{
                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => $std->id,
                    'imageRef_type' => 'App\User'
                ]);
                $std->image()->save($image);
            }
        }

        if($std){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('students.index');
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

    public function deleteStudent(Request $request){
        $std = User::find($request->id);
        $removed = false;
        
        if($std->image != null){
            $removed = Upload::deleteImage($std->image->path);
        }

        if($removed){
            Image::where('imageRef_id', $std->id)->first()->delete();
        }
        
        $std->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }
}
