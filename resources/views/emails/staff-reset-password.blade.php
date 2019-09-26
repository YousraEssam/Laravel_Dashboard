@component('mail::message')
# Hello,
{{ $staffMember->user->first_name}} {{ $staffMember->user->last_name}}

<!-- The body of your message. -->
You are recieving this email to reset your own password

# Your Account Information:<br>

    Email: {{ $staffMember->user->email}}
    Password: Staff123

@component('mail::button', ['url' => env('APP_URL')."{$url}".'?email='."{$staffMember->user->email}"])

Reset Password Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
