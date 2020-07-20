<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Bag;
use App\Models\Setting;
use App\Models\Document;
use App\Models\Save;
use App\Classes\Upload;
use App\Classes\SendEmail;
use App\User;


class JobsController extends Controller
{
    public function index(){
        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $jobs = Job::all();

        return view('web.jobs.index', compact('title', 'text', 'jobs'));
    }

    public function show($id){

        if(!auth()->user()){
            session()->flash('warning', trans('web.login_to_apply'));
            return redirect()->back();
        }

        if(!auth()->user()->hasRole('job_seeker')){
            session()->flash('warning', trans('web.login_as_job_seeker'));
            return redirect()->back();
        }

        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $job = Job::with(['country', 'city'])->find($id);

        return view('web.jobs.show', compact('job', 'title', 'text'));
    }

    public function applyToJob($job_id){
        
        if(!auth()->user()){
            session()->flash('warning', trans('web.login_to_apply'));
            return redirect()->back();
        }

        if(!auth()->user()->hasRole('job_seeker')){
            session()->flash('warning', trans('web.login_as_job_seeker'));
            return redirect()->back();
        }

        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $jobs = Job::get(['name_ar', 'name_en', 'id']);

        return view('web.jobs.apply', compact('jobs', 'title', 'text', 'job_id'));
    }

    public function updateSeekerData(Request $request){

        if(!auth()->user()){
            session()->flash('warning', trans('web.login_to_apply'));
            return redirect()->back();
        }

        if(!auth()->user()->hasRole('job_seeker')){
            session()->flash('warning', trans('web.login_as_job_seeker'));
            return redirect()->back();
        }

        $this->validate($request, [
            'job_id' => 'required',
            'email' => 'unique:users,email,'.auth()->user()->id
        ]);

        $cv_path = auth()->user()->document->path;
        // $email = auth()->user()->email;

        auth()->user()->update($request->all());
        auth()->user()->job_applications()->attach($request->job_id);

        if($request->has('cv')){
            $removed = Upload::deletePDF($cv_path);
            if($removed){
                // Document::where('documentRef_id', auth()->user()->id)->where('path', $cv_path)->fisrt()->delete();
                $url = Upload::uploadImage($request->cv);
                auth()->user()->document->update([
                    'path' => $url
                ]);
            }
            else{
                session()->flash('error', trans('web.error'));
                return redirect()->back();
            }
        }

        // if($email != $request->email){
        //     auth()->user()->update(['is_verified' => 0]);
        //     SendEmail::sendVerificationCode($code, $user->email);

        //     $welcome_text = Setting::find(1)->{'welcome_text_'.session('lang')};

        //     session()->flash('success', trans('web.verification_code_sent'));
        //     return view('web.auth.verify', compact('welcome_text', 'email'));

        // }

        session()->flash('success', trans('web.job_applied'));
        return redirect()->route('jobs.web_index');
    }

    public function saveJob(Request $request){
        
        $save;
        $saved;

        if($request->type != 'User'){
            $saved = Save::where('user_id', auth()->user()->id)->where('saveRef_id', $request->id)->where('saveRef_type', 'App\Models\\'.$request->type)->first();
        }
        else{
            $saved = Save::where('user_id', auth()->user()->id)->where('saveRef_id', $request->id)->where('saveRef_type', 'App\\'.$request->type)->first();
        }

        if($saved != null){
            $saved->delete();
            return response()->json([
                'msg' => trans("web.deleted_from_saved")
            ], 200);
        }
        else{
            if($request->type != 'User'){
                $save = Save::create([
                    'user_id' => auth()->user()->id,
                    'saveRef_id' => $request->id,
                    'saveRef_type' => 'App\Models\\'.$request->type
                ]);
            }
            else{
                $save = Save::create([
                    'user_id' => auth()->user()->id,
                    'saveRef_id' => $request->id,
                    'saveRef_type' => 'App\\'.$request->type
                ]);
            }

            if($request->type == 'Job'){
                $job = Job::find($request->id);
                $job->saves()->save($save);
                auth()->user()->saved_jobs()->save($save);
            }
            else if($request->type == 'Bag'){
                $bag = Bag::find($request->id);
                $bag->saves()->save($save);
                auth()->user()->saved_bags()->save($save);
            }
            else if($request->type == 'User'){
                $user = User::find($request->id);
                $user->saves()->save($save);
                auth()->user()->saved_teachers()->save($save);
            }

            return response()->json([
                'msg' => trans("web.added_to_saved")
            ], 200);
        }
    }
}
