<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\Upload;
use App\Models\SubScriber;
use App\Classes\SendEmail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('roles')->find($id);

        if($user->roles[0]->name == 'student'){
            return redirect()->route('students.show', $id);
        }
        else if($user->roles[0]->name == 'direct_teacher'){
            return redirect()->route('direct_teachers.show', $id);
        }
        else if($user->roles[0]->name == 'online_teacher'){
            return redirect()->route('online_teachers.show', $id);
        }
        else if($user->roles[0]->name == 'seeker'){
            return redirect()->route('seekers.show', $id);
        }
        else if($user->roles[0]->name == 'organization'){
            return redirect()->route('organizations.show', $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('image')->find($id);

        return view('admin.users.edit', compact('user'));
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
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::find($id);

        $user->update($request->all());

        if($request->has('image')){
            if($user->image != null){
                $removed = false;
                $image_path = explode('/', $user->image->path);
                $image_name = $image_path[count($image_path) - 1];

                if($image_name != 'avatar.png'){
                    $removed = Upload::deleteImage($user->image->path);
                }

                if($removed){
                    $image_url = Upload::uploadImage($request->image);
                    $user->image->update([
                        'path' => $image_url
                    ]);
                }
                else{
                    session()->flash('error', trans('admin.error'));
                    return redirect()->back();
                }
            }
            else{
                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => $user->id,
                    'imageRef_type' => 'App\User'
                ]);
            }
        }

        session()->flash('success', trans('admin.updated'));
        return redirect()->route('admin.home');
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

    public function getSubScripers(){
        $subs = SubScriber::all();
        return view('admin.subscipers.index', compact('subs'));
    }

    public function deleteSubScripers(Request $request){
        SubScriber::find($request->id)->delete();

        return response()->json([
            'data' => 1
        ], 200);
    }

    public function approveAccount(Request $request){
        $user = User::find($request->id);
        $user->update(['approved' => $request->approved]);

        //Send mail to subscripers
        if($request->approved == 1){
            if($user->hasRole('online_teacher') || $user->hasRole('direct_teacher')){
                $subs = SubScriber::all();
                foreach($subs as $sub){
                    SendEmail::Subscripe($sub->email, route('teachers.show', $user->id), 'teacher');
                }
            }
        }

        return response()->json([
            'data' => 1
        ], 200);
    }
}
