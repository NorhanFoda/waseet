<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;

class StaticPagesController extends Controller
{
    public function getRulesAndConditions(){
        $page = StaticPage::where('name_ar', 'الشروط و الأحكام')->where('name_en', 'Rules and conditions')->first();
        $lang = \App::getLocale();
        return response()->json([
            'title' => $page->{'name_'.$lang},
            'short_description' => $page->{'short_description_'.$lang},
            'full_description' => $page{'full_description_'.$lang}
        ], 200);
    }

    public function getPolicy(){
        $page = StaticPage::where('name_ar', 'سياسة الخصوصية')->where('name_en', 'Privacy and policy')->first();
        $lang = \App::getLocale();
        return response()->json([
            'title' => $page->{'name_'.$lang},
            'short_description' => $page->{'short_description_'.$lang},
            'full_description' => $page{'full_description_'.$lang}
        ], 200);
    }

    public function getHelpCenter(){
        $page = StaticPage::where('name_ar', 'مركز المساعدة')->where('name_en', 'Help center')->first();
        $lang = \App::getLocale();
        return response()->json([
            'title' => $page->{'name_'.$lang},
            'short_description' => $page->{'short_description_'.$lang},
            'full_description' => $page{'full_description_'.$lang}
        ], 200);
    }

    public function getAboutUs(){
        $page = StaticPage::where('name_ar', 'من نحن')->where('name_en', 'About us')->first();
        $lang = \App::getLocale();
        return response()->json([
            'title' => $page->{'name_'.$lang},
            'short_description' => $page->{'short_description_'.$lang},
            'full_description' => $page{'full_description_'.$lang}
        ], 200);
    }
}
