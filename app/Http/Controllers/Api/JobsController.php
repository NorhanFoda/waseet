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
use App\Http\Resources\Job\editJobResource;
use App\Models\Save;
use App\Models\Bag;
use App\User;
use Auth;
use App\Http\Requests\Job\ApplyToJobRequest;
use App\Jobs\SendEmailJob;
use App\Models\Notification;
use App\Models\DeviceToken;
use App\Classes\Notify;


class JobsController extends Controller
{
    // Get all jobs
    public function index(){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

            // only job seekers, teachers and organizations can view list of jobs
            if(auth()->user()->hasRole('job_seeker') || auth()->user()->hasRole('direct_teacher') || 
                auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('organization')){

                return response()->json([
                    'data' => JobResource::collection(Job::with(['specialization'])->where('approved', 1)->get()),
                ], 200);

            }
            else{
                return response()->json([
                    'data' => trans('web.login_as_seeker_or_teacher')
                ], 200);
            }
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // get job details only for auth user with job_seeker or organization roles
    public function getJobDetails($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){

                // Only job seeker and organozation has permission to view job details
                if(auth()->user()->hasRole('job_seeker') || auth()->user()->hasRole('organization')){
                    return response()->json([
                        'data' => new JobDetailsResource(Job::find($id)),
                    ], 200);
                }
                else{
                    return response()->json([
                        'error' => trans('web.login_as_job_seeker_or_org')
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
                auth()->user()->update(['salary_month' => $request->salary]);
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
                            'error' => trans('api.error')
                        ], 404);
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
                    Notify::NotifyUser(Job::find($request->job_id)->announcer->tokens, $not->msg_ar, 'job_apply', Job::find($request->job_id)->announcer->id);
                }
                else{
                    Notify::NotifyUser(Job::find($request->job_id)->announcer->tokens, $not->msg_en, 'job_apply', Job::find($request->job_id)->announcer->id);
                }

                $details['email'] = Job::find($request->job_id)->announcer->email;
                $details['link'] = route('profile.show', auth()->user()->id);
                $details['seeker'] = auth()->user();
                $details['type'] = 'apply_to_job';
                dispatch(new SendEmailJob($details));
        
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
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            // only organization can announce job
            if(!auth()->user()->hasRole('organization')){
                return response()->json([
                    'error' => trans('web.login_as_roganization')
                ], 404);
            }
            return response()->json([
                'data' => SpecializationResource::collection(Specialization::all())
            ], 200);

        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // create job
    public function anounceJob(JobRequest $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                //only organization can announce job
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
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                //only organization can edit job announce
                if(!auth()->user()->hasRole('organization')){
                    return response()->json([
                        'error' => trans('web.login_as_roganization')
                    ], 404);
                }

                $job = Job::find($id);

                if($job ==  null){
                    return response()->json([
                        'error' => trans('api.job_not_found')
                    ], 404);
                }

                if($job->announcer->id != auth()->user()->id){
                    return response()->json([
                        'error' => trans('api.login_as_roganization')
                    ], 404);
                }

                return response()->json([
                    'job' => new editJobResource($job),
                    'specializations' => SpecializationResource::collection(Specialization::all())
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
                'error' => trans('admin.error')
            ], 404);
        }
    }

    // update job
    public function editJob(JobRequest $request, $id){

        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                //only organization can edit job announce
                if(!auth()->user()->hasRole('organization')){
                    return response()->json([
                        'error' => trans('web.login_as_roganization')
                    ], 404);
                }
    
                $job = Job::find($id);

                if($job ==  null){
                    return response()->json([
                        'error' => trans('api.job_not_found')
                    ], 404);
                }

                $job->update($request->all());
                $job->update(['approved' => 0]);

                // $job->update([
                //     'name_ar' => $request->name_ar,
                //     'name_en' => $request->name_en,
                //     'work_hours' => $request->work_hours,
                //     'exper_years' => $request->exper_years,
                //     'required_number' => $request->required_number,
                //     'free_places' => $request->free_places,
                //     'description_ar' => $request->description_ar,
                //     'description_en' => $request->description_en,
                //     'required_age' => $request->required_age,
                //     'salary' => $request->salary,
                //     'lat' => $request->lat,
                //     'long' => $request->long,
                //     'address' => $request->address,
                //     // 'country_id' => $request->country_id,
                //     // 'city_id' => $request->city_id,
                //     'approved' => 0,
                // ]);
    
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
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            // Only job seeker can apply to job
            if(!auth()->user()->hasRole('job_seeker')){
                return response()->json([
                    'error' => trans('web.login_as_job_seeker')
                ], 404);
            }

            $jobs = Job::with(['specialization'])->where('approved', 1)->get();

            return response()->json([
                'jobs' => ApplyJobFormResource::collection($jobs),
            ], 200);
        }
        else{
            return response()->json([
                'error' => trans('api.unauthorized')
            ], 400);
        }
    }

    // get all jobs of the authed user with organization role
    public function getOrganizationJobs(){

        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            if(app('request')->header('Authorization') == 'Bearer '.auth()->user()->api_token){
                // only organization can view her jobs
                if(!auth()->user()->hasRole('organization')){
                    return response()->json([
                        'error' => trans('web.login_as_roganization')
                    ], 404);
                }
    
                return response()->json([
                    'data' => JobResource::collection(auth()->user()->job_announces()->where('approved', 1)->get()),
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
    
}
