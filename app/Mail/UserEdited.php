<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEdited extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Your account has been edited!';

        return $this
            ->from(env('MAIL_FROM_ADDRESS', 'dukic.n@gmail.com'), env('MAIL_FROM_NAME', 'Coverage Center'))
            ->to($this->user->email, $this->user->name)
            ->subject($subject)
            ->view('emails.user_edited');
    }
}
