<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BagCategory;
use App\Models\Setting;

class BagCategoryController extends Controller
{
    public function show($id){
        $bags = BagCategory::find($id)->bags;
        $title = Setting::find(1)->{'section_3_title_'.session('lang')};
        $text = Setting::find(1)->{'section_3_text_'.session('lang')};

        return view('web.bags.index', compact('bags', 'title', 'text'));
    }
}
