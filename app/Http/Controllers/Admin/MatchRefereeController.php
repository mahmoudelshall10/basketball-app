<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Allowance;
use App\Model\LeageMatches;
use App\Model\MatchesReferees;
use App\Model\Referee;
use App\Model\RefereeRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class MatchRefereeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $matchreferees = MatchesReferees::with('leage_match')->get();
        return view('panel.match_referee.index',compact('matchreferees'));
    }

    public function show($id)
    {
        $matchreferee = MatchesReferees::findOrfail($id);
        return view('panel.match_referee.show',compact('matchreferee'));
    }

    public function edit($id)
    {
        $matchesreferees = MatchesReferees::findOrfail($id);
        $referees = DB::table('referees')->select('*')->whereNotIn('referee_id',function($query) {
           $query->select('referee_id')->from('matches_referees');
        })
        ->leftjoin('cities','cities.city_id','referees.city_id')
        ->get();
        return view('panel.match_referee.edit',compact('matchesreferees','referees'));
    }

    public function update($id)
    {
        $matchreferee = MatchesReferees::findOrfail($id);
        
        $rules = 
        [
            'referee_id' => 'required|integer|exists:referees,referee_id',
        ];

        $names = 
        [
            'referee_id' => 'Referee',
        ];

        $data = $this->validate(request(),$rules,[],$names);
        
        $data['referee_id'] = request('referee_id');
        $data['match_acceptance'] = 'pending';
        $data['match_decline_reason'] = null;
        
        MatchesReferees::where('matches_referee_id',$matchreferee->matches_referee_id)->update($data);

        Allowance::where('referee_id',$matchreferee->referee_id)->update(['referee_id'=>$data['referee_id']]);        
        
        $match = LeageMatches::where('leage_matches_id',$matchreferee->leage_matches_id)
        ->with('league')->with('home')->with('away')->with('hall')
        ->get();


        $match_referee_token = Referee::where('referee_id',request('referee_id'))->get('device_token');
        $responseData = array('success'=>'1', 'data'=>(array)$match, 'message'=>"New Match For You");
        fcm_send($match_referee_token,$responseData['message'],'New Match',$responseData['data']);
        
        return redirect()->route('matchesreferees.index')->with('success','New Referee Updated Successfully!!'); 
    }

    public function verify($id)
    {
        $match_referee = MatchesReferees::findOrFail($id); 
        
        $data['match_verification'] = 1;
        MatchesReferees::where('matches_referee_id',$match_referee->matches_referee_id)->update($data);
        
        $allowance = Allowance::where('leage_matches_id',$match_referee->leage_matches_id)
        ->where('referee_id',$match_referee->matches_referee_id)
        ->first();

        $match_referee_token = Referee::where('referee_id',$match_referee->referee_id)->get('device_token');
        
        $responseData = array('success'=>'1', 'data'=>(array)$allowance, 'message'=>"لقد تم ارسال بدل");
        fcm_send($match_referee_token,$responseData['message'],'بدل جديد',$responseData['data']);

        return back();
    }

    public function getRefereesMatch($id)
    {
        $referees = Referee::where('referee_id','!=',$id)->with('city')->get();
        return response()->json($referees,200);
    }
}
