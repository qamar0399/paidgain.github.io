<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanRenew extends Mailable
{
    use Queueable, SerializesModels;

    public $mailable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailable)
    {
        $this->mailable = $mailable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.plan-renew')
            ->subject($this->mailable['subject'])
            ->with('mailable', $this->mailable);
    }
}
