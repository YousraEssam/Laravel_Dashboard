<?php

namespace App\Providers;

use App\Events\NewStaffMemberHasBeenAddedEvent;
use App\Events\NewVisitorHasBeenAddedEvent;
use App\Listeners\SendNewStaffMemberResetPasswordLinkListener;
use App\Listeners\SendNewVisitorResetPasswordLinkListener;
use App\Listeners\WelcomeNewUserListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            // SendEmailVerificationNotification::class,
            WelcomeNewUserListener::class,
        ],
        NewStaffMemberHasBeenAddedEvent::class => [
            SendNewStaffMemberResetPasswordLinkListener::class,
        ],
        NewVisitorHasBeenAddedEvent::class => [
            SendNewVisitorResetPasswordLinkListener::class,
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
