<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MatchesReferees extends Model
{
    protected $table			=	'matches_referees';
    protected $primaryKey		=	'matches_referee_id';
    protected $fillable			=	['leage_matches_id','referee_id','referee_role_id','match_acceptance','match_decline_reason','match_confirmation','match_verification','num_of_periods'];
    protected $casts			=	[
    									'leage_matches_id'		=>	'integer',
    									'referee_id'			=>	'integer',
    								];
	public function referee()
    {
     return $this->belongsTo('App\Model\Referee','referee_id');
    }

    public function leage_match()
    {
     return $this->hasOne('App\Model\LeageMatches','leage_matches_id','leage_matches_id');
    }

    public function referee_role()
    {
        return $this->hasOne('App\Model\RefereeRoles','referee_role_id','referee_role_id');
    }
}
