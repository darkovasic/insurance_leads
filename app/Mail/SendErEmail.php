<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Lead;

class SendErEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {      
        $this->user = auth()->user();
        $this->lead = Lead::where('id', '=', $id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        // dd($this->lead);

        return $this
        ->from($this->user->email)
        ->to($this->lead->email_address)
        ->subject('Lead Review')
        ->view('emails.er_email');
    }
}
