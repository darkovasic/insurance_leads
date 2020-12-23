<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportErrorLog extends Model
{
    protected $fillable = [
        'job_id', 'row_number', 'message'
    ];
}
