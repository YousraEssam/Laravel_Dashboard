<?php

namespace App\Listeners;

use App\Events\NewVisitorHasBeenAddedEvent;
use App\Mail\NewVisitorResetPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNewVisitorResetPasswordLinkListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(NewVisitorHasBeenAddedEvent $event)
    {
        Mail::to($event->visitor->user->email)->send(new NewVisitorResetPasswordMail($event->visitor));
    }
}
