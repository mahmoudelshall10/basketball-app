<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssociationReport extends Model
{
    protected $table      = 'association_reports';
    protected $primaryKey = 'association_report_id';
    protected $fillable   = 
    [
    'referee_fullname_ar',
    'referee_card_number',
    'match_date',
    'refereeing_allowance',
    'transition_allowance',
    'subsistance_allowance',
    'tournament_allowance',
    'total_transition_allowance',
    'total_refereeing_allowance',
    'total_subsistance_allowance',
    'total_tournament_allowance',
    'total_amount',
    'ten_percent_taxes',
    'net_amount'
];

}
