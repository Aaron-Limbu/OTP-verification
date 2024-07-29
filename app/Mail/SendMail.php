<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp ;
    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        $this->otp=$otp  ;
    }
    public function build(){
        return $this->subject('Your OTP code')
                    ->view('otp')
                    ->with('otp',$this->otp);
    }
}
