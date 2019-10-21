<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUserMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeNewUserListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to($event->user->email)->send(new WelcomeNewUserMail($event->user));
    }
}
