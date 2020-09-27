<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use App\Models\Setting;
use App\Models\Social;
use App\Models\ContactUs;
use App\Models\SubScriber;

class StaticPagesController extends Controller
{
    public function getPage($page){
        $page = StaticPage::where('name_en', $page)->first();
        
        return view('web.pages.index', compact('page'));
    }

    public function getContactUs(){
        $set = Setting::find(1);
        $socials = Social::all();
        return view('web.contact_us.index', compact('set', 'socials'));
    }

    public function storeContactUs(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $contact = ContactUs::create($request->all());

        if($contact){
            session()->flash('success', trans('web.message_sent'));
            return redirect()->route('home');
        }
        else{
            session()->flash('error', trans('web.error'));
            return redirect()->back();
        }
    }

    public function subscribe(Request $request){
        $this->validate($request, ['email' => 'required']);

        $sub = SubScriber::create($request->all());

        if($sub){
            session()->flash('success', trans('web.subscribed'));
            return redirect()->route('home');
        }
        else{
            session()->flash('error', trans('web.error'));
            return redirect()->back();
        }
    }
}
