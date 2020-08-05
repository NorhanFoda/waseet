<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Job\JobResource;
use App\Http\Resources\Job\JobDetailsResource;
use App\Models\Job;
use App\Classes\Upload;
use App\Classes\SendEmail;
use Auth;

class JobsController extends Controller
{

    public function index(){

        return response()->json([
            'data' => JobResource::collection(Job::with(['city', 'country', 'specialization'])->where('approved', 1)->get()),
        ], 200);
    }

    public function getJobDetails($id){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){

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

    public function applyJob(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
    
            // Only job seeker can apply to job
            if(!auth()->user()->hasRole('job_seeker')){
                return response()->json([
                    'error' => trans('web.login_as_job_seeker')
                ], 404);
            }
    
            $this->validate($request, [
                'job_id' => 'required',
                'email' => 'unique:users,email,'.auth()->user()->id
            ]);
    
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
    
}
