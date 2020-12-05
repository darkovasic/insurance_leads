<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Broker extends Model
{
    use Filterable;
    use Notifiable;
    use Sortable;
    
    protected $guarded = [];


    public function setStatesCoveredAttribute($value)
    {
        $this->attributes['states_covered'] = json_encode($value);
    }
  
    public function getStatesCoveredAttribute($value)
    {
        return $this->attributes['states_covered'] = json_decode($value);
    }

    public function setAcceptedLanguagesAttribute($value)
    {
        $this->attributes['accepted_languages'] = json_encode($value);
    }
  
    public function getAcceptedLanguagesAttribute($value)
    {
        return $this->attributes['accepted_languages'] = json_decode($value);
    }
}
