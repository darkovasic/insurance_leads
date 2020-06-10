<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use App\SentEmailsLog;

use Log;

class LogSendingMessage
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
     * @param  MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        $message = $event->message;
        return;

        $messageId = $message->getId();
        $senderId = $message->senderId;
        $leadId = $message->leadId;
        $type = $message->type;
        $status = 'waiting';

        if ($type === 'er') {

            try {
                $log = new SentEmailsLog;
                $log->message_id = $messageId;
                $log->user_id = $senderId;
                $log->lead_id = $leadId;
                $log->type = $type;
                $log->status = $status;
                $log->save();

            } catch (\Illuminate\Database\QueryException $error) {
                return $error->getMessage();
            }

        }
    }
}
