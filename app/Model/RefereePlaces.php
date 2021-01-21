<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RefereePlaces extends Model
{
    protected $table = 'referee_places';
    protected $primaryKey 	= 'referee_place_id';
    protected $fillable		= [
        'referee_place_id',
        'referee_position',
      ];

      public function referee_role()
      {
          $this->hasOne('App\RefereeRoles','referee_place_id');
      }
}
