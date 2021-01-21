<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $table 		= 'leagues';
    protected $primaryKey 	= 'league_id';
    protected $fillable		= ['league_name','league_type','league_start_date','league_end_date'];
    public function teams()
	{
	 	return $this->hasMany('App\Model\LeaguesTeams','team_id');
	}
}
