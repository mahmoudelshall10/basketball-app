<?php

namespace App\Model;

// use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Referee extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table 		= 'referees';

    protected $primaryKey 	= 'referee_id';

    protected $fillable		= [
    							'referee_username',
    							'referee_mobile',
    							'referee_email',
    							'refree_password',
    							'referee_fullname',
    							'referee_fullname_ar',
                                'referee_address',
                                'gov_id',
                                'city_id',
    							'referee_birthday',
    							'referee_nationl_identity',
                                'referee_identity',
                                'referee_card_number',
    							'referee_image',
    							'referee_type',
    						  ];

  	protected $hidden		= [ 
  								'refree_password',
  								'created_at' ,
  								'updated_at'
  							  ];
  							  
    protected $casts		= [
    							'referee_birthday'	=>	'date',
    							'referee_type'		=>	'integer',
    							'referee_type'		=>	'string',
    						  ];
   public function getAuthPassword()
    {
        return $this->refree_password;
    } 
    public function username()
    {
        return $this->admin_username;
    }            
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function city()
    {
        return $this->hasOne('App\Model\City','city_id','city_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification','notification_id');
    }
    
    public function MatchesReferees()
    {
        return $this->hasMany('App\Model\MatchesReferees','matches_referee_id');
    }

    public function gov()
    {
        return $this->hasOne('\App\Model\Governorate','gov_id','gov_id');
    }
    
}
