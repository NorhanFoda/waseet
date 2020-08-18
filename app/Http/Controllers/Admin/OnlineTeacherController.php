<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Upload;
use App\User;
use App\Models\Nationality;
use App\Models\Material;
use App\Models\EduLevel;
use App\Models\Country;
use App\Models\City;
use App\Models\Image;
use App\Models\Bank;
use App\Http\Requests\Teachers\OnlineTeacherRequest;
use App\Http\Requests\Teachers\EditOnlineTeacherRequest;
use Illuminate\Support\Facades\Hash;
use App\Classes\SendEmail;
use App\Models\SubScriber;

class OnlineTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::with('edu_level')->whereHas('roles', function($q){
            $q->where('name', 'online_teacher');
        })->get();

        return view('admin.online_teachers.index', compact('teachers'));
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
        // $countries = Country::all();
        return view('admin.online_teachers.create', compact('nationalities', 'materials', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OnlineTeacherRequest $request)
    {
        $teacher = User::create($request->all());
        $teacher->assignRole('online_teacher');
        $teacher->update(['is_verified' => 1, 'password' => Hash::make($request->password), 'approved' => 0]);

        foreach($request->material_ids as $id){
            $teacher->materials()->attach($id);
            if($id == 4){
                $teacher->materials()->where('material_id', 4)->first()->pivot->update(['other_material' => $request->other_material]);
            }
        }

        if($request->has('image')){
            // $this->validate($request, [
            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $teacher->id,
                'imageRef_type' => 'App\User'
            ]);
            $teacher->image()->save($image);
        }

        if($teacher){

            //Send mail to subscripers
            // $subs = SubScriber::all();
            // foreach($subs as $sub){
            //     SendEmail::Subscripe($sub->email, route('teachers.show', $teacher->id), 'teacher');
            // }

            // session()->flash('success', trans('admin.created'));
            // return redirect()->route('online_teachers.index');
            $user_id = $teacher->id;
            $banks = Bank::all();
            $type = 'online_teacher';
            return view('admin.auth.payment', compact('banks', 'user_id', 'type'));
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
        return view('admin.online_teachers.show', compact('teacher'));

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
        // $countries = Country::all();
        $teacher = User::find($id);
        // $cities = City::where('country_id', $teacher->country_id)->get();
        return view('admin.online_teachers.edit', compact('nationalities', 'materials', 'levels', 'teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditOnlineTeacherRequest $request, $id)
    {
        $teacher = User::find($id);
        $teacher->update($request->all());
        $teacher->materials()->sync($request->material_ids);
        foreach($request->material_ids as $id){
            if($id == 4){
                $teacher->materials()->where('material_id', 4)->first()->pivot->update(['other_material' => $request->other_material]);
            }
        }


        if($request->has('image')){
            // $this->validate($request, [
            //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

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
                    return redirect()->route('online_teachers.index');        
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
            return redirect()->route('online_teachers.index');
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

    public function deleteOnlineTeacher(Request $request){
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
