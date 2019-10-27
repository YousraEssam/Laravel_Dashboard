<?php

namespace App\Notifications;

use App\Events\NewEventHasBeenAddedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $event;

    /**
     * Handle the event.
     *
     * @param  NewEventHasBeenAddedEvent $event
     * @return void
     */
    public function handle(NewEventHasBeenAddedEvent $event)
    {
        $this->event = $event->event;
        
        foreach($event->event->visitors as $visitor){
            app(\Illuminate\Contracts\Notifications\Dispatcher::class)
                ->sendNow($visitor->user, $this);
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Event Invitation')
            ->markdown('emails.event-invitation', [
                'notifiable' => $notifiable,
                'event' => $this->event,
            ]);
    }
}
