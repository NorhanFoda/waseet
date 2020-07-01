<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Document;
use App\Classes\Upload;
use App\Http\Requests\Seekers\SeekerRequest;
use App\Http\Requests\Seekers\EditSeekerRequest;

class SeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seekers = User::whereHas('roles', function($q){
            $q->where('name', 'job_seeker');
        })->get();

        return view('admin.seekers.index', compact('seekers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.seekers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeekerRequest $request)
    {
        $seeker = User::create($request->all());
        $seeker->assignRole('job_seeker');

        $image_url = Upload::uploadPDF($request->cv);
            $cv = Document::create([
                'path' => $image_url,
                'user_id' => $seeker->id,
            ]);
            $seeker->document()->save($cv);

        if($seeker){
            session()->flash('success', trans('admin.created'));
            return redirect()->route('seekers.index');
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
        $seeker = User::with('document', 'country', 'city')->find($id);

        return view('admin.seekers.show', compact('seeker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seeker = User::with('document')->find($id);
        $countries = Country::all();
        $cities = City::where('country_id', $seeker->country_id)->get();
        return view('admin.seekers.edit', compact('seeker', 'countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSeekerRequest $request, $id)
    {
        $seeker = User::find($id);
        $seeker->update($request->all());

        if($request->has('cv')){
            if($seeker->document != null){
                $removed = Upload::deletePDF($seeker->document->path);
                if($removed){
                    $pdf_url = Upload::uploadPDF($request->cv);
                    $seeker->document->update([
                        'path' => $pdf_url,
                    ]);
                }
                else{
                    session()->flash('error', trans('admin.error'));
                    return redirect()->route('seekers.index');        
                }
            }
            else{
                $pdf_url = Upload::uploadPDF($request->cv);
                $pdf = Document::create([
                    'path' => $pdf_url,
                    'user_id' => $seeker->id,
                ]);
                $seeker->document()->save($pdf);
            }
        }

        if($seeker){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('seekers.index');
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

    public function deleteSeeker(Request $request){
        $seeker = User::find($request->id);
        $removed = Upload::deletePDF($seeker->document->path);
        if($removed){
            $seeker->delete();
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