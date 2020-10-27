<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Resources\Notifications\NotificationsResource;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function enableDisableNotification(Request $request){
        if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $this->validate($request, ['enable' => 'required']);
            Auth::guard('api')->user()->update(['allow_notification' => $request->enable]);
            if($request->enable == 1){
                return response()->json([
                    'success' => 'Notification enabled successfuly'
                ], 200);
            }
            else{
                return response()->json([
                    'success' => 'Notification disabled successfuly'
                ], 200);
            }
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function getNotificationsCount(Request $request){
        // if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return response()->json([
                'data' => $user->notifications->where('read', 0)->count()
            ], 200);
        // }
        // else{
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
    }

    public function getUserNotifications(Request $request){
        // if(app('request')->header('Authorization') != null && Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return response()->json([
                'data' => NotificationsResource::collection($user->notifications),
            ], 200);
        // }
        // else{
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // } 
    }

    public function deleteAllNotifications(){
        Auth::guard('api')->user()->notifications()->delete();
        return response()->json([
            'data' => trans('api.notifications_deleted')
        ], 200);
    }

    public function deleteOneNotifications(Request $request){

        $this->validate($request, ['notification_id' => 'required']);

        Notification::find($request->notification_id)->delete();

        return response()->json([
            'data' => trans('api.notification_deleted')
        ], 200);
    }

    public function changeNotificationStatus(Request $request){
        $this->validate($request, [
            'notification_id' => 'required',
            'read' => 'required'
        ]);

        Notification::find($request->notification_id)->update(['read' => $request->read]);

        return response()->json([
            'data' => trans('api.notification_updated')
        ], 200);
    }
}
