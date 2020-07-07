<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Classes\Upload;

class SettingController extends Controller
{
    public function edit()
    {
        $set = Setting::find(1);

        return view('admin.setting.edit', compact('set'));
    }

    public function update(Request $request){
        $set = Setting::find(1);

        $set->update([
            'welcome_text_ar' => $request->welcome_text_ar,
            'welcome_text_en' => $request->welcome_text_en,
            'text_before_add_ar' => $request->text_before_add_ar,
            'text_before_add_en' => $request->text_before_add_en,
            'text_after_add_ar' => $request->text_after_add_ar,
            'text_after_add_en' => $request->text_after_add_en,
            'section_1_title_ar' => $request->section_1_title_ar,
            'section_1_title_en' => $request->section_1_title_en,
            'section_1_text_ar' => $request->section_1_text_ar,
            'section_1_text_en' => $request->section_1_text_en,
            'step_1_title_ar' => $request->step_1_title_ar,
            'step_1_title_en' => $request->step_1_title_en,
            'step_1_text_ar' => $request->step_1_text_ar,
            'step_1_text_en' => $request->step_1_text_en,
            'step_2_title_ar' => $request->step_2_title_ar,
            'step_2_title_en' => $request->step_2_title_en,
            'step_2_text_ar' => $request->step_2_text_ar,
            'step_2_text_en' => $request->step_2_text_en,
            'step_3_title_ar' => $request->step_3_title_ar,
            'step_3_title_en' => $request->step_3_title_en,
            'step_3_text_ar' => $request->step_3_text_ar,
            'step_3_text_en' => $request->step_3_text_en,
            'section_2_title_ar' => $request->section_2_title_ar,
            'section_2_title_en' => $request->section_2_title_en,
            'section_2_text_ar' => $request->section_2_text_ar,
            'section_2_text_en' => $request->section_2_text_en,
            'section_3_title_ar' => $request->section_3_title_ar,
            'section_3_title_en' => $request->section_3_title_en,
            'section_3_text_ar' => $request->section_3_text_ar,
            'section_3_text_en' => $request->section_3_text_en,
            'footer_text_ar' => $request->footer_text_ar,
            'footer_text_en' => $request->footer_text_en,
            'contact_us_title_ar' => $request->contact_us_title_ar,
            'contact_us_title_en' => $request->contact_us_title_en,
            'contact_us_text_ar' => $request->contact_us_text_ar,
            'contact_us_text_en' => $request->contact_us_text_en,
            'saved_title_ar' => $request->saved_title_ar,
            'saved_title_en' => $request->saved_title_en,
            'saved_text_ar' => $request->saved_text_ar,
            'saved_text_en' => $request->saved_text_en,
        ]);

        if($request->has('header_logo')){
            $removed = Upload::deleteImage($set->header_logo);
            dump($removed);
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
            dump($removed);
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
            dump($removed);
            if($removed){
                $text_after_add_image = Upload::uploadImage($request->text_after_add_image);
                $set->update(['text_after_add_image' => $text_after_add_image]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }

        if($request->has('step_1_image')){
            $removed = Upload::deleteImage($set->step_1_image);
            dump($removed);
            if($removed){
                $step_1_image = Upload::uploadImage($request->step_1_image);
                $set->update(['step_1_image' => $step_1_image]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }

        if($request->has('step_2_image')){
            $removed = Upload::deleteImage($set->step_2_image);
            dump($removed);
            if($removed){
                $step_2_image = Upload::uploadImage($request->step_2_image);
                $set->update(['step_2_image' => $step_2_image]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }

        if($request->has('step_3_image')){
            $removed = Upload::deleteImage($set->step_3_image);
            dump($removed);
            if($removed){
                $step_3_image = Upload::uploadImage($request->step_3_image);
                $set->update(['step_3_image' => $step_3_image]);
            }
            else{
                session()->flash('error', trans('admin.error'));
                return back();
            }
        }
        dd('end');

        session()->flash('success', trans('admin.updated'));
        return back();
    }
}
