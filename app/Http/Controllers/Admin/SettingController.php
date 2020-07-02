<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $set = Setting::find(1);

        return view('admin.setting.edit', compact('set'));
    }

    public function update(Request $request){
        $set = Setting::find(1);
        $set->update($request->all());

        if($request->has('header_logo')){
            $removed = Upload::deleteImage($set->header_logo);
            if($removed){
                $header_logo = Upload::uploadImage($request->header_logo);
                $set->update(['header_logo' => $header_logo]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }


        if($request->has('footer_logo')){
            $removed = Upload::deleteImage($set->footer_logo);
            if($removed){
                $footer_logo = Upload::uploadImage($request->footer_logo);
                $set->update(['footer_logo' => $footer_logo]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }

        if($request->has('text_after_add_image')){
            $removed = Upload::deleteImage($set->text_after_add_image);
            if($removed){
                $text_after_add_image = Upload::uploadImage($request->text_after_add_image);
                $set->update(['text_after_add_image' => $text_after_add_image]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }

        session()->flash('success', trans('admin.updated'));
        return back();
    }
}
