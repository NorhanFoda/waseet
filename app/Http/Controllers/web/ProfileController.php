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
        dd($request->all());
    }
}
