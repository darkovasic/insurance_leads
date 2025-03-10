<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use App\SentEmailsLog;

class LogSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $message = $event->message;

        if (isset($message->type) && $message->type === 'er') {

            $messageId = $message->getId();
            $type = $message->type;
            $status = 'sent';

            $log = SentEmailsLog::firstWhere('message_id', $messageId);
            if (!empty($log))
            {
                $log->status = $status;
                $log->save();
            }
        }
    }
}
