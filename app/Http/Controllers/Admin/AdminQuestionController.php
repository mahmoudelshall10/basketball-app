<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Questions;
use App\Model\QuestionsOption;
use File;
use App\Http\Controllers\Controller;
class AdminQuestionController extends Controller
{
    protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
        'video'             =>  3,
        'image'             =>  4,
    ];
    protected $file_types = [
        'image'             => 1,
        'video'             => 2,
    ];
    protected $video_extentions =   ['mp4','avi','flv','wmv','mkv','mpeg'];//,video/avi,video/mp4,video/flv,video/wmv,video/mkv,audio/mpeg
    protected $image_extentions =   ['jpeg','jpg','png','bmp','gif'];
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
        $questions = Questions::orderBy('created_at','desc')->get();
        return view('panel.question.index',['questions'  =>  $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.question.create');
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
            'question_content'      =>  'required|string|max:255',
            'question_score'        =>  'required|numeric',
            'question_type'         =>  'required|integer|between:0,4',
            'question_file'         =>  'nullable|file|mimetypes:image/jpeg,image/jpg,image/bmp,image/png,image/gif',
            'option_text.*'         =>  'required|string',
            'option_correct.*'      =>  'required|integer',
            'option_url'            =>  'nullable|url',
        ];
        $names = [
            'question_content'      =>  'Question Content',
            'question_score'        =>  'Question Score',
            'question_type'         =>  'Question Type',
            'question_file'         =>  'Question File',
            'option_text'           =>  'Option Text',
            'option_correct'        =>  'Option Answer Status',
        ];
        $data = $this->validate($request,$rules,[],$names);
        $option_text= $request->option_text;
        $option_correct= $request->option_correct;
        // if(in_array(0, $option_correct))
        // {

        // dd($option_correct);
        // }else{
        //     dd("failed");
        // }

        if (!file_exists('public/question_file/')) {
                mkdir('public/question_file/', 0777, true);
            }
            
        if($request->hasFile('question_file') ){
            $image = $request->question_file;
            $fileName = time().".".$image->getClientOriginalExtension();
            $image->move('public/question_file/', $fileName);
            $uploadImage = 'public/question_file/'.$fileName;
            $data['question_file']  = $uploadImage;
            if (in_array($request->question_file->getClientOriginalExtension(), $this->video_extentions)) 
            { 
                $data['file_type']  = $this->file_types['video'];
                $data['file_extention']  = $request->question_file->getClientOriginalExtension();
            } elseif(in_array($request->question_file->getClientOriginalExtension(), $this->image_extentions)){
                $data['file_type']  = $this->file_types['image'];
                $data['file_extention']  = $request->question_file->getClientOriginalExtension();
            }
        }
        $question = Questions::create($data);
       for ($i=0; $i < count($option_text) ; $i++) { 
          $info['option_text']  =   $option_text[$i];
          $info['question_id']  =   $question->question_id;
          if($request->has('option_url') && $request->option_url)
          {
            $info['option_url'] =   $request->option_url;
          }
          if(in_array($i, $option_correct)  )
          {
            $info['option_correct'] = 1;
            
          }else{
            $info['option_correct'] = 0;
          }
            
          $info['option_type']  = $question->question_type;
          $option = QuestionsOption::create($info);

       }
        return redirect()->route('question.index')->with('success','New Question Created Successfully');
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
        $question = Questions::findOrFail($id);
        return view('panel.question.edit',['question' => $question]);
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
        $question = Questions::findOrFail($id);
         $rules = [
            'question_content'      =>  'required|string|max:255',
            'question_score'        =>  'required|numeric',
            'question_type'         =>  'required|integer|between:0,2',
            'question_file'         =>  'nullable|file|mimetypes:image/jpeg,image/jpg,image/bmp,image/png,image/gif,video/avi,video/mp4,video/flv,video/wmv,video/mkv,audio/mpeg',
        ];
        $names = [
            'question_content'      =>  'Question Content',
            'question_score'        =>  'Question Score',
            'question_type'         =>  'Question Type',
            'question_file'         =>  'Question File',
        ];
        $data = $this->validate($request,$rules,[],$names);
        if($request->hasFile('question_file') ){
            $image = $request->question_file;
            $fileName = time().".".$image->getClientOriginalExtension();
            $image->move('public/question_file/', $fileName);
            $uploadImage = 'public/question_file/'.$fileName;
            $data['question_file']  = $uploadImage;
            File::delete($question->question_file);
            if (in_array($request->question_file->getClientOriginalExtension(), $this->video_extentions)) 
            { 
                $data['file_type']  = $this->file_types['video'];
                $data['file_extention']  = $request->question_file->getClientOriginalExtension();
            } elseif(in_array($request->question_file->getClientOriginalExtension(), $this->image_extentions)){
                $data['file_type']  = $this->file_types['image'];
                $data['file_extention']  = $request->question_file->getClientOriginalExtension();
            }
        }
        $question->update($data);
        return redirect()->route('question.index')->with('success','Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Questions::findOrFail($id);
        $options =  QuestionsOption::where('question_id',$id)->get();
        foreach ($options as $option) {
            $option->delete();
        }
        if($question->question_file !== null)
        {
            File::delete($question->question_file);
        }
        $question->delete();
        return redirect()->route('question.index')->with('success','Question Deleted Successfully');
    }
    
}
