<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table			=	'cities';
    protected $primaryKey		=	'city_id';
    protected $fillable			=	['city_id','gov_id','city_name','city_name_en'];

    public function governorate()
    {
    	return $this->belongsTo('App\Model\Governorate','gov_id');
    }

    
}
