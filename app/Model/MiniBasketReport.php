<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MiniBasketReport extends Model
{
    protected $table      = 'mini_basket_reports';
    protected $primaryKey = 'mini_basket_report_id';
    protected $fillable   = 
    [
    'referee_fullname_ar',
    'referee_card_number',
    'period_value',
    'match_date',
    'league_name',
    'feeding_allowance',
    'transition_allowance',
    'total_number_of_periods',
    'total_feeding_days',
    'total_value_of_the_periods',
    'total_transition_allowance',
    'total_feeding_allowance',
    'total_amount',
    'ten_percent_taxes',
    'net_amount',
    'total'
];
}
