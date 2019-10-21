<?php

namespace App\Listeners;

use App\Events\NewEventHasBeenAddedEvent;
use App\Events\NewEventHasBeenCreatedEvent;
use App\Mail\EventInvitationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEventInvitationListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewEventHasBeenAddedEvent  $event
     * @return void
     */
    public function handle($event)
    {
        foreach($event->event->visitors as $visitor){
            Mail::to($visitor->user->email)->send(new EventInvitationMail($event->event, $visitor));
        }
    }
}
