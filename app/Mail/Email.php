<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $verifyCode;
    public $subject;
    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @param string $code The verification code.
     * @param string $subject The subject of the email.
     * @param string $messageContent The content of the email message.
     */
    public function __construct($code, $subject, $messageContent)
    {
        $this->verifyCode = $code;
        $this->subject = $subject;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('mail');
    }
}
