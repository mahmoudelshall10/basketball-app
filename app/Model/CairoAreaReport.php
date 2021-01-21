<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CairoAreaReport extends Model
{
    protected $table      = 'cairo_area_reports';
    protected $primaryKey = 'cairo_area_report_id';
    protected $fillable   = 
    [
    'referee_fullname_ar',
    'referee_card_number',
    'match_date',
    'refereeing_allowance',
    'transition_allowance',
    'total_transition_allowance',
    'total_refereeing_allowance',
    'total_amount',
    'ten_percent_taxes',
    'net_amount'
];
}
