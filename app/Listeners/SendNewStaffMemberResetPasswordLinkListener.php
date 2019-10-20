<?php

namespace App\Listeners;

use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Mail\NewStaffMemberResetPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNewStaffMemberResetPasswordLinkListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(NewStaffMemberHasBeenAddedEvent $event)
    {
        Mail::to($event->staffMember->user->email)->send(new NewStaffMemberResetPasswordMail($event->staffMember));
    }
}
