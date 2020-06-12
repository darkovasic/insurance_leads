<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Lead;

class SendErEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $lead;
    public $yearsInBusiness;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->user = auth()->user();
        $this->lead = Lead::where('id', '=', $id)->first();
        $this->yearsInBusiness = $this->getYearsInBusiness($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message) {
            $message->type = 'er';
            $message->senderId = $this->user->id;
            $message->leadId = $this->lead->id;
        });

        return $this
        ->from($this->user->email)
        ->to($this->lead->email_address)
        ->subject($this->lead->legal_name . ' Truck Insurance Quote')
        ->view('emails.er_email');
    }

    public function getYearsInBusiness($id) {

        $response = DB::select('SELECT TIMESTAMPDIFF(YEAR, add_date_date, CURDATE()) + 1 AS years_in_business FROM leads WHERE id = ' . $id);
        $years = $response[0]->years_in_business;

        return $years;
    }
}
