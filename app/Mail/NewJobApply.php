<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJobApply extends Mailable
{
    use Queueable, SerializesModels;
    public $seeker;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seeker, $link)
    {
        $this->seeker = $seeker;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.new_job_apply')->with(['seeker' => $this->seeker, 'link' => $this->link]);
    }
}
