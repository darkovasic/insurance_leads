<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {      
        $this->sender = auth()->user();
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Welcome to ' . env('APP_NAME');

        return $this->from($this->sender->email, $this->sender->name)
            ->replyTo($this->sender->email, $this->sender->name)
            ->to($this->user->email, $this->user->name)
            ->subject($subject)
            ->view('emails.welcome');
            // ->with([ 'message' => $this->data['message'] ]);
    }
}
