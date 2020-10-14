<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentEmailsLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sent_emails_log';


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
