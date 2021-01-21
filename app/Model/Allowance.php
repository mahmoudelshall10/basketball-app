<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $table = 'allowances';
    protected $primaryKey = 'allowance_id';
    protected $fillable = 
    [
        'allowance_id',
        'league_id',
        'leage_matches_id',
        'referee_id',
        'allowances_values_id',
    ];

    public function league()
    {
        return $this->belongsTo('App\Model\League','league_id');
    }

    public function leageMatch()
    {
        return $this->belongsTo('App\Model\LeageMatches','leage_matches_id','leage_matches_id');
    }

    public function AllownanceValue()
    {
        return $this->hasOne('App\Model\AllowancesValue','allowances_values_id','allowances_values_id');
    }

    public function referee()
    {
        return $this->hasOne('App\Model\Referee','referee_id','referee_id');
    }
}
