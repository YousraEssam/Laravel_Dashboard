@component('mail::message')
# Hello,
{{ $notifiable->first_name}} {{ $notifiable->last_name}}

You are Invited to {{ $event->main_title}} Event

Event Details:<br>

    Start Date: {{ $event->start_date }}
    End Date: {{ $event->end_date }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
