<?php

namespace App\Classes;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ResetPasswordEmail;
use App\Mail\BagContentEmail;
use App\Mail\SubscripersMail;
use App\Mail\NewJobApply;
use App\Mail\ApprovalMail;

class SendEmail{

    static function sendVerificationCode($code, $email){
        Mail::to($email)->send(new VerificationEmail($code, $email));
    }

    static function sendResetPasswordEmail($code, $email){
        Mail::to($email)->send(new ResetPasswordEmail($code, $email));
    }

    static function sendBagContents($bags, $email){;
        Mail::to($email)->send(new BagContentEmail($bags));
    }

    static function Subscripe($email, $link, $type){
        Mail::to($email)->send(new SubscripersMail($link, $type));
    }

    static function sendJobApply($email, $seeker, $link){
        Mail::to($email)->send(new NewJobApply($seeker, $link));
    }

    static function SendApprovalMail($email, $link, $status){
        Mail::to($email)->send(new ApprovalMail($link, $status));
    }
}