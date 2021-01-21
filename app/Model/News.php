<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table  			=  'news';
    protected $primaryKey		=  'new_id';
    protected $fillable			=  ['new_title','new_description','new_image'];
    protected $hidden			=  ['created_at' ,'updated_at'];
}
