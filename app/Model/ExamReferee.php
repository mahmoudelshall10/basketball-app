<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamReferee extends Model
{
    protected $table			=	'exam_referees';
    protected $primaryKey		=	'exam_referee_id';
    protected $fillable			=	['exam_id','referee_id','exam_started_at','exam_ended_at','exam_status'];
    protected $casts			=	[
    									'exam_id' 			=> 'integer',
                                        'referee_id'        => 'integer',
    									'exam_status' 		=> 'integer',
    									// 'exam_expiry_date' 	=> 'date',
    								];
    public function exam()
    {
    	return $this->belongsTo('App\Model\Exam','exam_id');
    }
    public function referee()
    {
    	return $this->belongsTo('App\Model\Referee','referee_id');
    }
}
