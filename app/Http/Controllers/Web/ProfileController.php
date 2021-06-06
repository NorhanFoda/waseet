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
use App\Models\City;
use App\Models\Image;
use App\Models\Order;
use App\Models\Bag;
use App\Classes\Upload;
use App\Http\Requests\User\UpdateProfileRequest;
use App\User;

class ProfileController extends Controller
{
    // get index view for user profile
    public function index(){
        return view('web.profile.index');
    }

    // get saved posts for auth user
    public function getSaved(){
        return view('web.saved.index');
    }

    // get edit personal info form for auth user
    public function editPersonalInfo(){
        $stages = Stage::all();
        $materials = Material::all();
        $nationalities = Nationality::all();
        $levels = EduLevel::all();
        $types = EduType::all();
        // $countries = Country::all();
        // $cities = auth()->user() == null || auth()->user()->hasRole('admin') ? City::all() : auth()->user()->country->cities;

        return view('web.profile.edit', compact('stages', 'materials', 'levels', 'types', 'nationalities'));
    }

    // update auth user personal info
    public function storePersonalInfo(UpdateProfileRequest $request){

        $data = $request->except(['_token'. '_method', 'full', 'sec_full']);

        // handling phone according to stupids opinion
        $data['phone_main'] = $request->full.','.$request->phone_main;
        if($request->has('phone_secondary')){
            $data['phone_secondary'] = $request->sec_full.','.$request->phone_secondary;
        }

        auth()->user()->update($data);
        
        auth()->user()->update([
            'teaching_lat' => $request->lat2,
            'teaching_long' => $request->long2,
        ]);

        if(auth()->user()->hasRole('online_teacher') || auth()->user()->hasRole('direct_teacher')){
            auth()->user()->materials()->sync($request->material_ids);
            foreach($request->material_ids as $id){
                if($id == 4){
                    auth()->user()->materials()->where('material_id', 4)->first()->pivot->update(['other_material' => $request->other_material]);
                }
            }
        }

        if(auth()->user()->hasRole('job_seeker')){
            
            if($request->has('cv')){

                if(auth()->user()->document){

                    $removed = Upload::deletePDF(auth()->user()->document->path);
                }
                
                $new_cv = Upload::uploadPDF($request->cv);
                auth()->user()->document->update([
                    'path' => $new_cv
                ]);
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

    // get orders for auth user
    public function getOrders(){
        return view('web.orders.index');
    }

    // track auth user order
    public function trackOrder($id){
        $order = Order::with('bags')->find($id);
        return view('web.orders.track_order', compact('order'));
    }

    // show bag contents for online paied bags
    public function showBagContents($id){
        $bag = Bag::with(['images', 'videos', 'documents'])->find($id);

        if(!$bag){

            return redirect()->route('profile.index');
        }
        return view('web.bags.gallery', compact('bag'));
    }

    // view auth user profile
    public function show($id){
        $user = User::with(['image', 'country', 'city', 'document'])->find($id);

        return view('web.profile.show', compact('user'));
    }
}
