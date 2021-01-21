<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admins extends Authenticatable
{
    protected $table 		= 'administrators';

    protected $primaryKey 	= 'admins_id';

    protected $fillable		= ['admin_username','admin_email','admin_user_type','admin_fullname','admin_password','admin_email_verified_at'];

    protected $hidden		= [ 'password', 'remember_token', 'created_at' , 'updated_at' , 'admin_email_verified_at'];

    protected $casts		= [
    								'admin_user_type' => 'integer',

							  ];
							  
  	public function getAuthPassword()
	{
    	return $this->admin_password;
	}
	
}
