<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $email;
    public $messages;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $email, $messages)
    {
        $this->sender = $sender;
        $this->email = $email;
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->view('public.contact-mail');
    }
}
