<?php

namespace App\Mail;

use App\Visitor;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVisitorResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    use ResetsPasswords;

    public $visitor;
    public $token;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
        $this->token = app(PasswordBroker::class)->createToken($visitor->user);
        $this->url = "/password/reset/{$this->token}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.visitor-reset-password');
    }
}
