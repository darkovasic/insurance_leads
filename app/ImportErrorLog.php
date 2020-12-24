<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ImportErrorLog extends Model
{
    use Sortable;

    protected $fillable = [
        'job_id', 'row_number', 'message'
    ];

    public $sortable = [
        'id',
        'job_id',
        'row_number'
    ];
}
