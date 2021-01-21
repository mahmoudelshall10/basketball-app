<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Model\Exam;
use App\Model\LeageMatches;
use App\Model\ExamReferee;
use App\Model\ExamQuestions;
use App\Model\Questions;
use App\Model\QuestionsOption;
use App\Model\ExamAnswers;
use App\Model\ExamAnswerOption;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\PublicResource as GlobalResource;
class IndexController extends Controller
{
	protected $examStatus = ['new'=> 0 ,'running'=>1,'completed'=>2];
    protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
    ];
    public function getNews()
    {
    	$news = News::paginate(20);
    	$data = new GlobalResource($news);
    	$responseData = array('success'=>'1', 'store'=>$data, 'message'=>"return all News.");
        return $responseData;
    }
    public function homeData(Request $request)
    {
        $rules = [
            'referee_id'       =>  'required|integer||exists:referees,referee_id',
        ];
        $names = [
            'referee_id'       =>  'Referee',
        ];
        $validate=Validator::make($request->all(),$rules,[],$names);
        if($validate->fails())
        {
            $errorString = implode(",",$validate->messages()->all());
            $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
            return $responseData;
        }else{
        	$referee_id = $request->referee_id;
        	$exams = Exam::withCount('question')->whereHas('referee', function (Builder $query) use($referee_id) {
                                $query->where('referee_id', '=', $referee_id)->where('exam_status','<>',$this->examStatus['completed']);
                            })->with('referee')->get();
            $exams = new GlobalResource($exams);
        	$matches = LeageMatches::with('league','home','away','hall','referee')->whereHas('referee', function (Builder $query) use($referee_id) {
                                $query->where('referee_id', '=', $referee_id);
                            })->get();
            $matches = new GlobalResource($matches);
            $responseData = array('success'=>'1', 'exams'=>$exams,'Matches'=>$matches, 'message'=>"return home Data.");
        return $responseData;
        }
    }

     public function getQuestion(Request $request)
    {
        $rules = [
            'referee_id'        =>  'required|integer||exists:referees,referee_id',
            'exam_id'           =>  'required|integer||exists:exams,exam_id',
            'is_answer'         =>  'required|integer|between:0,1',
        ];
        $names = [
            'referee_id'        =>  'Referee',
            'exam_id'           =>  'Exam',
            'is_answer'         =>  'Is Answer',
        ];
        $validate=Validator::make($request->all(),$rules,[],$names);
        if($validate->fails())
        {
            $errorString = implode(",",$validate->messages()->all());
            $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
            return $responseData;
        }else{
            if((int)$request->is_answer === 1 )
            {
                        
                $rules  =   [
                    'question_id'       =>  'required|integer|exists:questions,question_id',
                    'option_id.*'         =>  'nullable|integer|exists:questions_options,option_id',
                    'text_option'         =>  'nullable|string|max:255',
                ];
                $names  =    [
                    'question_id'         =>  'Question',
                    'option_id.*'         =>  'Option',
                    'text_option'         =>  'Text',
                ];
                 $validate=Validator::make($request->all(),$rules,[],$names);
                if($validate->fails())
                {
                    $errorString = implode(",",$validate->messages()->all());
                    $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
                    return $responseData;
                }else{
                    $questionOption = Questions::findOrFail($request->question_id);
                    $answerData = [
                        'referee_id'        =>  $request->referee_id,
                        'exam_id'           =>  $request->exam_id,
                        'question_id'       =>  $request->question_id,
                    ];
                    $correctOptionsCount    =   QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->count();
                    if($request->has('option_id') && $request->option_id)
                    {
                        $optionsAnswerCount = QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->whereIn('option_id',$request->option_id)->count();
                        $options = QuestionsOption::where('question_id',$request->question_id)->whereIn('option_id',$request->option_id)->get();
                        if(count($options) >0)
                        {

                            if($correctOptionsCount === $optionsAnswerCount)
                            {
                                $newAnswerData['answer_score'] = $questionOption->question_score;
                            }else{
                                $newAnswerData['answer_score'] = 0;
                            }
                                $examAnswer = ExamAnswers::updateOrCreate($answerData,$newAnswerData); 
                                $examOptionDestroy  =   ExamAnswerOption::where('exam_answer_id',$examAnswer->exam_answer_id)->delete();
                                $optionAnswerData =[];       
                            foreach ($options as $option) {
                                $optionAnswerData['option_id']          =   $option->option_id;
                                $optionAnswerData['exam_answer_id']     =   $examAnswer->exam_answer_id;
                                $answerOption =     ExamAnswerOption::create($optionAnswerData);
                                
                            }
                        }
                    }elseif ($request->has('text_option')  && $request->text_option) {
                        
                        $optionsAnswerCount = QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->where('option_text',$request->text_option)->count();
                        if($optionsAnswerCount > 0)
                            {
                                $newAnswerData['answer_score'] = $questionOption->question_score;
                            }else{
                                $newAnswerData['answer_score'] = 0;
                            }
                            $newAnswerData['text_option'] = $request->text_option;
                            $examAnswer = ExamAnswers::updateOrCreate($answerData,$newAnswerData); 
                    }
                }
            }
            $referee_id = $request->referee_id;
            $exam_id = $request->exam_id;
            $refereeExam    = ExamReferee::where('exam_id',$exam_id)->where('referee_id',$referee_id)->firstOrFail();
            if($refereeExam->exam_started_at === null)
            {
                $refereeExam->update(['exam_started_at' => round(microtime(true) * 1000),'exam_status'=>$this->examStatus['running']]);
            }
            
            $questions = ExamQuestions::with('question','exam')->whereHas('exam', function (Builder $query) use($exam_id,$referee_id) {
                                $query->where('exam_id', '=', $exam_id)->whereHas('referee', function (Builder $query) use($referee_id) {
                                $query->where('referee_id', '=', $referee_id);
                            });
                            })->paginate(1);
            
            $question = new GlobalResource($questions);
            $responseData = array('success'=>'1', 'question'=>$question, 'message'=>"return home Data.");
            if(count($questions) >0)
            {
                $selectedAnswer = ExamAnswers::with('selectedOptions')->where('exam_id',$exam_id)->where('referee_id',$referee_id)->where('question_id',$questions->first()->question_id)->get();
                $selected = new GlobalResource($selectedAnswer);
                $responseData['selected']=$selected;
            }
            return $responseData;
        }
    }

    public function finishExam(Request $request)
    {
        $rules = [
            'referee_id'        =>  'required|integer||exists:referees,referee_id',
            'exam_id'           =>  'required|integer||exists:exams,exam_id',
            'is_answer'         =>  'required|integer|between:0,1',
        ];
        $names = [
            'referee_id'        =>  'Referee',
            'exam_id'           =>  'Exam',
            'is_answer'         =>  'Is Answer',
        ];
        $validate=Validator::make($request->all(),$rules,[],$names);
        if($validate->fails())
        {
            $errorString = implode(",",$validate->messages()->all());
            $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
            return $responseData;
        }else{
            if((int)$request->is_answer === 1 )
            {
                        
                $rules  =   [
                    'question_id'       =>  'required|integer|exists:questions,question_id',
                    'option_id.*'         =>  'nullable|integer|exists:questions_options,option_id',
                    'text_option'         =>  'nullable|string|max:255',
                ];
                $names  =    [
                    'question_id'         =>  'Question',
                    'option_id.*'         =>  'Option',
                    'text_option'         =>  'Text',
                ];
                 $validate=Validator::make($request->all(),$rules,[],$names);
                if($validate->fails())
                {
                    $errorString = implode(",",$validate->messages()->all());
                    $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
                    return $responseData;
                }else{
                    $questionOption = Questions::findOrFail($request->question_id);
                    $answerData = [
                        'referee_id'        =>  $request->referee_id,
                        'exam_id'           =>  $request->exam_id,
                        'question_id'       =>  $request->question_id,
                    ];
                    $correctOptionsCount    =   QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->count();
                    if($request->has('option_id') && $request->option_id)
                    {
                        $optionsAnswerCount = QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->whereIn('option_id',$request->option_id)->count();
                        $options = QuestionsOption::where('question_id',$request->question_id)->whereIn('option_id',$request->option_id)->get();
                        if(count($options) >0)
                        {

                            if($correctOptionsCount === $optionsAnswerCount)
                            {
                                $newAnswerData['answer_score'] = $questionOption->question_score;
                            }else{
                                $newAnswerData['answer_score'] = 0;
                            }
                                $examAnswer = ExamAnswers::updateOrCreate($answerData,$newAnswerData); 
                                $examOptionDestroy  =   ExamAnswerOption::where('exam_answer_id',$examAnswer->exam_answer_id)->delete();
                                $optionAnswerData =[];       
                            foreach ($options as $option) {
                                $optionAnswerData['option_id']          =   $option->option_id;
                                $optionAnswerData['exam_answer_id']     =   $examAnswer->exam_answer_id;
                                $answerOption =     ExamAnswerOption::create($optionAnswerData);
                                
                            }
                        }
                    }elseif ($request->has('text_option')  && $request->text_option) {
                        
                        $optionsAnswerCount = QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->where('option_text',$request->text_option)->count();
                        if($optionsAnswerCount > 0)
                            {
                                $newAnswerData['answer_score'] = $questionOption->question_score;
                            }else{
                                $newAnswerData['answer_score'] = 0;
                            }
                            $newAnswerData['text_option'] = $request->text_option;
                            $examAnswer = ExamAnswers::updateOrCreate($answerData,$newAnswerData); 
                    }
                }
            }
            $referee_id = $request->referee_id;
            $exam_id = $request->exam_id;
            $refereeExam    = ExamReferee::where('exam_id',$exam_id)->where('referee_id',$referee_id)->firstOrFail();
            $refereeExam->update(['exam_ended_at' => round(microtime(true) * 1000),'exam_status'=>$this->examStatus['completed']]);
            $responseData = array('success'=>'1', 'data'=>json_decode("{}"), 'message'=>"Exam Finished Successfully.");
            return $responseData;

        }
    }
}
