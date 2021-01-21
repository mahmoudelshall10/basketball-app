<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table 		= 'teams';
    protected $primaryKey	= 'team_id';
    protected $fillable		= ['team_name','team_logo','city_id'];
    protected $casts		= ['city_id'	=>	'integer']; 
    public function leagues()
	{
	 	return $this->hasMany('App\Model\LeaguesTeams','team_id');
    }
    
    public function city()
    {
        return $this->belongsTo('App\Model\City','city_id');
    }
}
