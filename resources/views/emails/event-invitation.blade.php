@component('mail::message')
# Hello,
{{ $visitor->user->first_name}} {{ $visitor->user->last_name}}

You are Invited to {{ $event->main_title}} Event

Event Details:<br>

    Start Date: {{ $event->start_date }}
    End Date: {{ $event->end_date }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent