<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Questions;
use App\Model\QuestionsOption;
use App\Http\Controllers\Controller;
class AdminQuestionOptionController extends Controller
{
    protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
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
        $options = QuestionsOption::orderBy('created_at','desc')->get();
        return view('panel.option.index',['options'  =>  $options]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //this method for single Option Question
        $questions = Questions::get();
        return view('panel.option.create',['questions' => $questions]);
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
            'question_id'       =>  'required|integer||exists:questions,question_id',
            'option_text'       =>  'required|string',
            'option_correct'    =>  'required|integer|between:0,1',
        ];
        $names = [
            'question_id'       =>  'Question',
            'option_text'       =>  'Option Text',
            'option_correct'    =>  'Option Answer Status',
        ];
        $data = $this->validate($request,$rules,[],$names);
        $question = Questions::findOrFail($request->question_id);
        $optionsCount = QuestionsOption::where('question_id',$request->question_id)->where('option_correct',1)->count();
        if($question->question_type === $this->options['single_choice']  && $optionsCount > 0 && (int) $request->option_correct === 1 )
        {
            return back()->withErrors(['question_id'=>'The Question is Single Choice And Have Correct Option']);
        }
        if($question->question_type === $this->options['text']  && $optionsCount > 0 )
        {
            return back()->withErrors(['question_id'=>'The Question is Type Text You Can Update The Current Option']);
        }
        $data['option_type'] = $question->question_type;
        $option = QuestionsOption::create($data);
        return redirect()->route('question_option.index')->with('success','New Option Created Successfully');
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
        $option = QuestionsOption::findOrFail($id);
        $questions = Questions::get();
        return view('panel.option.edit',['questions' => $questions,'option'=>$option]);
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
         $option = QuestionsOption::findOrFail($id);
         $rules = [
            'question_id'       =>  'required|integer||exists:questions,question_id',
            'option_text'       =>  'required|string',
            'option_correct'    =>  'required|integer|between:0,1',
        ];
        $names = [
            'question_id'       =>  'Question',
            'option_text'       =>  'Option Text',
            'option_correct'    =>  'Option Answer Status',
        ];
        $data = $this->validate($request,$rules,[],$names);
        $question = Questions::findOrFail($request->question_id);
        $optionsCount = QuestionsOption::where('question_id',$request->question_id)->where('option_id','<>',$id)->where('option_correct',1)->count();
        
        if($question->question_type === $this->options['single_choice']  && $optionsCount > 0 )
        {
            return back()->withErrors(['question_id'=>'The Question is Single Choice And Have Correct Option']);
        }
        $data['option_type'] = $question->question_type;
        $option->update($data);
        return redirect()->route('question_option.index')->with('success','Option Updated Successfully');
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
}
