<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionsOption extends Model
{
    protected $table 		=	'questions_options';
    protected $primaryKey	=	'option_id';
    protected $fillable		=	[
    								'question_id',
    								'option_text',
    								'option_url',
                                    'option_correct',
                                    'option_type',
    							];
	protected $casts		=	[
									'question_id'			=>	'integer',
                                    'option_correct'        =>  'integer',
									'option_type'		    =>	'integer',
								];
    public function question()
    {
     return $this->belongsTo('App\Model\Questions','question_id');
    } 
}
