<?php

namespace App\Classes;

class Notify{

    static function NotifyAll($tokenList, $request, $title, $type = 'admin-message', $id = null){

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
        $notification = [
            'title' => $title, 
            'body' => \App::getLocale() == 'ar' ? $request->msg_ar : $request->msg_en,
            'id' => $id,
            'sound' => true,
        ];

        $extraNotificationData = [
            'id' => $id,
            "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
            "sound"=> "default",
            "badge"=> "8",
            "color"=> "#ffffff",
            "priority" => "high",
            'type' => $type
        ];

        $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
            'notification' => $notification,
            'data' => $extraNotificationData,
        ];

        $headers = [
            'Authorization: key=AAAA8xhsOLc:APA91bHJBC48-XQdqb4xUv7l0U2nwzgmkn7XPOLqn_rg7kEt8YxWNv4Xp8KULpbZthOl5QY8N2k4ZBDeDdAXHx7HtqhHIaIevNyTYVvFFIRrap7v_j-sBwaCiXqUTkbv-3I02KEeDWBH',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Send notifications to single users
     * $user_tokens is a token specified token
     * $msg id the message to be send to user
     * $type is the type of the message (new teacher, new job, ...)
     * id is the id of the new teacher, new job, ...
    */
    static function NotifyUser($user_tokens, $msg, $title, $type, $id){

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
        $notification = [
            'title' => $title,
            'body' => $msg,
            'id' => $id,
            'sound' => true,
        ];

        $extraNotificationData = [
            'id' => $id,
            "click_action"=>"FLUTTER_NOTIFICATION_CLICK",
            "sound"=> "default",
            "badge"=> "8",
            "color"=> "#ffffff",
            "priority" => "high",
            'type' => $type
        ];

        $fcmNotification = [];
        
        if(count($user_tokens) > 0){
            foreach($user_tokens as $token){
                $fcmNotification = [
                    'to'        => $token->token, //single token
                    'notification' => $notification,
                    'data' => $extraNotificationData,
                ];
            }
        }

        $headers = [
            'Authorization: key=AAAA8xhsOLc:APA91bHJBC48-XQdqb4xUv7l0U2nwzgmkn7XPOLqn_rg7kEt8YxWNv4Xp8KULpbZthOl5QY8N2k4ZBDeDdAXHx7HtqhHIaIevNyTYVvFFIRrap7v_j-sBwaCiXqUTkbv-3I02KEeDWBH',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }
}