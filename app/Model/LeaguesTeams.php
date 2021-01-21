<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeaguesTeams extends Model
{
    protected	$table			=	'leagues_teams';
    protected	$primaryKey		=	'leagues_teams_id';
    protected	$fillable		=	[
    									'team_id',
    									'league_id'
									];
    protected	$casts			=	[
    									'team_id'	=>	'integer',
    									'league_id'	=>	'integer',
    								];
    public function league()
    {
     return $this->belongsTo('App\Model\League','league_id');
    } 
    public function team()
    {
     return $this->belongsTo('App\Model\Teams','team_id');
    } 
}
