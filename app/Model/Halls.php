<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Halls extends Model
{
    protected $table		= 'halls';
    protected $primaryKey	= 'hall_id';
    protected $fillable		= ['hall_place','hall_name'];


    public function HallPlace()
    {
        return $this->belongsTo('App\Model\City','hall_place','city_id');
    }
}
