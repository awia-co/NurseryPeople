<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;
    public $emailContents;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $emailContents)
    {
        $this->emailContents = $emailContents;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->emailContents->email, $this->emailContents->name)
            ->markdown('emails.contact_form');
    }
}
