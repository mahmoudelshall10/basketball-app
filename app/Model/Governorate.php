<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table			=	'governorates';
    protected $primaryKey		=	'gov_id';
    protected $fillable			=	['gov_id','governorate_name','governorate_name_en'];

    public function city()
    {
    	return $this->hasMany('App\Model\City','city_id');
    }
    
    public function referees()
    {
        return $this->hasMany('\App\Model\Referee','referee_id');
    }
}
