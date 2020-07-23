<?php

namespace App\Classes;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ResetPasswordEmail;
use App\Mail\BagContentEmail;

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
}