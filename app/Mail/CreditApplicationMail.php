<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CreditApplication;

class CreditApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(CreditApplication $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Credit Application Submission')
                    ->view('emails.credit-application')
                    ->with(['application' => $this->application]);
    }
}
