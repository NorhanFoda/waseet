<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\BagCategory;
use App\Models\Bag;
use App\Models\Job;
use App\Models\Page;
use App\User;
use App\Models\StaticPage;
use App\Models\Social;
use App\Models\Save;
use App\Models\Rating;
use App\Models\Announce;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::with('image')->where('type', 'website')->get();
        $cats = BagCategory::with('image')->get();
        $set = Setting::find(1);
        $about_us = StaticPage::with('goals')->where('name_ar', 'من نحن')->where('name_en', 'About us')->first();
        $announce = Announce::with('image')->where('appear_in_home', 1)->orderBy('created_at', 'desc')->first();
        return view('web.home.index', compact('sliders', 'set', 'cats', 'about_us', 'announce'));
    }

    // Search
    public function search(Request $request){
        $this->validate($request, ['token' => 'required']);

        $token = htmlspecialchars($request->token);
        $token = strip_tags($token);

        // search in bags
        $bags = Bag::where('name_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('name_en', 'LIKE', '%'.$token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('contents_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('contents_en', 'LIKE', '%'.$token.'%')
            ->orWhere('benefits_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('benefits_en', 'LIKE', '%'.$token.'%')
            ->get();

        // search in jobs
        if(auth()->user() != null && (auth()->user()->hasRole('job_seeker') || auth()->user()->hasRole('organization'))){
            $jobs = Job::where('name_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('name_en', 'LIKE', '%'.$token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$token.'%')
            ->get();
        }
        else{
            $jobs = [];
        }

        if(auth()->user() != null && (auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher') ||
            auth()->user()->hasRole('student') || auth()->user()->hasRole('organization'))){
                // search in users
                $teachers = User::whereHas('roles', function($q) use ($request){
                    $q->where('name', 'online_teacher')->orWhere('name', 'direct_teacher');
                })
                ->where(function($query) use ($request){
                    $query->where('name', 'LIKE', '%'.$token.'%')
                    ->orWhere('email', 'LIKE', '%'.$token.'%')
                    ->orWhere('phone_main', 'LIKE', '%'.$token.'%')
                    ->orWhere('phone_secondary', 'LIKE', '%'.$token.'%')
                    ->orWhere('bio_ar', 'LIKE', '%'.$token.'%')
                    ->orWhere('bio_en', 'LIKE', '%'.$token.'%');
                })
                ->get();
            }
            else{
                $teachers = [];
            }

        return view('web.search.index', compact('bags', 'jobs', 'teachers'));
    }

    // Save posts
    public function save(Request $request){
        
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

    // Rate posts
    public function rate(Request $request){
        $rate;

        if($request->type != 'User'){
            $rating = Rating::where('user_id', auth()->user()->id)->where('rateRef_id', $request->id)->where('rateRef_type', 'App\Models\\'.$request->type)->first();
        }
        else{
            $rating = Rating::where('user_id', auth()->user()->id)->where('rateRef_id', $request->id)->where('rateRef_type', 'App\\'.$request->type)->first();
        }

        if($rating != null){
            $rating->update(['rate' => $request->rate]);
            return response()->json([
                'msg' => trans("web.rating_updated")
            ], 200);
        }
        else{
            if($request->type != 'User'){
                $rate = Rating::create([
                    'user_id' => auth()->user()->id,
                    'rateRef_id' => $request->id,
                    'rateRef_type' => 'App\Models\\'.$request->type,
                    'rate' => $request->rate,
                ]);
                
            auth()->user()->rated_bags()->save($rate);
            }
            else{
                $rate = Rating::create([
                    'user_id' => auth()->user()->id,
                    'rateRef_id' => $request->id,
                    'rateRef_type' => 'App\\'.$request->type,
                    'rate' => $request->rate
                ]);
                auth()->user()->rated_teachers()->save($rate);

            }

            return response()->json([
                'msg' => trans("web.rated")
            ], 200);
        }
    }
}
