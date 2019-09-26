<?php

namespace App\Mail;

use App\StaffMember;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Auth\Passwords\PasswordBroker;

class NewStaffMemberResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    use ResetsPasswords;

    public $staffMember;
    public $token;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(StaffMember $staffMember)
    {
        $this->staffMember = $staffMember;
        $this->token = app(PasswordBroker::class)->createToken($staffMember->user);
        $this->url = "/password/reset/{$this->token}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.staff-reset-password');
    }

}
