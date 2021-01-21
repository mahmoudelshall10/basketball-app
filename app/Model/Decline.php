<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Decline extends Model
{
    protected $table = 'declines';
    protected $primaryKey = 'decline_id';
    protected $fillable  =	['referee_id','leage_matches_id','league_id'];

    public function referee()
    {
        return $this->hasOne('App\Model\Referee','referee_id','referee_id');
    }

    public function leage_match()
    {
        return $this->hasOne('App\Model\LeageMatches','leage_matches_id','leage_matches_id');
    }

    public function league()
    {
        return $this->hasOne('App\Model\League','league_id','league_id');
    }
}
