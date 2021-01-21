<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Exam;
use App\Model\Questions;
use App\Model\Referee;
use App\Model\ExamQuestions;
use App\Model\ExamReferee;
class AdminExamController extends Controller
{
    protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
        'video'             =>  3,
        'image'             =>  4,
    ];
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::orderBy('created_at','desc')->get();

        return view('panel.exam.index',['exams'=>$exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
                    'exam_title'            =>  'required|string',
                    'exam_slug'             =>  'required|string',
                    'exam_description'      =>  'required|string',
                    'exam_time_min'         => 'required|numeric|digits_between:2,3',
                ];
        $names  = [
                    'exam_title'            =>  'Exam Title',
                    'exam_slug'             =>  'Exam Slug',
                    'exam_description'      =>  'Exam Description',
                    'exam_time_min'         =>  'Exam Time',
                ];
        $data   =   $this->validate($request,$rules,[],$names);
        $exam   =   Exam::create($data);
        return redirect()->route('exam.index')->with('success','New Exam Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        return view('panel.exam.edit',['exam'=>$exam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $rules = [
                    'exam_title'            =>  'required|string',
                    'exam_slug'             =>  'required|string',
                    'exam_description'      =>  'required|string',
                    'exam_time_min'         => 'required|numeric|digits_between:2,3',
                ];
        $names  = [
                    'exam_title'            =>  'Exam Title',
                    'exam_slug'             =>  'Exam Slug',
                    'exam_description'      =>  'Exam Description',
                    'exam_time_min'         =>  'Exam Time',
                ];
        $data   =   $this->validate($request,$rules,[],$names);
        $exam->update($data);
        return redirect()->route('exam.index')->with('success','Exam Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function questionsIndex($id)
    {
        $exam = Exam::findOrFail($id);
        $questions = ExamQuestions::where('exam_id',$id)->get();
        $allQuestions = Questions::all();
        $singleChoiceCount = Questions::where('question_type',$this->options['single_choice'])->count();
        $multipleChoiceCount = Questions::where('question_type',$this->options['multi_choice'])->count();
        $textCount = Questions::where('question_type',$this->options['text'])->count();
        $videoCount = Questions::where('question_type',$this->options['video'])->count();
        $imageCount = Questions::where('question_type',$this->options['image'])->count();
        return view('panel.exam.questions.index',['exam'=>$exam,'questions'=>$questions,'all'=>$allQuestions,'singleChoiceCount' => $singleChoiceCount,'multipleChoiceCount'=>$multipleChoiceCount,'textCount'=>$textCount,'videoCount'=>$videoCount,'imageCount'=>$imageCount]);
    }
    public function questionsStore(Request $request,$id)
    {
        $exam = Exam::findOrFail($id);
        
        $rules = [
            'single_choice'         =>  'required|integer',
            'multiple_choice'       =>  'required|integer',
            'text_question'         =>  'required|integer',
            'image_question'         =>  'required|integer',
            'video_question'         =>  'required|integer',
        ];
        $names = [
            'single_choice'         =>  'Single Choice Questions',
            'multiple_choice'       =>  'Multiple Choice Questions',
            'text_question'         =>  'Text Questions',
            'image_question'         =>  'Image Questions',
            'video_question'         =>  'Video Questions',
        ];
        $data = $this->validate($request,$rules,[],$names);
        // dd($data);
        $singleChoiceCount = Questions::where('question_type',$this->options['single_choice'])->count();
        if($singleChoiceCount < (int) $data['single_choice'] )
        {
            return back()->withErrors(['single_choice'=>'Single Choice Questions is less than Your Number']);
        }
        $multipleChoiceCount = Questions::where('question_type',$this->options['multi_choice'])->count();
        // dd((int) $data['multiple_choice']);
        if($multipleChoiceCount < (int) $data['multiple_choice'] )
        {
            return back()->withErrors(['multiple_choice'=>'Multiple Choice Questions is less than Your Number']);
        }
        $textCount = Questions::where('question_type',$this->options['text'])->count();
        if($textCount < (int) $data['text_question'] )
        {
            return back()->withErrors(['text_question'=>'Text Questions is less than Your Number']);
        }
        $randomSingle = Questions::where('question_type',$this->options['single_choice'])->inRandomOrder()->distinct()->limit((int)$data['single_choice'])->get();
        $randomMulti = Questions::where('question_type',$this->options['multi_choice'])->inRandomOrder()->distinct()->limit((int)$data['multiple_choice'])->get();
        $randomText = Questions::where('question_type',$this->options['text'])->inRandomOrder()->distinct()->limit((int)$data['text_question'])->get();
        $randomVideo = Questions::where('question_type',$this->options['video'])->inRandomOrder()->distinct()->limit((int)$data['video_question'])->get();
        $randomImage = Questions::where('question_type',$this->options['image'])->inRandomOrder()->distinct()->limit((int)$data['image_question'])->get();
        // dd($randomSingle);//inRandomOrder()
        foreach ($randomSingle as $single) {
           $examQuestions =  ExamQuestions::create(['exam_id'=>$id,'question_id'=>$single->question_id]);
        }
        foreach ($randomMulti as $multi) {
           $examQuestions =  ExamQuestions::create(['exam_id'=>$id,'question_id'=>$multi->question_id]);
        }
        foreach ($randomText as $text) {
           $examQuestions =  ExamQuestions::create(['exam_id'=>$id,'question_id'=>$text->question_id]);
        }
        foreach ($randomVideo as $video) {
           $examQuestions =  ExamQuestions::create(['exam_id'=>$id,'question_id'=>$video->question_id]);
        }
        foreach ($randomImage as $image) {
           $examQuestions =  ExamQuestions::create(['exam_id'=>$id,'question_id'=>$image->question_id]);
        }
        
         return redirect()->route('examQuestion.index',$id)->with('success','New Question Added Successfully');
    } 
    public function questionDestroy($exam_id,$exam_question_id)
    {
        $question = ExamQuestions::where('exam_id',$exam_id)->findOrFail($exam_question_id);
        $question->delete();
        return redirect()->route('examQuestion.index',$exam_id)->with('success','Question Deleted Successfully');
    }
    public function refereesIndex($id)
    {
        $exam = Exam::findOrFail($id);
        $referee = ExamReferee::where('exam_id',$id)->get();
        $allReferees = Referee::all();
        return view('panel.exam.referees.index',['exam'=>$exam,'referees'=>$referee,'all'=>$allReferees]);
    }
   
    public function refereeStore(Request $request,$id)
    {
        $exam = Exam::findOrFail($id);
        $rules = [
            'referee_id.*'  =>  'required|integer|exists:referees,referee_id',
            'referee_id'    =>  'required|array|min:1',
        ];
        $names = [
            'referee_id'       =>  'Referees',
        ];
        $data = $this->validate($request,$rules,[],$names);
        $refereeIds = $request->referee_id;

        $refereesCount = ExamReferee::where('exam_id',$id)->whereIn('referee_id',$refereeIds)->count();
        if($refereesCount > 0 )
        {
            return back()->withErrors(['referee_id'=>'One Of Referees Already Assigned To This Exam']);
        }
        $data['exam_id'] = $id;
        foreach ($refereeIds as $referee) {
           
            $data['referee_id'] = $referee;
            $examReferee =  ExamReferee::create($data);
             
        }
         return redirect()->route('examReferee.index',$id)->with('success','Referee Assigned Successfully');
    } 
    public function refereeDestroy($exam_id,$exam_referee_id)
    {
        $referee = ExamReferee::where('exam_id',$exam_id)->findOrFail($exam_referee_id);
        $referee->delete();
        return redirect()->route('examReferee.index',$exam_id)->with('success','Referee Deleted Successfully');
    }
}
