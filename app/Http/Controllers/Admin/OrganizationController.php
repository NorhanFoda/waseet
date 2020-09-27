<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use App\Models\Image;
use App\Models\EduType;
use App\Http\Requests\Organizations\OrganizationRequest;
use App\Http\Requests\Organizations\EditOrganizationRequest;
use App\Classes\Upload;
use Illuminate\Support\Facades\Hash;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = User::whereHas('roles', function($q){
            $q->where('name', 'organization');
        })->get();

        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $countries = Country::all();
        $edu_types = EduType::all();
        return view('admin.organizations.create', compact('edu_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        $org = User::create($request->all());

        $org->update(['password' => Hash::make($request->password), 'is_verified' => 1, 'approved' => 1]);

        $org->assignRole('organization');

        if($request->has('image')){
            $url = Upload::uploadImage($request->image);
            $image = Image::create([
                'path' => $url,
                'imageRef_id' => $org->id,
                'imageRef_type' => 'App\User'
            ]);
            $org->image()->save($image);
        }

        if($org){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('organizations.index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $org = User::with('job_announces', 'image', 'country', 'city', 'org_applicants')->find($id);
        
        return view('admin.organizations.show', compact('org'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org = User::find($id);
        // $countries = Country::all();
        // $cities = Country::find($org->country_id)->cities;
        $edu_types = EduType::all();
        return view('admin.organizations.edit', compact('org', 'edu_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $org = User::find($id);
        $org->update($request->all());

        $org->assignRole('organization');

        if($request->has('image')){
            if($org->image != null){
                $remove = Upload::deleteImage($org->image->path);
                if($remove){
                    $url = Upload::uploadImage($request->image);
                    $image = Image::where('imageRef_id', $org->id)->first();
                    $image->update([
                        'path' => $url,
                    ]);
                    $org->image()->save($image);
                }
                else{
                    session()->flash('error', trans('admin.error'));
                    return redirect()->back();
                }
            }
            else{
                $url = Upload::uploadImage($request->image);
                $image = Image::create([
                    'path' => $url,
                    'imageRef_id' => $org->id,
                    'imageRef_type' => 'App\User'
                ]);
                $org->image()->save($image);
            }
        }

        if($org){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('organizations.index');
        }
        else{
            session()->flash('error', trans('admin.error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }

    public function deleteOrganization(Request $request){
        $org = User::find($request->id);

        if(count($org->org_applicants) > 0){
            return response()->json([
                'data' => 0
            ], 200);
        }
        else{
            if($org->image != null){
                $remove = Upload::deleteImage($org->image->path);
                if($remove){
                    $org->delete();
                    return response()->json([
                        'data' => 1
                    ], 200);
                }
                else{
                    return response()->json([
                        'data' => 0
                    ], 200);
                }
            }
        }
    }
}
