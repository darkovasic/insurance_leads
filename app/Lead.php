<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'dot_number',
        'legal_name',
        'telephone',
        'email_address',
        'dba_name',
        'phy_street',
        'phy_city',
        'phy_zip',
        'phy_state',
        'nbr_power_unit',
        'driver_total',
        'last_insurance_carrier',
        'last_insurance_date',
        'insurance_cancellation_date',
        'description',
        'comment'
    ];
}
