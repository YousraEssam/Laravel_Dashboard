@component('mail::message')
# Hello,
{{ $visitor->user->first_name}} {{ $visitor->user->last_name}}

<!-- The body of your message. -->
You are recieving this email to reset your own password

# Your Account Information:<br>

    Email: {{ $visitor->user->email}}
    Password: Visitor123

@component('mail::button', ['url' => env('APP_URL')."{$url}".'?email='."{$visitor->user->email}"])

Reset Password Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
