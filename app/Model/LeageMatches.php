<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeageMatches extends Model
{
    protected $table 		= 'leage_matches';
    protected $primaryKey	= 'leage_matches_id';
    protected $fillable		= [
    							'league_id',
    							'home_team',
    							'away_team',
    							'match_hall',
                                'match_date',
                                'is_sent',
                                'num_of_periods',
                                'score_sheet_image',
    						];
	protected $casts		= [
								'league_id'		=>		'integer',
								'home_team'		=>		'integer',
    							'away_team'		=>		'integer',
    							'match_hall'	=>		'integer',
							];
    public function league()
    {
        return $this->belongsTo('App\Model\League','league_id');
    } 
    public function home()
    {
        return $this->belongsTo('App\Model\Teams','home_team');
    }
    public function away()
    {
        return $this->belongsTo('App\Model\Teams','away_team');
    } 
    public function hall()
    {
        return $this->belongsTo('App\Model\Halls','match_hall');
    }
    public function referee()
    {
        return $this->hasMany('App\Model\MatchesReferees','leage_matches_id')->with('referee');
    }

    public function match_referee()
    {
        return $this->hasMany('App\Model\MatchesReferees','leage_matches_id');
    }
    
    public function getNextId() 
    {
        $statement = DB::select("show table status like 'leage_matches'");
        
        return $statement[0]->Auto_increment;
    }
    
    public function allowance()
    {
        return $this->hasMany('App\Model\Allowance','leage_matches_id');
    }
}
