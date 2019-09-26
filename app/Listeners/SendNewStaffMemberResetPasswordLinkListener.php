<?php

namespace App\Listeners;

use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Mail\NewStaffMemberResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class SendNewStaffMemberResetPasswordLinkListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewStaffMemberHasBeenAddedEvent $event)
    {
        Mail::to($event->staffMember->user->email)->send(new NewStaffMemberResetPasswordMail($event->staffMember));
    }
}
