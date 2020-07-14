<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\BagCategory;
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
        $sliders = Slider::all();
        $cats = BagCategory::with('image')->get();
        $set = Setting::find(1);
        return view('web.home.index', compact('sliders', 'set', 'cats'));
    }
}
