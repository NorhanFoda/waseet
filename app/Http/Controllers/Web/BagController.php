<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bag;
use App\Models\Setting;

class BagController extends Controller
{
    public function index(){
        $bags = Bag::all();
        $title = Setting::find(1)->{'section_3_title_'.session('lang')};
        $text = Setting::find(1)->{'section_3_text_'.session('lang')};

        return view('web.bags.index', compact('bags', 'title', 'text'));
    }

    public function show($id){
        $bag = Bag::with(['images', 'videos', 'documents'])->find($id);
        $title = Setting::find(1)->{'section_3_title_'.session('lang')};
        $text = Setting::find(1)->{'section_3_text_'.session('lang')};

        return view('web.bags.show', compact('bag', 'title', 'text'));
    }
}
