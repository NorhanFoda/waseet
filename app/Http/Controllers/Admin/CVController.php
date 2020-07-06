<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;

class CVController extends Controller
{
    public function index(){
        $cvs = Document::all();
        return view('admin.cv.index', compact('cvs'));
    }
}
