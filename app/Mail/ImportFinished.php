<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImportFinished extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $errorCount;
    public $errorLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $errorCount)
    {
        $this->data = $data;
        $this->errorCount = $errorCount;
        $this->errorLink = route('import-log');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Import Finished!';

        return $this
            ->from(env('MAIL_FROM_ADDRESS', 'dukic.n@gmail.com'), env('MAIL_FROM_NAME', 'Coverage Center'))
            ->subject($subject)
            ->view('emails.import_finished');
    }
}