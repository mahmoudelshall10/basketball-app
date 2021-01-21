<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RefereeRoles extends Model
{
    protected $table = 'referee_roles';
    protected $primaryKey 	= 'referee_role_id';
    protected $fillable		= [
        'referee_role_id',
        'referee_place_id',
        'role_ar',
        'role_en',
      ];//

      public function referee_place()
      {
         return $this->hasMany('\App\Model\RefereePlaces','referee_place_id','referee_place_id');
      }
}
