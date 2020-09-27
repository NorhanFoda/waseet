<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Classes\SendEmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->details['type'] == 'send_verification_code'){
            SendEmail::sendVerificationCode($this->details['code'], $this->details['email']);
        }

        else if($this->details['type'] == 'apply_to_job'){
            SendEmail::sendJobApply($this->details['email'], $this->details['seeker'], $this->details['link']);
        }

        else if($this->details['type'] == 'send_bag_contents'){
            SendEmail::sendBagContents($this->details['bags'], $this->details['email']);
        }

        else if($this->details['type'] == 'reset_password'){
            SendEmail::sendResetPasswordEmail($this->details['code'], $this->details['email']);
        }

        else if($this->details['type2'] == 'subscripe'){
            SendEmail::Subscripe($this->details['emails'], $this->details['link'], $this->details['type']);
        }

        else if($this->details['type2'] == 'approve_job'){
            SendEmail::SendApprovalMail($this->details['email'], $this->details['link'], $this->details['type']);
        }
    }
}
