<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamAnswers extends Model
{
    protected $table		=	'exam_answers';
    protected $primaryKey	=	'exam_answer_id';
    protected $fillable	=	[
    								'referee_id',
    								'exam_id',
    								'question_id',
    								'option_id',
    								'text_option',
    								'answer_score'
								];
    protected $casts		=	[
    								'referee_id'		=>	'integer',
    								'exam_id'			=>	'integer',
    								'question_id'		=>	'integer',
    								'option_id'			=>	'integer',
    							];
	public function selectedOptions()
    {
        return $this->hasMany('App\Model\ExamAnswerOption','exam_answer_id');
    }
}
