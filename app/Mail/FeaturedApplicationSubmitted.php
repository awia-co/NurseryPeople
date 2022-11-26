<?php

namespace App\Mail;

use App\FeaturedApplicant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeaturedApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;
    public $featuredApplication;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FeaturedApplicant $featuredApplication)
    {
        $this->featuredApplication = $featuredApplication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->featuredApplication->email, $this->featuredApplication->name)
            ->markdown('emails.featured_application_submitted');
    }
}
