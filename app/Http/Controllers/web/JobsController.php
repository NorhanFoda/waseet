<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Bag;
use App\Models\Setting;
use App\Models\Document;
use App\Models\Country;
use App\Models\City;
use App\Models\Specialization;
use App\Classes\Upload;
use App\Models\Image;
use App\Classes\SendEmail;
use App\Http\Requests\Job\JobRequest;
use App\User;


class JobsController extends Controller
{
    // Get all jobs
    public function index(){
        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $jobs = Job::with(['city', 'country', 'specialization'])->where('approved', 1)->get();

        return view('web.jobs.index', compact('title', 'text', 'jobs'));
    }

    // Get jos details for auth user with job_seeker or organization roles
    public function show($id){

        if(!auth()->user()){
            session()->flash('warning', trans('web.login_to_apply'));
            return redirect()->back();
        }

        if(auth()->user()->hasRole('job_seeker') || auth()->user()->hasRole('organization')){
            $title = Setting::find(1)->{'section_1_title_'.session('lang')};
            $text = Setting::find(1)->{'section_1_text_'.session('lang')};
            $job = Job::with(['country', 'city', 'specialization'])->find($id);

            return view('web.jobs.show', compact('job', 'title', 'text'));
        }
        else{
            session()->flash('warning', trans('web.login_as_job_seeker'));
            return redirect()->back();
        }
    }

    // return job application form
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

    // update seeker data with the applied job id
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
            'email' => 'unique:users,email,'.auth()->user()->id,
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000',
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

        $email = Job::find($request->job_id)->announcer->email;
        $link = route('profile.show', auth()->user()->id);
        SendEmail::sendJobApply($email, auth()->user(), $link);

        session()->flash('success', trans('web.job_applied'));
        return redirect()->route('jobs.web_index');
    }

    // return create job form
    public function getAddJobForm(){
        // $countries = Country::all();
        $pecializations = Specialization::all();
        return view('web.jobs.create', compact('pecializations'));
    }

    // save created job
    public function storeJob(JobRequest $request){

        if(!auth()->user()->hasRole('organization')){
            session('warning', trans('web.login_as_roganization'));
            return redirect()->back();
        }

        $job = Job::create($request->all());
        $job->update(['user_id' => auth()->user()->id]);

        if($request->has('image')){
            $image_url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $image_url,
                'imageRef_id' => $job->id,
                'imageRef_type' => 'App\Models\Job'
            ]);
            $job->image()->save($image);
        }

        if($job){
            session()->flash('success', trans('web.job_created'));
            return redirect()->route('jobs.web_index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }

    // get all jobs of the authed user with organization role
    public function getOrganizationJobs(){
    
        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $jobs = auth()->user()->job_announces()->where('approved', 1)->get();

        return view('web.jobs.index', compact('title', 'text', 'jobs'));
    }

    // return edit job form
    public function getEditJobForm($id){

        $job = auth()->user()->job_announces()->find($id);
        $countries = Country::all();
        $cities = City::where('country_id', $job->country_id)->get();
        $pecializations = Specialization::all();

        return view('web.jobs.edit', compact('job', 'countries', 'cities', 'pecializations'));
    }

    // update the edited job
    public function updateJob(JobRequest $request, $id){

        $job = Job::find($id);
        $job->update($request->all());
        $job->update(['approved' => 0]);

        if($request->has('image')){
            if($job->image != null){
                $removed = Upload::deleteImage($job->image->path);
                if($removed){
                    $image_url = Upload::uploadImage($request->image);
                    $job->image->update([
                        'path' => $image_url,
                    ]);
                }
                else{
                    session()->flash('message', trans('admin.error'));
                    return redirect()->back();        
                }
            }
            else{
                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => $job->id,
                    'imageRef_type' => 'App\User'
                ]);
                $job->image()->save($image);
            }
        }

        if($job){
            session()->flash('success', trans('web.job_updated'));
            return redirect()->route('jobs.web_index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }
}
