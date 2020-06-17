<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $user_code;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $user_code, $email)
    {
        $this->code = $code;
        $this->user_code = $user_code;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email/forgetPassword')->with(['code' => $this->code, 
                    'user_code' => $this->user_code,
                    'email' => $this->email]);
    }
}
