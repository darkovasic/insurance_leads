<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {      
        $this->user = auth()->user();
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Welcome to ' . env('APP_NAME');

        return $this->from($this->user->email, $this->user->name)
            ->replyTo($this->user->email, $this->user->name)
            ->subject($subject)
            ->view('emails.welcome');
            // ->with([ 'message' => $this->data['message'] ]);
    }
}
