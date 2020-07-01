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
}
