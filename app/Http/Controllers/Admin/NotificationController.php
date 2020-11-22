<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\DeviceToken;
use App\Models\Notification;
use App\User;
use App\Classes\Notify;

class NotificationController extends Controller
{
    public function __construct()
    {
        // Auth::shouldUse('web');m,
    }

    public function index(){
        $all_data = Notification::where('type','admin-message')->orderBy('created_at', 'desc')->get(['id', 'msg_ar', 'msg_en', 'created_at']);
        $notifications = $all_data->unique('msg_ar'); 
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create(){
        return view('admin.notifications.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'msg_ar' => 'required',
            'msg_en' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $users = User::all();

        //Make image name unique
        // $full_file_name = $request->image;
        // $file_name = pathinfo($full_file_name, PATHINFO_FILENAME);
        // $extension = $request->image->getClientOriginalExtension();
        // $file_name_to_store = $file_name.'_'.time().'.'.$extension;
        
        //Upload image
        // $path = $request->image->move(public_path('/images/'), $file_name_to_store);
        // $url = url('/images/'.$file_name_to_store);

        if(count($users) > 0){
            foreach($users as $user){
                $notification = Notification::create([
                    'msg_ar' => $request->msg_ar,
                    'msg_en' => $request->msg_en,
                    // 'image' => $url,
                    'user_id' => $user->id,
                    'read' => 0,
                    'type' => 'admin-message',
                    'extra_data' => $job->id,
                ]);
            }
        }

        $tokens = DeviceToken::pluck('token');

        Notify::NotifyAll($tokens, $notification, \App::getLocale() == 'ar' ? 'الإدارة' : 'Adminstration',  'admin-message', $job->id);

        session()->flash('message', trans('admin.notification_created'));
        return redirect()->route('notifications.index');
    }

    // public function notification($tokenList, $request){

    //     $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

    //     // $token=$token;
        
    //     $notification = [
    //         'body' => $request->msg_ar,
    //         'sound' => true,
    //     ];

    //     $extraNotificationData = ["message" => $notification,"moredata" =>'dd', 'type' => 'admin-message'];

    //     $fcmNotification = [
    //         'registration_ids' => $tokenList, //multple token array
    //         // 'to'        => $token, //single token
    //         'notification' => $notification,
    //         'data' => $extraNotificationData,
    //     ];

    //     $headers = [
    //         'Authorization: key=AAAA366N0Ug:APA91bFaF1RHMkEwF9ATUovRtuhMo7Psi_nhFHVqt0IQ3BNqLx3wDuecL9OMztor2QKlJpTpZyOq5VhavCLaiTC8QgCDYpRtCvceOrBpoD8ZSjtqsXo2_sHaVETRjdXKit1UqC1O4a3h',
    //         'Content-Type: application/json'
    //     ];

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    //     $result = curl_exec($ch);
    //     curl_close($ch);

    // }

    public function delete(Request $request){
        if($request->ajax()){
            $nots = Notification::where('msg_ar', Notification::find($request->id)->msg_ar)->get();
            if(count($nots) > 0){
                foreach($nots as $not){
                    $not->delete();
                }
            }
            // session()->flash('message', trans('condition_deleted'));
            return response()->json([
                'data' => 1,
            ], 200);
        }
    }
}
