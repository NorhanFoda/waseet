<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $link;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $status)
    {
        $this->link = $link;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.approval_mail')->with(['link' => $this->link, 'status' => $this->status]);
    }
}
