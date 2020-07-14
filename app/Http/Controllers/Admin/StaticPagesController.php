<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use App\Models\Goal;
use App\Http\Requests\StaticPages\StaticPageRequest;

class StaticPagesController extends Controller
{
    public function index(){
        $static_pages = StaticPage::all();
        return view('admin.static_pages.index', compact('static_pages'));
    }

    public function edit($id){
        $page = StaticPage::with('goals')->find($id);
        return view('admin.static_pages.edit', compact('page'));
    }

    public function update(StaticPageRequest $request, $id){
        
        $page = StaticPage::find($id);
        $page->update($request->all());
        
        if($request->has('title_ars')){
            $titles_ar = $request->title_ars;
            $texts_ar = $request->text_ars;
            $titles_en = $request->title_ens;
            $texts_en = $request->text_ens;
            $goal;
            for($i = 0; $i < count($titles_ar); $i++){
                if($titles_ar[$i] != null && $titles_en[$i] != null && $texts_ar[$i] != null && $texts_en[$i] != null){
                    $goal = Goal::create([
                        'title_ar' => $titles_ar[$i],
                        'title_en' => $titles_en[$i],
                        'text_ar' => $texts_ar[$i],
                        'text_en' => $texts_en[$i],
                        'static_page_id' => $page->id
                    ]);
                    $page->goals()->save($goal);
                }
            }
        }

        if($page){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('static_pages.index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }

    public function deleteGoal(Request $request){
        Goal::find($request->id)->delete();
        return response()->json(['data' => 1], 200);
    }
}
