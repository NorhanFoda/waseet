<?php

namespace App\Classes;

class Notify{

    static function NotifyAll($tokenList, $request, $type = 'admin-message', $id = null){

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        // $token=$token;
        
        $notification = [
            'body' => \App::getLocale() == 'ar' ? $request->msg_ar : $request->msg_en,
            'id' => $id,
            'sound' => true,
            // 'image' => 'http://beta.bestlook.sa/images/php5E35_1586248655.png'
        ];

        $extraNotificationData = ["message" => $notification,"moredata" =>'dd', 'type' => 'admin-message'];

        $fcmNotification = [
            'registration_ids' => $tokenList, //multple token array
            // 'to'        => $token, //single token
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
    static function NotifyUser($user_tokens, $msg, $type, $id){

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
        $notification = [
            'body' => $msg,
            'id' => $id,
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification,"moredata" =>'dd', 'type' => $type];

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

    // static function NotifyNewOrder(){
    //     $admin_phone = \App\Models\Setting::find(1)->notification_phone;
        
    //     if($admin_phone == null || $admin_phone == ''){
    //         return;
    //     }

    //     try {
    //         if(\App::getLocale() == 'ar'){
    //             $message = 'طلب جديد قيد الإنتظار';
    //         }
    //         else{
    //             $message = 'A new order is waiting';
    //         }
            
    //         $response = sms($admin_phone, $message);
        
    //         if($response == 1) {
    //             // dd('The message was sent successfully');
    //             return;
    //         } else {
    //             // dd("The message failed with status: " . $response['messages'][0]['status']);
    //             return;
    //         }
    //     } catch (Exception $e) {
    //         dd("The message was not sent. Error: " . $e->getMessage());
    //         return;
    //     }
    // }
}