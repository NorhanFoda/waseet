<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\BagCategory;
use App\Models\Bag;
use App\Models\Job;
use App\User;
use App\Models\StaticPage;
use App\Models\Social;

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
        return view('web.home.index', compact('sliders', 'set', 'cats'));
    }

    // Search
    public function search(Request $request){
        $this->validate($request, ['token' => 'required']);

        // search in bags
        $bags = Bag::where('name_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('name_en', 'LIKE', '%'.$request->token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('contents_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('contents_en', 'LIKE', '%'.$request->token.'%')
            ->orWhere('benefits_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('benefits_en', 'LIKE', '%'.$request->token.'%')
            ->get();

        // search in jobs
        $jobs = Job::where('name_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('name_en', 'LIKE', '%'.$request->token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('description_ar', 'LIKE', '%'.$request->token.'%')
            ->get();

        // search in users
        $teachers = User::where('name', 'LIKE', '%'.$request->token.'%')
            ->orWhere('email', 'LIKE', '%'.$request->token.'%')
            ->orWhere('phone_main', 'LIKE', '%'.$request->token.'%')
            ->orWhere('phone_secondary', 'LIKE', '%'.$request->token.'%')
            ->orWhere('bio_ar', 'LIKE', '%'.$request->token.'%')
            ->orWhere('bio_en', 'LIKE', '%'.$request->token.'%')
            ->get();

        return view('web.search.index', compact('bags', 'jobs', 'teachers'));
    }
}
