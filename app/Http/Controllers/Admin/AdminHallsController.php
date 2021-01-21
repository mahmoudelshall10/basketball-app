<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Halls;
use App\Http\Controllers\Controller;
use App\Model\City;
class AdminHallsController extends Controller
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
        $halls = Halls::orderBy('created_at','desc')->get();
        return view('panel.hall.index',['halls'=>$halls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderBy('gov_id')->get(); 
        return view('panel.hall.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules  = [
            'hall_name'=>'required|string',
            'hall_place'=>'required|integer|exists:cities,city_id',
        ];
        $names  = [
            'hall_name'=>'Hall Name',
            'hall_place'=>'Hall Place',
        ];
        $data   = $this->validate($request,$rules,[],$names);
        $hall = Halls::create($data);
        return redirect()->route('hall.index')->with('success','New Hall Created Successfully'); 
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
        $hall = Halls::findOrFail($id);
        $cities = City::orderBy('gov_id')->get(); 
        return view('panel.hall.edit',['hall'=>$hall , 'cities'=>$cities]);
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
        $hall = Halls::findOrFail($id);
        $rules  = [
            'hall_name'   => 'required|string',
            'hall_place'  => "required|integer|exists:cities,city_id",
        ];
        $names  = [
            'hall_name'=>'Hall Name',
            'hall_place'=>'Hall Place',
        ];
        $data  = $this->validate($request,$rules,[],$names);
        $hall->update($data);
        return redirect()->route('hall.index')->with('success',' Hall Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hall = Halls::findOrFail($id);
        $hall->delete();
        return redirect()->route('hall.index')->with('success',' Hall Deleted Successfully'); 
    }
}
