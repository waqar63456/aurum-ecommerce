<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp, $customer)
    {
        $this->otp = $otp;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your OTP for Registration')
                    ->view('emails.sendOtp');
    }
}

