<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\League;
use App\Model\LeaguesTeams;
use App\Model\LeageMatches;
use App\Model\MatchesReferees;
use App\Model\Teams;
use App\Model\Halls;
use App\Model\Referee;
use App\Http\Controllers\Controller;
use App\Model\Allowance;
use App\Model\AllowancesValue;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminLeagueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $num_of_periods = [1,1.5,2,2.5,3];
    protected $league_type = ['association','cairo_area','mini_basket'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $leagues = League::orderBy('created_at','desc')->get();

        return view('panel.league.index',['leagues'=>$leagues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.league.create');
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
            'league_name'       =>'required|string',
            'league_type'       =>'required|in:'.implode(',',$this->league_type),
            'league_start_date' =>'required|string',
            'league_end_date'   =>'required|string',
        ];
        $names  = [
            'league_name'       =>'League Name',
            'league_type'       =>'League Type',
            'league_start_date' =>'Start Date',
            'league_end_date'   =>'End Date',
        ];
        $data   = $this->validate($request,$rules,[],$names);

        $data['league_type'] = request('league_type');
        // return $data['league_type'];
        if(request('league_start_date') !== request('league_end_date'))
        {
            $league = League::create($data);

        }else{
            Session::flash('error','This Date Has Been Duplicated');
        }
        return redirect()->route('league.index')->with('success','New League Created Successfully'); 
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
        $league = League::findOrFail($id);
        return view('panel.league.edit',['league'=>$league]);
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
        $league = League::findOrFail($id);
        $rules  = [
            'league_name'       => 'required|string',
            'league_type'       => 'required|in:'.implode(',',$this->league_type),
            'league_start_date' => 'sometimes|nullable|string',
            'league_end_date'   => 'sometimes|nullable|string',
        ];
        $names  = [
            'league_name'       =>'League Name',
            'league_type'       =>'League Type',
            'league_start_date' => 'Start Date',
            'league_end_date'   => 'End Date',
        ];
        $data   = $this->validate($request,$rules,[],$names);
        
        $data['league_name']       = request('league_name');
        $data['league_type']       = request('league_type');

        if(request('league_start_date') == null)
        {
            $data['league_start_date'] = $league['league_start_date'];
        }else{
            $data['league_start_date'] = request('league_start_date');
        }

        if(request('league_end_date') == null)
        {
            $data['league_end_date'] = $league['league_end_date'];
        }else{
            $data['league_end_date'] = request('league_end_date');
        }
        
        $league_start_date = DateTime::createFromFormat('d F Y - H:i', $data['league_start_date']);
        $league_start_date = $league_start_date->format('Y-m-d H:i:s');

        $league_end_date = DateTime::createFromFormat('d F Y - H:i', $data['league_end_date']);
        $league_end_date = $league_end_date->format('Y-m-d H:i:s');
        
        if($league_start_date !== $league_end_date)
        {
            // return 'here';
            League::where('league_id',$id)->update($data);
            // $league->update($data);
        }else{
            // return 'here1';
            Session::flash('error','This Date Has Been Duplicated');
        }

        return redirect()->route('league.index')->with('success','New League Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $league = League::findOrFail($id);
        $league->delete();
         return redirect()->route('league.index')->with('success','League Deleted Successfully');
    }
    public function teamIndex($id)
    {
        $league = League::findOrFail($id);
        $teams = LeaguesTeams::where('league_id',$id)->orderBy('created_at','desc')->get();
        return view('panel.league.team.index',['teams'=>$teams,'league'=>$league]);
    }
    public function teamCreate($id)
    {
        $league = League::findOrFail($id);
        $teams = Teams::all();
        return view('panel.league.team.create',['teams'=>$teams,'league'=>$league]);
    }
    public function teamStore(Request $request,$id)
    {
        $league = League::findOrFail($id);
        $rules  = ['team_id'=> 'required|integer|exists:teams,team_id',];
        $names  = ['team_id'=>'Team'];
        $data   = $this->validate($request,$rules,[],$names);
        $data['league_id'] = $id;
        $team = LeaguesTeams::updateOrCreate($data);
         return redirect()->route('leaguesTeams.index',$id)->with('success','New Team Added To League Successfully'); 
    }
    public function teamDestroy($leage_id,$leagues_teams_id)
    {
        $record = LeaguesTeams::findOrFail($leagues_teams_id);
        $record->delete();
        return redirect()->back()->with('success','Team Delete From League Successfully'); 
    }
    public function matchIndex($id)
    {
        $league = League::findOrFail($id);
        $matches = LeageMatches::with('referee')->where('league_id',$id)->orderBy('created_at','desc')->get();

        return view('panel.league.match.index',['matches'=>$matches,'league'=>$league]);
    }
     public function matchCreate($id)
    {
        $league     = League::findOrFail($id);
        $teams      = LeaguesTeams::where('league_id',$id)->get();
        $halls      =   Halls::all();
        $referee    =   Referee::get();
        return view('panel.league.match.create',['teams'=>$teams,'halls'=>$halls,'referees'=>$referee,'league'=>$league]);
    }
    public function matchStore(Request $request, $id)
    {

         $league     = League::findOrFail($id);
         $rules      = [
        'home_team'                  =>  'required|integer|exists:teams,team_id',
        'away_team'                  =>  'required|integer|exists:teams,team_id',
        'match_hall'                 =>  'required|integer|exists:halls,hall_id',
        'first_referee'              =>  'required|integer|exists:referees,referee_id',
        'second_referee'             =>  'required|integer|exists:referees,referee_id',
        'scorer_referee'             =>  'required|integer|exists:referees,referee_id',
        'time_keeper_referee'        =>  'required|integer|exists:referees,referee_id',
        'third_referee'              =>  'sometimes|nullable|integer|exists:referees,referee_id',
        'assistant_scorer_referee'   =>  'sometimes|nullable|integer|exists:referees,referee_id',
        'shoot_clock_keeper_referee' =>  'sometimes|nullable|integer|exists:referees,referee_id',
        'commessioner_referee'       =>  'sometimes|nullable|integer|exists:referees,referee_id',
        'match_date'                 =>  'required|string'
         ];
         $names      =  [
            'home_team'                   =>  'Home Team',
            'away_team'                   =>  'Away Team',
            'match_hall'                  =>  'Match Hall',
            'referee_id'                  =>  'Referees',
            'match_date'                  =>  'Match Date',
            'first_referee'               =>  'First Referee' ,
            'second_referee'              =>  'Second Referee',
            'third_referee'               =>  'Third Referee',
            'scorer_referee'              =>  'Scorer Referee' ,
            'assistant_scorer_referee'    =>  'Assistant Scorer Referee',
            'time_keeper_referee'         =>  'Time Keeper Referee' ,
            'shoot_clock_keeper_referee'  =>  'Shoot Clock Keeper Referee',
            'commessioner_referee'        =>  'Commessioner Referee',
         ];

         $data      = $this->validate($request,$rules,[],$names);
        
         $data['league_id'] = $id;
         DB::beginTransaction();
         try{

         if($request->home_team === $request->away_team)
         {
            return back()->withErrors(['home_team'=>'Home Team Can\'t Be The Same Away Team','away_team'=>'Away Team Can\'t Be The Same Home Team']);
         }

        $league_start_date = DateTime::createFromFormat('d F Y - H:i', $league['league_start_date']);
        $league_start_date = $league_start_date->format('Y-m-d H:i:s');

        $league_end_date = DateTime::createFromFormat('d F Y - H:i', $league['league_end_date']);
        $league_end_date = $league_end_date->format('Y-m-d H:i:s');

        
        $match_date = DateTime::createFromFormat('d F Y - H:i', request('match_date'));
        $match_date = $match_date->format('Y-m-d H:i:s');


        if($match_date > $league_start_date && $match_date < $league_end_date)
        {
                $match = new LeageMatches();
                $match->leage_matches_id =  $match->getNextId();
                $match->league_id   = $data['league_id'];
                $match->home_team   = $data['home_team'];
                $match->away_team   = $data['away_team'];
                $match->match_date  = $data['match_date'];
                $match->match_hall  = $data['match_hall'];

                    //// playground ////
                if (request('first_referee')) {
                    
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('first_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                        MatchesReferees::create(['referee_id'=>request('first_referee'),'referee_role_id'=>1,'leage_matches_id'=>$match->leage_matches_id]);

                    }else{
                         Session::flash('error','The Date Has Been Duplicated For Crow Chief Referee');
                         return back();
                    }
                } 

                if(request('second_referee')) {
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('second_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                        MatchesReferees::create(['referee_id'=>request('second_referee'),'referee_role_id'=>2,'leage_matches_id'=>$match->leage_matches_id]);
                    }else{
                         Session::flash('error','The Date Has Been Duplicated For Umpire 1 Referee');
                         return back();
                    }

                }
                if(request('third_referee')){
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('third_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                            MatchesReferees::create(['referee_id'=>request('third_referee'),'referee_role_id'=>3,'leage_matches_id'=>$match->leage_matches_id]);
                    }else{
                         Session::flash('error','The Date Has Been Duplicated For Umpire 2 Referee');
                         return back();
                    }
                    
                }
                //// playground /////
                
                //// table /////
                
                if(request('scorer_referee')){
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('scorer_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                            MatchesReferees::create(['referee_id'=>request('scorer_referee'),'referee_role_id'=>4,'leage_matches_id'=>$match->leage_matches_id]);

                    }else{
                        Session::flash('error','The Date Has Been Duplicated For Scorer Referee');
                        return back();
                    }

                }
                
                if(request('assistant_scorer_referee')){
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('assistant_scorer_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                            MatchesReferees::create(['referee_id'=>request('assistant_scorer_referee'),'referee_role_id'=>5,'leage_matches_id'=>$match->leage_matches_id]);
                         
                    }else{
                        Session::flash('error','The Date Has Been Duplicated For Assistant Scorer Referee');
                        return back();
                    }
                }
    
                if(request('time_keeper_referee')){
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('time_keeper_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                            MatchesReferees::create(['referee_id'=>request('time_keeper_referee'),'referee_role_id'=>6,'leage_matches_id'=>$match->leage_matches_id]);
                    }else{
                        Session::flash('error','The Date Has Been Duplicated For Time Keeper Referee');
                        return back();
                    }
                    
                }
    
                if(request('shoot_clock_keeper_referee')){
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('shoot_clock_keeper_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                            MatchesReferees::create(['referee_id'=>request('shoot_clock_keeper_referee'),'referee_role_id'=>7,'leage_matches_id'=>$match->leage_matches_id]);
                    }else{
                        Session::flash('error','The Date Has Been Duplicated For Shoot Clock Keeper Referee');
                        return back();
                    }
                    
                }
    
                if(request('commessioner_referee')){
                    $duplicate = DB::table('matches_referees')
                    ->leftJoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                    ->where('league_id',$data['league_id'])
                    ->where('match_date',request('match_date'))
                    ->where('referee_id',request('commessioner_referee'))
                    ->get();

                    if (count($duplicate) == 0) {
                            MatchesReferees::create(['referee_id'=>request('commessioner_referee'),'referee_role_id'=>8,'leage_matches_id'=>$match->leage_matches_id]);
                    }else{
                        Session::flash('error','The Date Has Been Duplicated For Commessioner Keeper Referee');
                        return back();
                    }
                    
                }

                //// table /////
                
                $match->save();

                DB::commit();
                return back()->with('success','New Match Added To League Successfully');

        }else{
            return back()->with('success','The Date Out Of Range');
        }

        }catch(\Exception $e){
            DB::rollback();
            Session::flash('error','The Referee Has Been Duplicated');
            return back();
        }
        // DB::commit();

        //  return redirect()->route('leaguesMatches.index',$id)->with('success','New Match Added To League Successfully'); 
    }

    public function matchShow($leage_id,$leage_matches_id)
    {
        $league = League::findOrFail($leage_id);
        $leage_match  = LeageMatches::findOrFail($leage_matches_id)
        ->where('league_id',$leage_id)->orderBy('created_at','desc')->first();
        // return $leage_match->referee->referee_fullname;
        // $matches = LeageMatches::with('referee')->where('league_id',$id)->orderBy('created_at','desc')->get();
        $MatchesReferees = MatchesReferees::where('leage_matches_id',$leage_matches_id)->get();
        // return $MatchesReferees;
        return view('panel.league.match.show',compact(['league','leage_match','MatchesReferees']));

    }

    public function matchDestroy($leage_id,$leage_matches_id)
    {
        $record   = LeageMatches::findOrFail($leage_matches_id);
        $referees = MatchesReferees::where('leage_matches_id',$leage_matches_id)->delete();
        $allowance = Allowance::where('leage_matches_id',$leage_matches_id)->delete();
        $record->delete();
        return redirect()->back()->with('success','Match Delete From League Successfully'); 
    }
    
    public function sendNotification($leage_matches_id)
    {
        $leage_match = LeageMatches::find($leage_matches_id);

        if($leage_match->is_sent == 0)
        {
            $allowances = DB::table('matches_referees')
            ->leftjoin('referees','referees.referee_id','matches_referees.referee_id')
            ->leftjoin('referee_roles','referee_roles.referee_role_id','matches_referees.referee_role_id')
            ->leftjoin('referee_places','referee_places.referee_place_id','referee_roles.referee_place_id')
            ->leftjoin('cities','cities.city_id','referees.city_id')
            ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
            ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
            ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
            ->select('matches_referees.referee_id','referee_type',
            'referees.city_id','hall_place','referee_roles.referee_place_id','leagues.league_id','league_type',
            'league_start_date','league_end_date',
            'leage_matches.leage_matches_id','leage_matches.num_of_periods')
            ->where('leage_matches.leage_matches_id',$leage_match->leage_matches_id)
            ->get();


            foreach((array)$allowances as $allowance)
            {
                foreach($allowance as $singleAllowance)
                {
                    $league_start_date = DateTime::createFromFormat('d F Y - H:i', implode(' ',(array)$singleAllowance->league_start_date));
                    $league_start_date = $league_start_date->format('Y');

                    $league_end_date = DateTime::createFromFormat('d F Y - H:i', implode(' ',(array)$singleAllowance->league_end_date));
                    $league_end_date = $league_end_date->format('Y');
                    
                DB::beginTransaction();
                try{
                    $allowancesvalue = AllowancesValue::where('city_from',implode(' ',(array)$singleAllowance->city_id))
                    ->where('city_to',implode(' ',(array)$singleAllowance->hall_place))
                    ->where('season_start_date',$league_start_date)
                    ->where('season_end_date',$league_end_date)
                    ->where('allowance_type',implode(' ',(array)$singleAllowance->league_type))
                    ->where('referee_place',implode(' ',(array)$singleAllowance->referee_place_id))
                    ->where('referee_type',implode(' ',(array)$singleAllowance->referee_type))
                    ->where('num_of_periods',implode(' ',(array)$singleAllowance->num_of_periods))
                    ->first();
                    DB::commit();
                    Allowance::create(
                        [
                        'referee_id'=>implode(' ',(array)$singleAllowance->referee_id),
                        'league_id'=>implode(' ',(array)$singleAllowance->league_id),
                        'leage_matches_id'=>implode(' ',(array)$singleAllowance->leage_matches_id),
                        'allowances_values_id'=> $allowancesvalue->allowances_values_id,
                        ]
                    );

                }catch(\Exception $e){
                    DB::rollback();
                    Session::flash('success','There are no allowances for this league');
                    return back();
                }

            }
            
            $match_referees_token = DB::table('matches_referees')
            ->leftjoin('referees','referees.referee_id','matches_referees.referee_id')
            ->where('leage_matches_id',$leage_match->leage_matches_id)
            ->pluck('device_token')
            ->toArray();

            $match = DB::table('leage_matches')
            ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
            ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
            ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
            ->where('leage_matches_id',$leage_match->leage_matches_id)
            ->selectRaw('hometeams.team_name as team_home,
                         awayteams.team_name as team_away,
                         match_date,
                         hall_name')
            ->get();

            
            foreach($match_referees_token as $match_referee_token)
            {
                $responseData = array('success'=>'1', 'data'=>(array)$match, 'message'=>"New Match For You");
                fcm_send($match_referee_token,$responseData['message'],'New Match',$responseData['data']);
            }
            LeageMatches::where('leage_matches_id',$leage_match->leage_matches_id)->update(['is_sent'=>1]);
        }


    }

        return redirect()->back()->with('success','Send Notification From League Successfully'); 

    }

    public function sendNotificationsForAll()
    {
        $leage_matches = LeageMatches::where('is_sent',0)->get();
        foreach ($leage_matches as $leage_match) {
            if($leage_match->is_sent == 0)
            {
                $allowances = DB::table('matches_referees')
                ->leftjoin('referees','referees.referee_id','matches_referees.referee_id')
                ->leftjoin('referee_roles','referee_roles.referee_role_id','matches_referees.referee_role_id')
                ->leftjoin('referee_places','referee_places.referee_place_id','referee_roles.referee_place_id')
                ->leftjoin('cities','cities.city_id','referees.city_id')
                ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
                ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
                ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
                ->select('matches_referees.referee_id','referee_type',
                'referees.city_id','hall_place','referee_roles.referee_place_id','leagues.league_id','league_type',
                'league_start_date','league_end_date',
                'leage_matches.leage_matches_id','leage_matches.num_of_periods')
                ->where('leage_matches.leage_matches_id',$leage_match->leage_matches_id)
                ->get();
        
        
        
                foreach((array)$allowances as $allowance)
                {
                    foreach($allowance as $singleAllowance)
                    {
                        $league_start_date = DateTime::createFromFormat('d F Y - H:i', implode(' ',(array)$singleAllowance->league_start_date));
                        $league_start_date = $league_start_date->format('Y');
                        
                        $league_end_date = DateTime::createFromFormat('d F Y - H:i', implode(' ',(array)$singleAllowance->league_end_date));
                        $league_end_date = $league_end_date->format('Y');
                        
                        DB::beginTransaction();
                        try{

                        $allowancesvalue = AllowancesValue::where('city_from',implode(' ',(array)$singleAllowance->city_id))
                        ->where('city_to',implode(' ',(array)$singleAllowance->hall_place))
                        ->where('season_start_date',$league_start_date)
                        ->where('season_end_date',$league_end_date)
                        ->where('allowance_type',implode(' ',(array)$singleAllowance->league_type))
                        ->where('referee_place',implode(' ',(array)$singleAllowance->referee_place_id))
                        ->where('referee_type',implode(' ',(array)$singleAllowance->referee_type))
                        ->where('num_of_periods',implode(' ',(array)$singleAllowance->num_of_periods))
                        ->first();

                        Allowance::create(
                            [
                            'referee_id'=>implode(' ',(array)$singleAllowance->referee_id),
                            'league_id'=>implode(' ',(array)$singleAllowance->league_id),
                            'leage_matches_id'=>implode(' ',(array)$singleAllowance->leage_matches_id),
                            'allowances_values_id'=> $allowancesvalue->allowances_values_id,
                            ]
                        );
                        DB::commit();
                        }catch(\Exception $e){
                            DB::rollback();
                            Session::flash('success','There are no allowances for this league');
                            return back();
                        }

                    }
                }
                
                $match_referees_token = DB::table('matches_referees')
                ->leftjoin('referees','referees.referee_id','matches_referees.referee_id')
                ->where('leage_matches_id',$leage_match->leage_matches_id)
                ->pluck('device_token')
                ->toArray();
    
                $match = DB::table('leage_matches')
                ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
                ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
                ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
                ->where('leage_matches_id',$leage_match->leage_matches_id)
                ->selectRaw('hometeams.team_name as team_home,
                             awayteams.team_name as team_away,
                             match_date,
                             hall_name')
                ->get();
    
                
                foreach($match_referees_token as $match_referee_token)
                {
                    $responseData = array('success'=>'1', 'data'=>(array)$match, 'message'=>"New Match For You");
                    fcm_send($match_referee_token,$responseData['message'],'New Match',$responseData['data']);
                }
                LeageMatches::where('leage_matches_id',$leage_match->leage_matches_id)->update(['is_sent'=>1]);
            }
        }

        return redirect()->back()->with('success','Send All Notifications Successfully'); 
    }

    public function storePeriods($leage_matches_id)
    {
        $leage_match = LeageMatches::find($leage_matches_id);
        $rules = 
        [
            'num_of_periods' => 'required|in:'.implode(',',$this->num_of_periods),
        ];
        $names = 
        [
            'num_of_periods'=>'Number Of Periods',
        ];

        $data  = $this->validate(request(),$rules,[],$names);
        LeageMatches::where('leage_matches_id',$leage_match->leage_matches_id)->update($data);
        return redirect()->back()->with('success','Number Of Periods Updated Successfully'); 
    }

    public function associationIndex()
    {
        $association = League::where('league_type','association')->get();
        return view('panel.league.association-Index',compact('association'));
    }

    public function cairoAreaIndex()
    {
        $cairoArea = League::where('league_type','cairo_area')->get();
        return view('panel.league.cairo-area-Index',compact('cairoArea'));
    }

    public function miniBasketIndex()
    {
        $miniBasket = League::where('league_type','mini_basket')->get();
        return view('panel.league.mini-basket-Index',compact('miniBasket'));
    }
}
