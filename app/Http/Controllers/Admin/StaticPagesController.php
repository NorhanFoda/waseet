<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use App\Http\Requests\StaticPages\StaticPageRequest;

class StaticPagesController extends Controller
{
    public function index(){
        $static_pages = StaticPage::all();
        return view('admin.static_pages.index', compact('static_pages'));
    }

    public function edit($id){
        $page = StaticPage::find($id);
        return view('admin.static_pages.edit', compact('page'));
    }

    public function update(StaticPageRequest $request, $id){
        $page = StaticPage::find($id);
        $page->update($request->all());

        if($page){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('static_pages.index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }
}
