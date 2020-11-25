<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SentEmailsLog extends Model
{
    use Filterable;
    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sent_emails_log';

    public $sortable = [
        'id',
        'message_id',
        'type',
        'status',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }
}
