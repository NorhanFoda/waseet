<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\Upload;
use App\Classes\Notify;
use App\Models\SubScriber;
use App\Models\Notification;
use App\Classes\SendEmail;
// use App\Jobs\SendEmailJob;
use App\Models\DeviceToken;

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
        else if($user->roles[0]->name == 'job_seeker'){
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
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|confirmed|min:9'
        ]);

        $user = User::find($id);

        $data = $request->except(['password']);

        $user->update($data);

        if($request->password != null){
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

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
        $user = User::with(['tokens'])->find($request->id);
        $user->update(['approved' => $request->approved]);

        if( $request->approved == 1){
            SendEmail::Subscripe($user->email, route('login.form'), 'notify_user');

            // Send account approved notification to user
            $not = Notification::create([
                'msg_ar' => ' لقد تم تفعيل حسابك من قبل إدارة وسيط المعلم',
                'msg_en' => 'Your account was approved by Waset Elmo3lm adminstration',
                'user_id' => $user->id,
                'read' => 0,
                'type' => 'teacher_approve_account',
                'extra_data' => $user->id,
            ]);

            if($user->hasRole('online_teacher') || $user->hasRole('direct_teacher')){
                if(\App::getLocale() == 'ar'){
                    // Notify::NotifyUser($user->tokens, $not->msg_ar, 'تفعيل الحساب', 'teacher_approve_account', $user->id);
                    Notify::NotifyAll($user->tokens->pluck('token'), $not, 'تفعيل الحساب', 'teacher_approve_account', $user->id);
                }
                else{
                    // Notify::NotifyUser($user->tokens, $not->msg_en, 'Account approve', 'teacher_approve_account', $user->id);
                    Notify::NotifyAll($user->tokens->pluck('token'), $not, 'Account approve', 'teacher_approve_account', $user->id);
                }
            }
            else if($user->hasRole('job_seeker')){
                if(\App::getLocale() == 'ar'){
                    // Notify::NotifyUser($user->tokens, $not->msg_ar, 'تفعيل الحساب', 'seeker_approve_account', $user->id);
                    Notify::NotifyAll($user->tokens->pluck('token'), $not, 'تفعيل الحساب', 'seeker_approve_account', $user->id);
                }
                else{
                    // Notify::NotifyUser($user->tokens, $not->msg_en, 'Account approve', 'seeker_approve_account', $user->id);
                    Notify::NotifyAll($user->tokens->pluck('token'), $not, 'Account approve', 'seeker_approve_account', $user->id);
                }
            }

        }
        
        //Send mail to subscripers
        if($request->approved == 1){
            if($user->hasRole('online_teacher') || $user->hasRole('direct_teacher')){

                // Send teacher registered notification to all users
                $users = User::with(['tokens'])->where('id', '!=', $user->id)->get();
                if(count($users) > 0){
                    foreach($users as $user_2){
                        $notification = Notification::create([
                            'msg_ar' => 'لقد تم تسجيل معلم جديد',
                            'msg_en' => 'A New Teacher is Registered',
                            'user_id' => $user_2->id,
                            'read' => 0,
                            'type' => 'teacher_registered',
                            'extra_data' => $user->id,
                        ]);
                    }
                }
                
                $tokens = DeviceToken::where('user_id', '!=', $user->id)->pluck('token');
                Notify::NotifyAll($tokens, $notification, \App::getLocale() == 'ar' ? 'معلم جديد' : 'New Teacher',  'teacher_registered', $user->id);

                // $subs = SubScriber::get(['email']);
                // $details['emails'] = $subs;
                // $details['link'] = route('teachers.show', $user->id);
                // $details['type2'] = 'subscripe';
                // $details['type'] = 'teacher';
                // dispatch(new SendEmailJob($details));
            }
        }

        return response()->json([
            'data' => 1
        ], 200);
    }
}
