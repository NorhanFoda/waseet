<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stage;
use App\Models\Material;
use App\Models\Nationality;
use App\Models\EduLevel;
use App\Models\EduType;
use App\Models\Country;
use App\Models\Image;
use App\Models\Order;
use App\Models\Bag;
use App\Classes\Upload;
use App\User;

class ProfileController extends Controller
{
    public function index(){
        return view('web.profile.index');
    }

    public function getSaved(){
        return view('web.saved.index');
    }

    public function editPersonalInfo(){
        $stages = Stage::all();
        $materials = Material::all();
        $nationalities = Nationality::all();
        $levels = EduLevel::all();
        $types = EduType::all();
        $countries = Country::all();
        $cities = auth()->user()->country->cities;

        return view('web.profile.edit', compact('stages', 'materials', 'levels', 'types', 'countries', 'nationalities', 'cities'));
    }

    public function storePersonalInfo(Request $request){

        auth()->user()->update($request->all());

        if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher')){
            foreach($request->material_ids as $id){
                auth()->user()->materials()->sync($id);
            }
        }

        if(auth()->user()->hasRole('job_seeker')){
            if($request->has('cv')){
                $removed = Upload::deletePDF(auth()->user()->document->path);
                if($removed){
                    $new_cv = Upload::uploadPDF($request->cv);
                    auth()->user()->document->update([
                        'path' => $new_cv
                    ]);
                }
                else{
                    session()->flash('error', trans('admin.error'));
                    return redirect()->back();
                }
            }
        }

        if($request->has('image')){  
            if(auth()->user()->image != null)          {
                $removed = Upload::deleteImage(auth()->user()->image->path);
                if($removed){
                    $new_image = Upload::uploadImage($request->image);
                    auth()->user()->image->update([
                        'path' => $new_image
                    ]);
                }
                else{
                    session()->flash('error', trans('admin.error'));
                    return redirect()->back();
                }
            }
            else{
                $image_url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $image_url,
                    'imageRef_id' => Auth()->user()->id,
                    'imageRef_type' => 'App\User'
                ]);
                auth()->user()->image()->save($image);
            }
        }

        session()->flash('success', trans('web.personal_info_updated'));
        return redirect()->route('profile.index');

    }

    public function getOrders(){
        return view('web.orders.index');
    }

    public function trackOrder($id){
        $order = Order::with('bags')->find($id);
        return view('web.orders.track_order', compact('order'));
    }

    public function showBagContents($id){
        $bag = Bag::with(['images', 'videos', 'documents'])->find($id);
        return view('web.bags.gallery', compact('bag'));
    }

    public function show($id){
        $user = User::with(['image', 'country', 'city', 'document'])->find($id);

        return view('web.profile.show', compact('user'));
    }
}
