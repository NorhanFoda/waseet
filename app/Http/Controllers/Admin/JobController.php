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
        $countries = Country::all();
        $cities = City::all();
        $specializations = Specialization::all();
        return view('admin.jobs.create', compact('countries', 'cities', 'specializations'));
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
            //Send mail to subscripers
            $subs = SubScriber::all();
            foreach($subs as $sub){
                SendEmail::Subscripe($sub->email, route('jobs.details', $job->id), 'job');
            }

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
        $countries = Country::all();
        $job = Job::find($id);
        $cities = City::where('country_id', $job->country_id)->get();
        return view('admin.jobs.edit', compact('countries', 'cities', 'job'));
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
        $job->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'work_hours' => $request->work_hours,
            'exper_years' => $request->exper_years,
            'required_number' => $request->required_number,
            'free_places' => $request->free_places,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'required_age' => $request->required_age,
            'salary' => $request->salary,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ]);
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
        $job = Job::find($request->id);
        $job->update(['approved' => $request->approved]);

        if($job->approved == 1){
            //Send mail to subscripers
            $subs = SubScriber::all();
            foreach($subs as $sub){
                SendEmail::Subscripe($sub->email, route('jobs.details', $job->id), 'job');
            }

            //Send approval mail to Announcer
            SendEmail::SendApprovalMail($job->announcer->email, route('jobs.details', $job->id), 'approved');
        }
        else{
            //Send refuse mail to Announcer
            $set = Setting::find(1);
            SendEmail::SendApprovalMail($job->announcer->email, $set, 'refused');
        }
    }
}
