<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequestLog extends Model
{
    public $timestamps = true;

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }
}
