<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUserMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class WelcomeNewUserListener
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
