<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Teams;
use App\Model\League;
use File;
use App\Http\Controllers\Controller;
use App\Model\City;

class AdminTeamController extends Controller
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
        $teams = Teams::orderBy('created_at','desc')->get();
        return view('panel.team.index',['teams'=>$teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrCities = City::get();
        return view('panel.team.create',compact('arrCities'));
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
            'team_name'     =>  'required|string',
            'city_id'       =>  'required|integer|exists:cities,city_id',
            'team_logo'     =>  'required|image|mimes:jpeg,jpg,png,bmp,gif',
        ];
        $names = [
            'team_name'     =>  'Team Name',
            'city_id'       =>  'City Name',
            'team_logo'     =>  'Team Logo',
        ];
        $data = $this->validate($request,$rules,[],$names);
        
         if (!file_exists('teams_logos/')) {
                mkdir('teams_logos/', 0777, true);
            }
            
        if($request->hasFile('team_logo') ){
            $image = $request->team_logo;
            $fileName = time()."-$request->team_name.".$image->getClientOriginalExtension();
            $image->move('teams_logos/', $fileName);
            $uploadImage = 'teams_logos/'.$fileName;
            $data['team_logo']  = $uploadImage;

        }
        $data['city_id'] = request('city_id');
        $team = Teams::create($data);
        return redirect()->route('team.index')->with('success','New Team Created Successfully');
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
        $team = Teams::findOrFail($id);
        $arrCities = City::get();
        return view('panel.team.edit',['team'=>$team , 'arrCities'=>$arrCities]);
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
        $team = Teams::findOrFail($id);
        $rules = [
            'team_name'     =>  'required|string',
            'city_id'       =>  'required|integer|exists:cities,city_id',
            'team_logo'     =>  'nullable|image|mimes:jpeg,jpg,png,bmp,gif',
        ];
        $names = [
            'team_name'     =>  'Team Name',
            'city_id'     =>  'City Name',
            'team_logo'     =>  'Team Logo',
        ];
        $data = $this->validate($request,$rules,[],$names);
         if (!file_exists('public/teams_logos/')) {
                mkdir('public/teams_logos/', 0777, true);
            }
            
        if($request->hasFile('team_logo') ){
            $image = $request->team_logo;
            $fileName = time()."$request->team_name.".$image->getClientOriginalExtension();
            $image->move('public/teams_logos/', $fileName);
            $uploadImage = 'public/teams_logos/'.$fileName;
            $data['team_logo']  = $uploadImage;
            File::delete($team->team_logo);
        }
        $data['city_id'] = request('city_id');
        $team->update($data);
        return redirect()->route('team.index')->with('success','New Team Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Teams::findOrFail($id);
        File::delete($team->team_logo);
        $team->delete();
        return redirect()->route('team.index')->with('success','Team Deleted Successfully');
    }
}
