<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Country;
use App\Models\City;
use App\Models\Image;
use App\Http\Requests\Job\JobRequest;
use App\Classes\Upload;
use App\Models\SubScriber;
use App\Classes\SendEmail;
use App\Models\Setting;
use App\Models\Specialization;
use App\Jobs\SendEmailJob;
use App\Classes\Notify;
use App\User;
use App\Models\DeviceToken;
use App\Models\Notification;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $countries = Country::all();
        // $cities = City::all();
        $specializations = Specialization::all();
        return view('admin.jobs.create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $job = Job::create($request->all());
        // $job->cities()->attach($request->city_ids);
        $job->update(['user_id' => auth()->user()->id, 'approved' => 1]);

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

            // Send job created notification to all job seekers
            $users = User::whereHas('roles', function($q){
                $q->where('name', 'job_seeker');
            })->get();
            if(count($users) > 0){
                foreach($users as $user){
                    $notification = Notification::create([
                        'msg_ar' => 'لقد تم إضافة وظيفة جديدة',
                        'msg_en' => 'A New Job Added',
                        'user_id' => $user->id,
                        'read' => 0
                    ]);
                }
            }
            $tokens = DeviceToken::pluck('token');
            Notify::NotifyAll($tokens, $notification, \App::getLocale() == 'ar' ? 'وظيفة جديدة' : 'New job',  'job_created', $job->id);

            //Send mail to subscripers
            $subs = SubScriber::get(['email']);
            $details['emails'] = $subs;
            $details['link'] = route('jobs.details', $job->id);
            $details['type2'] = 'subscripe';
            $details['type'] = 'job';
            dispatch(new SendEmailJob($details));

            session()->flash('success', trans('admin.created'));
            return redirect()->route('jobs.index');
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
        $job = Job::with(['image', 'country', 'city', 'applicants.roles' => function($q){
                $q->where('name', 'job_seeker')->get();
            }
        , 'announcer.roles' => function($q){
                $q->where('name', 'organization')->get();
            }
        ])->find($id);

        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $countries = Country::all();
        $job = Job::find($id);
        // $cities = City::where('country_id', $job->country_id)->get();
        $specializations = Specialization::all();
        return view('admin.jobs.edit', compact('job', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {
        $job = Job::find($id);
        $job->update($request->all());
        // $job->cities()->sync($request->city_ids);

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
                    return redirect()->route('jobs.index');        
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
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('jobs.index');
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

    public function deleteJob(Request $request){
        $job = Job::find($request->id);
        $removed = false;
        
        if($job->image != null){
            $removed = Upload::deleteImage($job->image->path);
        }

        if($removed){
            Image::where('imageRef_id', $job->id)->first()->delete();
        }
        
        $job->delete();
        return response()->json([
            'data' => 1
        ], 200);
    }

    public function updateJobStatus(Request $request){
        $job = Job::with(['announcer'])->find($request->id);
        $job->update(['approved' => $request->approved]);

        if($job->approved == 1){

            // Send job created notification to all job seekers
            $users = User::whereHas('roles', function($q){
                $q->where('name', 'job_seeker');
            })->get();
            if(count($users) > 0){
                foreach($users as $user){
                    $notification = Notification::create([
                        'msg_ar' => 'لقد تم إضافة وظيفة جديدة',
                        'msg_en' => 'A New Job Added',
                        'user_id' => $user->id,
                        'read' => 0
                    ]);
                }
            }
            $tokens = DeviceToken::pluck('token');
            Notify::NotifyAll($tokens, $notification, \App::getLocale() == 'ar' ? 'وظيفة جديدة' : 'New job',  'job_created', $job->id);


            // Send job approved notification to announcer
            $not = Notification::create([
                'msg_ar' => ' لقد تم تفعيل الوظيفة من قبل إدراة وسيط المعلم',
                'msg_en' => 'Jon was approved by Waset Elmo3lm adminstration',
                // 'image' => 'http://beta.bestlook.sa/images/logo1.png',
                'user_id' => $job->announcer->id,
                'read' => 0
            ]);
            if(\App::getLocale() == 'ar'){
                Notify::NotifyUser($job->announcer->tokens, $not->msg_ar, 'تفعيل الوظيفة', 'job_approved', $job->id);
            }
            else{
                Notify::NotifyUser($job->announcer->tokens, $not->msg_en, 'job approved', 'job_approved', $job->id);
            }


            $subs = SubScriber::get(['email']);
            $details['emails'] = $subs;
            $details['link'] = route('jobs.details', $job->id);
            $details['type2'] = 'subscripe';
            $details['type'] = 'job';
            dispatch(new SendEmailJob($details));
            

            //Send approval mail to Announcer
            $details['email'] = $job->announcer->email;
            $details['link'] = route('jobs.details', $job->id);
            $details['type2'] = 'approve_job';
            $details['type'] = 'approved';
            dispatch(new SendEmailJob($details));
        }
        else{
            //Send refuse mail to Announcer
            $set = Setting::find(1);
            $details['email'] = $job->announcer->email;
            $details['link'] = route('jobs.details', $job->id);
            $details['type2'] = 'approve_job';
            $details['type'] = 'refused';
            dispatch(new SendEmailJob($details));
        }
    }
}
