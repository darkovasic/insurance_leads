<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ApiRequestLog extends Model
{
    use Sortable;
    use Filterable;

    public $timestamps = true;

    public $sortable = [
        'id',
        'response',
        'response_time',
        'created_at',
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
