<?php

namespace App\Mail;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $subject, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject, $password)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->subject)
            ->markdown('emails.send-new-user-email')
            ->with(['user' => $this->user, 'password' => $this->password]);
    }
}
