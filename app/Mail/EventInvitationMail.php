<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $visitor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $visitor)
    {
        $this->event = $event;
        $this->visitor = $visitor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.event-invitation', compact('event', 'visitor'));
    }
}
