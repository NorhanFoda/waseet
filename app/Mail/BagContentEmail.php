<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BagContentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $bags;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bags)
    {
        $this->bags = $bags;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.contents')->with(['bags' => $this->bags]);
    }
}
