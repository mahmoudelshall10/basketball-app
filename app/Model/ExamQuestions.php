<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamQuestions extends Model
{
    protected	$table			=	'exam_questions';
    protected	$primaryKey		=	'exam_question_id';
    protected	$fillable		=	['exam_id','question_id'];

    public function exam()
    {
    	return $this->belongsTo('App\Model\Exam','exam_id')->with('referee');
    }
    public function question()
    {
        return $this->belongsTo('App\Model\Questions','question_id')->with('answers');
    }
    public function selected()
    {
    	return $this->hasMany('App\Model\ExamAnswers','question_id')->with('selectedOptions');

    }
}
