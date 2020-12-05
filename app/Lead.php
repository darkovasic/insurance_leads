<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Lead extends Model
{
    use Filterable;
    use Notifiable;
    use Sortable;
    
    protected $guarded = [];
}
