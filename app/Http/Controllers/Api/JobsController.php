<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Job\JobResource;
use App\Http\Resources\Job\JobDetailsResource;
use App\Models\Job;
use App\Models\Specialization;
use App\Classes\Upload;
use App\Classes\SendEmail;
use App\Http\Requests\Job\JobRequest;
use App\Http\Resources\Job\ApplyJobFormResource;
use App\Http\Resources\Job\SpecializationResource;
use App\Models\Save;
use App\Models\Bag;
use App\User;
use Auth;
use App\Http\Requests\Job\ApplyToJobRequest;


class JobsController extends Controller
{
    // Get all jobs
    public function index(){

        return response()->json([
            'data' => JobResource::collection(Job::with(['city', 'country', 'specialization'])->where('approved', 1)->get()),
        ], 200);
    }

    // get job details only for auth user with job_seeker or organization roles
    public function getJobDetails($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){

                // Only job seeker and organozation has permission to view job details
                if(auth()->user()->hasRole('job_seeker') || auth()->user()->hasRole('organization')){
                    return response()->json([
                        'data' => new JobDetailsResource(Job::with(['country', 'city'])->find($id)),
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('web.login_as_job_seeker')
                    ], 404);
                }
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // update seeker data with the applied job id
    public function applyJob(ApplyToJobRequest $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                
                // Only job seeker can apply to job
                if(!auth()->user()->hasRole('job_seeker')){
                    return response()->json([
                        'error' => trans('web.login_as_job_seeker')
                    ], 404);
                }
        
                $cv_path = auth()->user()->document->path;
        
                auth()->user()->update($request->all());
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
                        return response()->josn([
                            'error' => trans('web.error')
                        ], 404);
                    }
                }
        
                $email = Job::find($request->job_id)->announcer->email;
                $link = route('profile.show', auth()->user()->id);
                SendEmail::sendJobApply($email, auth()->user(), $link);
        
                return response()->json([
                    'success' => trans('web.job_applied')
                ], 200);
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // Return create job form data
    public function announceJobFormData(){
        return response()->json([
            'data' => SpecializationResource::collection(Specialization::all())
        ], 200);
    }

    // create job
    public function anounceJob(JobRequest $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                if(!auth()->user()->hasRole('organization')){
                    return response()->json([
                        'error' => trans('web.login_as_roganization')
                    ], 404);
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
                    return response()->json([
                        'success' => trans('web.job_created')
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('admin.error')
                    ], 404);
                }
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // return edit form data
    public function editAnnounceJobFormData($id){
        $job = Job::find($id);
        return response()->json([
            'job' => $job,
            'specializations' => SpecializationResource::collection(Specialization::all())
        ], 200);
    }

    // update job
    public function editJob(JobRequest $request, $id){

        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                if(!auth()->user()->hasRole('organization')){
                    return response()->json([
                        'error' => trans('web.login_as_roganization')
                    ], 404);
                }
    
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
                    'approved' => 0,
                ]);
    
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
                            return response()->json([
                                'error' => trans('admin.error')
                            ], 404);
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
                    return response()->json([
                        'success' => trans('web.job_created'),
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('admin.error')
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'error' => trans('api.unauthorized')
                ], 400);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // Get apply to job form data
    public function applyToJobData(){
        $jobs = Job::with(['city', 'country', 'specialization'])->where('approved', 1)->get();

        return response()->json([
            'jobs' => ApplyJobFormResource::collection($jobs),
        ], 200);
    }
    
}
