<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\News;
use File;
use App\Http\Controllers\Controller;
class AdminNewsController extends Controller
{
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
         $news = News::orderBy('created_at','desc')->get();

        return view('panel.news.index',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.news.create');
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
            'new_title'             =>  'required|string',
            'new_description'       =>  'required|string',
            'new_image'             =>  'required|image|mimes:jpeg,jpg,png,bmp,gif',
        ];
        $names = [
            'new_title'             =>  'News Title',
            'new_description'       =>  'News Description',
            'new_image'             =>  'News Image',
        ];
        $data = $this->validate($request,$rules,[],$names);
        if (!file_exists('public/news_images/')) {
                mkdir('public/news_images/', 0777, true);
            }
            
        if($request->hasFile('new_image') ){
            $image = $request->new_image;
            $fileName = time()."-$request->new_title.".$image->getClientOriginalExtension();
            $image->move('public/news_images/', $fileName);
            $uploadImage = 'public/news_images/'.$fileName;
            $data['new_image']  = $uploadImage;

        }
        $news = News::create($data);
        return redirect()->route('news.index')->with('success','New News Created Successfully');
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
        $news = News::findOrFail($id);
        return view('panel.news.edit',['news'=>$news]);
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
        $news = News::findOrFail($id);
         $rules = [
            'new_title'             =>  'required|string',
            'new_description'       =>  'required|string',
            'new_image'             =>  'nullable|image|mimes:jpeg,jpg,png,bmp,gif',
        ];
        $names = [
            'new_title'             =>  'News Title',
            'new_description'       =>  'News Description',
            'new_image'             =>  'News Image',
        ];
        $data = $this->validate($request,$rules,[],$names);
        
            
        if($request->hasFile('new_image') ){
            $image = $request->new_image;
            $fileName = time()."-$news->new_title.".$image->getClientOriginalExtension();
            $image->move('public/news_images/', $fileName);
            $uploadImage = 'public/news_images/'.$fileName;
            $data['new_image']  = $uploadImage;
            File::delete($news->new_image);

        }
        $news->update($data);
        return redirect()->route('news.index')->with('success','News Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        File::delete($news->new_image);
        $news->delete();
        return redirect()->route('news.index')->with('success','News Deleted Successfully');
    }
}
