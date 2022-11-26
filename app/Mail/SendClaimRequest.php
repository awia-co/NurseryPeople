<?php

namespace App\Mail;

use App\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendClaimRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $claim;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->claim->user_email, $this->claim->user_name)
            ->markdown('emails.claims.request');
    }
}
