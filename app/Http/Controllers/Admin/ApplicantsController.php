<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Job;
use App\Models\Notification;
use App\Classes\Notify;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicants = User::withCount('job_applications')->get();
        
        return view('admin.applicants.index', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seekers = User::whereHas('roles', function($q){
                $q->where('name', 'job_seeker');
            }
        )->get();

        $jobs = Job::all();

        return view('admin.applicants.create', compact('seekers', 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'job_ids' => 'required|array']);

        $applicant = User::find($request->user_id);

        //attacht the job to seeker
        $applicant->job_applications()->sync($request->job_ids);

        //attche the seeker to the announced organization
        foreach($request->job_ids as $job_id){
            $org = Job::find($job_id)->announcer;
            $org->org_applicants()->sync($applicant->id);   

            // Send job applicant notification to organization
            $not = Notification::create([
                'msg_ar' => 'لقد قام أحد الباحثين عن عمل بالتقدم لوظيفة لديك',
                'msg_en' => 'A Job Seeker Has Applied To Your Job Announce',
                // 'image' => 'http://beta.bestlook.sa/images/logo1.png',
                'user_id' => $org->id,
                'read' => 0,
                'type' => 'job_apply',
                'extra_data' => $request->user_id,
            ]);
            if(\App::getLocale() == 'ar'){
                // Notify::NotifyUser($org->tokens, $not->msg_ar, 'تقدم لوظيفة', 'job_apply', $request->user_id);
                Notify::NotifyAll($org->tokens->pluck('token'), $not, 'تقدم لوظيفة', 'job_apply', $request->user_id);
            }
            else{
                // Notify::NotifyUser($org->tokens, $not->msg_en, 'Job apply', 'job_apply', $request->user_id);
                Notify::NotifyAll($org->tokens->pluck('token'), $not, 'Job apply', 'job_apply', $request->user_id);
            }
        }

        session()->flash('success', trans('admin.created'));
        return redirect()->route('applicants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = User::with(['document', 'country', 'city', 'job_applications', 'job_organizations'])->find($id);

        return view('admin.applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = User::with('job_applications')->find($id);
        $seekers = User::whereHas('roles', function($q){
                $q->where('name', 'job_seeker');
            }
        )->get();
        $jobs = Job::all();

        return view('admin.applicants.edit', compact('applicant', 'jobs', 'seekers'));
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
        $this->validate($request, ['job_ids' => 'required|array']);

        $applicant = User::find($id);

        //attach the job to the seeker
        $applicant->job_applications()->sync($request->job_ids);

        //attach the seeker to the announced organization
        foreach($request->job_ids as $job_id){
            $org = Job::find($job_id)->announcer;
            $org->org_applicants()->sync($applicant->id);   
        }

        session()->flash('success', trans('admin.updated'));
        return redirect()->route('applicants.index');
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

    public function deleteApplicant(Request $request){
        $applicant = User::find($request->id);
        $applicant->delete();
        return response()->json([
            'data' => 1
        ], 200);
        
    }
}
