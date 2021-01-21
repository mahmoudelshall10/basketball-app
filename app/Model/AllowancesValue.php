<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AllowancesValue extends Model
{
    protected $table			=	'allowances_values';
    protected $primaryKey		=	'allowances_values_id';
    protected $fillable			=	
    [
    'allowances_values_id',
    'allowance_name',
    'allowance_type',
    'city_from',
    'city_to',
    'season_start_date',
    'season_end_date',
    'referee_place',
    'referee_type',
    'arbitration_allowance',
    'transition_allowance',
    'subsistance_allowance',
    'tournament_allowance',
    'period_value',
    'nutrition_allowance',
    'num_of_periods',
    'ten_percent_taxes',
    'net_amount',
    'total_amount'
];





public function From()
{
 return $this->belongsTo('App\Model\City','city_from');
}
public function To()
{
 return $this->belongsTo('App\Model\City','city_to');
} 

public function league()
{
    return $this->belongsTo('App\Model\League','league_id');
}

public function refereeplace()
{
    return $this->hasOne('App\Model\RefereePlaces','referee_place_id','referee_place');
}

public function allowance()
{
    return $this->hasMany('App\Model\Allowance','allowance_id');
}

}
