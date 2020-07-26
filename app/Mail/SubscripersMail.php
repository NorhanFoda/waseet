<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscripersMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $type)
    {
        $this->link = $link;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.subscripe')->with(['link' => $this->link, 'type' => $this->type]);
    }
}
