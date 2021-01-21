<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table 		=	'exams';
    protected $primaryKey	=	'exam_id';
    protected $fillable		=	['exam_title','exam_slug','exam_description','exam_time_min']; 
    protected $hidden		=  	['created_at' ,'updated_at'];
    
    public function question()
    {
        return $this->hasMany('App\Model\ExamQuestions','exam_id');
    }
    public function referee()
    {
        return $this->hasMany('App\Model\ExamReferee','exam_id');
    }
}
