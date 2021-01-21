<?php

namespace App\Http\Controllers\Admin;

use App\Model\Allowance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AllowancesValue;
use App\Model\LeageMatches;
use App\Model\MatchesReferees;
use App\Model\Referee;

class AdminAllowancesController extends Controller
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
        $allowances = Allowance::orderBy('created_at')->get();
        return view('panel.allowance.index',compact('allowances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allowancesvalues = AllowancesValue::get();
        $matches          = LeageMatches::get();
        return view('panel.allowance.create',compact('allowancesvalues','matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // return request(); 
        $rules = 
        [
            'leage_matches_id' => 'required|integer|exists:leage_matches,leage_matches_id',
            'referee_id' => 'required|integer|exists:referees,referee_id',
            'allowances_values_id' => 'required|integer|exists:allowances_values,allowances_values_id',
        ];
        $names = [
            'leage_matches_id'       => 'League Match',
            'referee_id'            => 'Referee',
            'allowances_values_id'  => 'Allowances Values',
        ];
        $data = $this->validate(request(),$rules,[],$names);
        $allowance = Allowance::create($data);

        $referee = Referee::where('referee_id',request('referee_id'))->get('device_token');
        $responseData = array('success'=>'1', 'data'=>json_decode($allowance,JSON_FORCE_OBJECT), 'message'=>"Your Allowance");
        fcm_send(json_encode($referee),$responseData['message'],'New Allowance',$responseData['data']);
        
        return redirect()->route('allowances.index')->with('success','Allowance Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allowance        = Allowance::findOrfail($id);
        $allowancesvalues = AllowancesValue::get();
        $matches          = LeageMatches::get();
        $role = '';
        foreach ($allowance->leageMatch->referee as $referee)
        {
            if($referee->referee_id == $allowance->referee_id){
                if($referee->referee_role == 'playground_referee'){
                    $role = 'Playground Refereee';
                }

                if ($referee->referee_role == 'table_referee'){
                    $role = 'Table Referee';
                }
                
                if ($referee->referee_role == 'observer_referee'){
                    $role = 'Observer Referee';
                }  
                }
        }
        return view('panel.allowance.edit',compact('allowance','allowancesvalues','role','matches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $allowance = Allowance::findOrfail($id);
        $rules = 
        [
            'allowances_values_id' => 'required|integer|exists:allowances_values,allowances_values_id',
        ];
        $names = [
            'allowances_values_id'  => 'Allowances Values',
        ];
        $data = $this->validate(request(),$rules,[],$names);

        $updatedAllowance = Allowance::where('allowance_id',$id)->update($data);
        $referee = Referee::where('referee_id',$allowance->referee_id)->get('device_token');
        $responseData = array('success'=>'1', 'data'=>json_decode($updatedAllowance,JSON_FORCE_OBJECT), 'message'=>"Your Allowance");
        fcm_send(json_encode($referee),$responseData['message'],'New Allowance',$responseData['data']);
        
        return redirect()->route('allowances.index')->with('success','Allowance Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allowances  $allowances
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allowance = Allowance::findOrfail($id);
        $allowance->delete();
        return redirect()->route('allowances.index')->with('success','Allowance Deleted Successfully');

    }

    public function getLeagueMatches($id)
    {
        $referees = LeageMatches::where('leage_matches_id',$id)
        ->where('match_acceptance','accept')
        ->with('referee')->with('referee.city')->get();
        return response($referees, 200);
    }

    public function getMatchReferees($id)
    {
        $referees = MatchesReferees::where('leage_matches_id',$id)
        ->where('match_acceptance','accept')
        ->with('referee')->with('referee.city')->get();
        return response($referees, 200);
    }

    // public function getAllowanceValueByDegree($degree)
    // {
    //     $degrees = AllowancesValue::where('referee_type',$degree)->get();
    //     return response($degrees, 200);
    // }
}
