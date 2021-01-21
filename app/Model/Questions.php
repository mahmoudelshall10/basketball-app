<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table 		=	'questions';
    protected $primaryKey	=	'question_id';
    protected $fillable		=	[
    								'question_content',
    								'question_file',
    								'question_score',
    								'question_type',
                                    'file_type',
                                    'file_extention',
                                ];
    protected $casts        =   [
                                    'question_type'     =>  'integer',
                                    'file_type'         =>  'integer',
								];
    public function answers()
    {
        return $this->hasMany('App\Model\QuestionsOption','question_id');
    }
}
