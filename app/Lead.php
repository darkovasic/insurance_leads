<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use Filterable;
    
    protected $guarded = [
        'dot_number'
    ];
}
