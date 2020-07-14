<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;

class StaticPagesController extends Controller
{
    public function aboutUs($page){
        $page = StaticPage::where('name_en', $page)->first();
        
        return view('web.pages.index', compact('page'));
    }
}
