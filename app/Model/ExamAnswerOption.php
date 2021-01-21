<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamAnswerOption extends Model
{
    protected $table		=	'exam_answer_options';
    protected $primaryKey	=	'exam_answer_option_id';
    protected $fillable		=	[
    								'exam_answer_id',
    								'option_id',
    							];
	protected $casts		=	[
    								'exam_answer_id'	=>	'Integer',
    								'option_id'			=>	'Integer',
    							];
    							
}
