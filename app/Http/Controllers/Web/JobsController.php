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
use App\Jobs\SendEmailJob;
use Auth;
use App\Models\Notification;
use App\Classes\Notify;


class JobsController extends Controller
{
    // Get all jobs
    public function index(){
        if(Auth::check()){
            // only job seekers, teachers and organizations can view list of jobs
            if(auth()->user()->hasRole('job_seeker') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('organization')){

                $title = Setting::find(1)->{'section_1_title_'.session('lang')};
                $text = Setting::find(1)->{'section_1_text_'.session('lang')};
                $jobs = Job::with(['city', 'country', 'specialization'])->where('approved', 1)->get();

                return view('web.jobs.index', compact('title', 'text', 'jobs'));
            }
        }
        else{
            session()->flash('warning', trans('web.login_as_seeker_or_teacher'));
            return redirect()->back();
        }
    }

    // Get jos details for auth user with job_seeker or organization roles
    public function show($id){

        if(!auth()->user()){
            session()->flash('warning', trans('web.login_to_apply'));
            return redirect()->back();
        }

        // Only job seeker can view job details
        if(Auth::check() && auth()->user()->hasRole('job_seeker')){

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

        // only job seeker can apply to job
        if(!auth()->user()->hasRole('job_seeker')){
            session()->flash('warning', trans('web.login_as_job_seeker'));
            return redirect()->back();
        }

        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $jobs = Job::get(['name_ar', 'name_en', 'id', 'address', 'lat', 'long']);

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
            'email' => 'sometimes|unique:users,email,'.auth()->user()->id,
            'phone_main' => 'sometimes|unique:users,phone_main,'.auth()->user()->id,
            'cv' => 'sometimes|mimetypes:application/pdf|max:10000',
        ]);

        $cv_path = auth()->user()->document != null ? auth()->user()->document->path : '';

        $data = $request->except(['_token'. '_method', 'full', 'sec_full']);

        // handling phone according to stupids opinion
        $data['phone_main'] = $request->full.','.$request->phone_main;
        if($request->has('phone_secondary')){
            $data['phone_secondary'] = $request->sec_full.','.$request->phone_secondary;
        }

        auth()->user()->update($data);

        auth()->user()->job_applications()->attach($request->job_id);

        if($request->has('cv')){
            $removed = Upload::deletePDF($cv_path);
            if($removed){
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
        

        // Send job applicant notification to organization
        $not = Notification::create([
            'msg_ar' => 'لقد قام أحد الباحثين عن عمل بالتقدم لوظيفة لديك',
            'msg_en' => 'A Job Seeker Has Applied To Your Job Announce',
            // 'image' => 'http://beta.bestlook.sa/images/logo1.png',
            'user_id' => Job::find($request->job_id)->announcer->id,
            'read' => 0
        ]);
        if(\App::getLocale() == 'ar'){
            Notify::NotifyUser(Job::find($request->job_id)->announcer->tokens, $not->msg_ar, 'تقدم لوظيفة', 'job_apply', auth()->user()->id);
        }
        else{
            Notify::NotifyUser(Job::find($request->job_id)->announcer->tokens, $not->msg_en, 'Job apply', 'job_apply', auth()->user()->id);
        }

        $details['email'] = Job::find($request->job_id)->announcer->email;
        $details['link'] = route('profile.show', auth()->user()->id);
        $details['seeker'] = auth()->user();
        $details['type'] = 'apply_to_job';
        dispatch(new SendEmailJob($details));

        session()->flash('success', trans('web.job_applied'));
        return redirect()->route('jobs.web_index');
    }

    // return create job form
    public function getAddJobForm(){
        // only organozation can see announce job form
        if(!auth()->user()->hasRole('organization')){
            session('warning', trans('web.login_as_roganization'));
            return redirect()->back();
        }

        // $countries = Country::all();
        $pecializations = Specialization::all();
        return view('web.jobs.create', compact('pecializations'));
    }

    // save created job
    public function storeJob(JobRequest $request){

        // only organozation can create a new job announce
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
    
        // only organozation can view list of her jobs
        if(!auth()->user()->hasRole('organization')){
            session('warning', trans('web.login_as_roganization'));
            return redirect()->back();
        }

        $title = Setting::find(1)->{'section_1_title_'.session('lang')};
        $text = Setting::find(1)->{'section_1_text_'.session('lang')};
        $jobs = auth()->user()->job_announces()->where('approved', 1)->get();

        return view('web.jobs.index', compact('title', 'text', 'jobs'));
    }

    // return edit job form
    public function getEditJobForm($id){

        // only organozation can view edit job form
        if(!auth()->user()->hasRole('organization')){
            session('warning', trans('web.login_as_roganization'));
            return redirect()->back();
        }

        $job = auth()->user()->job_announces()->find($id);
        $countries = Country::all();
        $cities = City::where('country_id', $job->country_id)->get();
        $pecializations = Specialization::all();

        return view('web.jobs.edit', compact('job', 'countries', 'cities', 'pecializations'));
    }

    // update the edited job
    public function updateJob(JobRequest $request, $id){

        // only organozation can update a job
        if(!auth()->user()->hasRole('organization')){
            session('warning', trans('web.login_as_roganization'));
            return redirect()->back();
        }

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
