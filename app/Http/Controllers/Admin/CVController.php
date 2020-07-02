<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;

class CVController extends Controller
{
    public function index(){
        $cvs = Document::with('user')->get();

        return view('admin.cv.index', compact('cvs'));
    }
}
