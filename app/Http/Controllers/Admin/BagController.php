<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bag;
use App\Models\BagCategory;
use App\Models\Image;
use App\Models\Video;
use App\Models\Document;
use App\Classes\Upload;
use App\Http\Requests\Bags\BagRequest;
use App\Http\Requests\Bags\EditBagRequest;
use Illuminate\Support\Facades\Validator;
use App\Classes\SendEmail;
use App\Models\SubScriber;
use App\Jobs\SendEmailJob;
use App\Classes\Notify;
use App\User;
use App\Models\DeviceToken;
use App\Models\Notification;

class BagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bags = Bag::all();
        return view('admin.bags.index', compact('bags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BagCategory::with('image')->get();
        return view('admin.bags.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BagRequest $request)
    {

        // Store basic data of the bag
        $bag = Bag::create($request->all());

        $image_url = Upload::uploadImage($request->image);
        $poster_url = Upload::uploadImage($request->poster);
        $video_url = Upload::uploadVideo($request->video);
        $bag->update([
            'image' => $image_url,
            'video' => $video_url,
            'poster' => $poster_url
        ]);

        // Store bag contents
        if($request->has('documents')){
            $documentRules = array(
                'document' => 'mimetypes:application/pdf|max:10000',
            );

            foreach($request->documents as $doc){
                //Validate doc
                $doc_to_validate = array('document' => $doc);
                $docValidator = Validator::make($doc_to_validate, $documentRules);
                if ($docValidator->fails()) {
                    return $docValidator->messages();
                }

                $pdf_url = Upload::uploadPDF($doc);
                $pdf = Document::create([
                    'path' => $pdf_url,
                    'doucmentRef_id' => $bag->id,
                    'doucmentRef_type' => 'App\Models\Bag'
                ]);
                $bag->documents()->save($pdf);
            }
        }

        if($request->has('images')){
            $imageRules = array(
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            );

            foreach($request->images as $image){
                //Validate image
                $image_to_validate = array('image' => $image);
                $imageValidator = Validator::make($image_to_validate, $imageRules);
                if ($imageValidator->fails()) {
                    return $imageValidator->messages();
                }

                $content_image_url = Upload::uploadImage($image);
                $content_image = Image::create([
                    'path' => $content_image_url,
                    'imageRef_id' => $bag->id,
                    'imageRef_type' => 'App\Models\Bag'
                ]);
                $bag->images()->save($content_image);
            }
        }

        if($request->has('videos')){
            $videoRules = array(
                'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            );

            foreach($request->videos as $video){
                //Validate video
                $video_to_validate = array('video' => $video);
                $videoValidator = Validator::make($video_to_validate, $videoRules);
                if ($videoValidator->fails()) {
                    return $videoValidator->messages();
                }

                $content_video_url = Upload::uploadVideo($video);
                $content_video = video::create([
                    'path' => $content_video_url,
                    'videoRef_id' => $bag->id,
                    'videoRef_type' => 'App\Models\Bag'
                ]);
                $bag->videos()->save($content_video);
            }
        }

        if($bag){
            
            // Send bag created notification to all users
            $users = User::all();
            if(count($users) > 0){
                foreach($users as $user){
                    $notification = Notification::create([
                        'msg_ar' => 'لقد تم إضافة حقيبة تعليمية جديدة',
                        'msg_en' => 'A New Education Bag Added',
                        'user_id' => $user->id,
                        'read' => 0
                    ]);
                }
            }
            
            $tokens = DeviceToken::pluck('token');
            Notify::NotifyAll($tokens, $notification, \App::getLocale() == 'ar' ? 'حقيبة جديدة' : 'New bag',  'bag_created', $bag->id);

            $subs = SubScriber::get(['email']);
            foreach($subs as $sub){
                $details['emails'] = $sub->email;
                $details['link'] = route('bags.show', $bag->id);
                $details['type2'] = 'subscripe';
                $details['type'] = 'bag';
                dispatch(new SendEmailJob($details));
            }
            
            session()->flash('success', trans('admin.created'));
            return redirect()->route('bags.index');    
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
        $bag = Bag::with('ratings')->find($id);

        return view('admin.bags.show', compact('bag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = BagCategory::all();
        $bag = Bag::with(['images', 'videos', 'documents'])->find($id);

        return view('admin.bags.edit', compact('categories', 'bag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditBagRequest $request, $id)
    {
        $bag = Bag::find($id);

        // Update basic data of the bag
        $bag->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'contents_ar' => $request->contents_ar,
            'contents_en' => $request->contents_en,
            'benefits_ar' => $request->benefits_ar,
            'benefits_en' => $request->benefits_en,
            'bag_category_id' => $request->bag_category_id,
        ]);

        if($request->has('image')){
            $removed = Upload::deleteImage($bag->image);
            if($removed){
                $image_url = Upload::uploadImage($request->image);
                $bag->update([
                    'image' => $image_url,
                ]);
            }
            else{
                session()->flash('message', trans('admin.error'));
                return redirect()->route('bags.index');        
            }
        }

        if($request->has('video')){
            $video_removed = Upload::deleteVideo($bag->video);
            if($video_removed){
                $video_url = Upload::uploadVideo($request->video);
                $bag->update([
                    'video' => $video_url,
                ]);
            }
            else{
                session()->flash('message', trans('admin.error'));
                return redirect()->route('bags.index');        
            }
        }

        if($request->has('poster')){
            $poster_removed = Upload::deleteImage($bag->poster);
            if($poster_removed){
                $poster_url = Upload::uploadImage($request->poster);
                $bag->update([
                    'poster' => $poster_url,
                ]);
            }
            else{
                session()->flash('message', trans('admin.error'));
                return redirect()->route('bags.index');        
            }
        }

        // Store bag contents
        if($request->has('documents')){
            $documentRules = array(
                'document' => 'mimetypes:application/pdf|max:10000',
            );

            foreach($request->documents as $doc){
                //Validate doc
                $doc_to_validate = array('document' => $doc);
                $docValidator = Validator::make($doc_to_validate, $documentRules);
                if ($docValidator->fails()) {
                    return $docValidator->messages();
                }

                $pdf_url = Upload::uploadPDF($doc);
                $pdf = Document::create([
                    'path' => $pdf_url,
                    'doucmentRef_id' => $bag->id,
                    'doucmentRef_type' => 'App\Models\Bag'
                ]);
                $bag->documents()->save($pdf);
            }
        }

        if($request->has('images')){
            $imageRules = array(
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            );

            foreach($request->images as $image){
                //Validate image
                $image_to_validate = array('image' => $image);
                $imageValidator = Validator::make($image_to_validate, $imageRules);
                if ($imageValidator->fails()) {
                    return $imageValidator->messages();
                }

                $content_image_url = Upload::uploadImage($image);
                $content_image = Image::create([
                    'path' => $content_image_url,
                    'imageRef_id' => $bag->id,
                    'imageRef_type' => 'App\Models\Bag'
                ]);
                $bag->images()->save($content_image);
            }
        }

        if($request->has('videos')){
            $videoRules = array(
                'video' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            );

            foreach($request->videos as $video){
                //Validate video
                $video_to_validate = array('video' => $video);
                $videoValidator = Validator::make($video_to_validate, $videoRules);
                if ($videoValidator->fails()) {
                    return $videoValidator->messages();
                }

                $content_video_url = Upload::uploadVideo($video);
                $content_video = video::create([
                    'path' => $content_video_url,
                    'videoRef_id' => $bag->id,
                    'videoRef_type' => 'App\Models\Bag'
                ]);
                $bag->videos()->save($content_video);
            }
        }

        if($bag){
            session()->flash('success', trans('admin.updated'));
            return redirect()->route('bags.index');    
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

    public function deleteBag(Request $request){
        $bag = Bag::find($request->id);

        // Delete basic data of the bag
        $image_removed = Upload::deleteImage($bag->image);
        $video_removed = Upload::deleteVideo($bag->video);
        $poster_removed = Upload::deleteImage($bag->poster);
        $docs_removed = false;
        $videos_removed = false;
        $images_removed = false;

        if(count($bag->documents) > 0){
            foreach($bag->documents as $doc){
                $docs_removed = Upload::deletePDF($doc->path);
            }

            $docs = Document::where('doucmentRef_id', $bag->id)->get();
            foreach($docs as $doc){
                $doc->delete();
            }
        }
        else{
            $docs_removed = true;
        }

        if(count($bag->images) > 0){
            foreach($bag->images as $image){
                $images_removed = Upload::deleteImage($image->path);
            }

            $images = Image::where('imageRef_id', $bag->id)->get();
            foreach($images as $image){
                $image->delete();
            }
        }
        else{
            $images_removed = true;
        }

        if(count($bag->videos) > 0){
            foreach($bag->videos as $video){
                $videos_removed = Upload::deleteVideo($video->path);
            }

            $videos = Video::where('videoRef_id', $bag->id)->get();
            foreach($videos as $video){
                $video->delete();
            }
        }
        else{
            $videos_removed = true;
        }
        
        if($image_removed && $video_removed && $poster_removed && $videos_removed && $images_removed && $docs_removed){
            $bag->delete();
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

    /* DELETE BAG CONTENTS */
    public function deletePDF(Request $request){
        $doc = Document::find($request->id);
        $removed = Upload::deletePDF($doc->path);
        if($removed){
            $doc->delete();
            return response()->json(['data' => 1], 200);
        }
        else{
            return response()->json(['data' => 0], 200);
        }
    }

    public function deleteImage(Request $request){
        $image = Image::find($request->id);
        $removed = Upload::deleteImage($image->path);
        if($removed){
            $image->delete();
            return response()->json(['data' => 1], 200);
        }
        else{
            return response()->json(['data' => 0], 200);
        }
    }

    public function deleteVideo(Request $request){
        $video = Video::find($request->id);
        $removed = Upload::deleteVideo($video->path);
        if($removed){
            $video->delete();
            return response()->json(['data' => 1], 200);
        }
        else{
            return response()->json(['data' => 0], 200);
        }
    }
}
