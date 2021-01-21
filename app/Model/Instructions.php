<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Instructions extends Model
{
    protected $table		= 'instructions';
    protected $primaryKey	= 'instruction_id';
    protected $fillable		= ['instruction'];
}
