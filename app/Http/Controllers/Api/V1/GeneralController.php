<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Model\Allowance;
use App\Model\Decline;
use App\Model\LeageMatches;
use App\Model\MatchesReferees;
use App\Model\Notification;
use App\Model\Referee;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function reportPersonal()
    {
        $match = DB::table('leage_matches')
        ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
        ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
        ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
        ->leftJoin('matches_referees','matches_referees.leage_matches_id','leage_matches.leage_matches_id')
        ->leftJoin('referees','referees.referee_id','matches_referees.referee_id')
        ->leftJoin('allowances','allowances.referee_id','referees.referee_id')
        ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
        ->where('leage_matches.leage_matches_id',request('leage_matches_id'))
        ->where('referees.referee_id',request('referee_id'))
        ->selectRaw('hometeams.team_name as team_home,
                     awayteams.team_name as team_away,
                     match_date,
                     hall_name,
                     net_amount')
        ->get();
        $responseData = array('success'=>'1', 'data'=>json_decode($match), 'message'=>"New Match For You");
        return $responseData;
    }

    public function storeAccept()
    {

        MatchesReferees::where('referee_id',request('referee_id'))
        ->where('leage_matches_id',request('leage_matches_id'))
        ->update(array('match_acceptance'=>'accept'));
        Notification::create(['referee_id' => request('referee_id'), 'message'=>' Accepts The Match...Please Don\'t Forget The Allowances']);
        $responseData = array('success'=>'1', 'data'=>json_decode("{}"), 'message'=> 'لقد قبلت المباراة');
        return $responseData;
    }

    public function storeDecline()
    {
        MatchesReferees::where('referee_id',request('referee_id'))
        ->where('leage_matches_id',request('leage_matches_id'))
        ->update(array('match_acceptance'=>'decline','match_decline_reason' => request('match_decline_reason')));

        Decline::create(['referee_id' => request('referee_id'),'league_id' => request('league_id'),'leage_matches_id'=>request('leage_matches_id')]);
        
        Notification::create(['referee_id' => request('referee_id'), 'message'=>' Declines The Match...Please Look At Another Referee']);
        $responseData = array('success'=>'1', 'data'=>json_decode("{}"), 'message'=> 'لقد رفض المباراة');
        return $responseData;
    }
    
    public function storeMatchConfirmation()
    {
        MatchesReferees::where('referee_id',request('referee_id'))
        ->where('leage_matches_id',request('leage_matches_id'))
        ->update(array('match_confirmation'=> 1));
        Notification::create(['referee_id' => request('referee_id'), 'message'=>'The Referee Plays The Match']);
        $responseData = array('success'=>'1', 'data'=>json_decode("{}"), 'message'=> 'لقد تم تأكيد المباراة');
        return $responseData;
    }

    public function showAllMatches()
    {
        $allLeageMatches = LeageMatches::get();
        $responseData = array('success'=>'1', 'data'=>json_decode($allLeageMatches), 'message'=> 'جميع المباريات');
        return $responseData;
    }

    public function report()
    {
        $match = DB::table('leage_matches')
        ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
        ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
        ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
        ->leftJoin('matches_referees','matches_referees.leage_matches_id','leage_matches.leage_matches_id')
        ->leftJoin('referees','referees.referee_id','matches_referees.referee_id')
        ->leftJoin('allowances','allowances.referee_id','referees.referee_id')
        ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
        ->where('referees.referee_id',request('referee_id'))
        ->selectRaw('hometeams.team_name as team_home,
                     awayteams.team_name as team_away,
                     match_date,
                     hall_name,
                     net_amount')
        ->get();

        $responseData = array('success'=>'1', 'data'=>(array)$match, 'message'=> '');
        return $responseData;
    }

    public function scoreSheetImage($id)
    {
        $LeageMatches = LeageMatches::findOrFail($id);

        $match_referee = MatchesReferees::where('leage_matches_id',$LeageMatches->leage_matches_id)
        ->where('referee_id',request('referee_id'))
        ->get();
        
        if(count($match_referee) != 0)
        {
            // return 'here in ';

            $rules = [
                'score_sheet_image'     =>  'required|image|mimes:jpeg,jpg,png,bmp,gif',
            ];
            $names = [
                'score_sheet_image'     =>  'Score Sheet Image',
            ];
            $data = $this->validate(request(),$rules,[],$names);
            
         if (!file_exists('public/score-sheet-image/')) {
             mkdir('public/score-sheet-image/', 0777, true);
            }
            
            if(request()->hasFile('score_sheet_image') ){
                $image = request()->score_sheet_image;
            $fileName = time()."-$LeageMatches->leage_matches_id.".$image->getClientOriginalExtension();
            $image->move('public/score-sheet-image/', $fileName);
            $uploadImage = 'score-sheet-image/'.$fileName;
            $data['score_sheet_image']  = $uploadImage;
            
            LeageMatches::where('leage_matches_id',$LeageMatches->leage_matches_id)->update($data);
            
            Notification::create(['referee_id'=>request('referee_id'),'message'=>'The Score Sheet Has Been Uploaded']);
            $responseData = array('success'=>'1', 'data'=>(array)$data, 'message'=> 'تم تحميل الصورة');
            return $responseData;
        }
        }
        $responseData = array('success'=>'1', 'data'=>json_decode("{}"), 'message'=> 'غير مسموح');
        return $responseData;
    }
}
