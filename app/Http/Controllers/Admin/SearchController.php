<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\League;
use Illuminate\Support\Facades\DB;
use App\Model\Referee;
// use Maatwebsite\Excel\Excel;
use App\Model\AssociationReport;
use App\Model\CairoAreaReport;
use App\Model\MiniBasketReport;
use App\Exports\AssociationTableView;
use App\Exports\CairoAreaTableView;
use App\Exports\MiniBasketTableView;
use Maatwebsite\Excel\Facades\Excel;


class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportSearch()
    {
        $referees = Referee::get();

        $data = DB::table('matches_referees')
        ->leftJoin('leage_matches','matches_referees.leage_matches_id','leage_matches.leage_matches_id')
        ->leftJoin('leagues','leagues.league_id','leage_matches.league_id')
        ->leftJoin('referees','referees.referee_id','matches_referees.referee_id')
        ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
        ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
        ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
        // ->leftJoin('allowances','allowances.referee_id','referees.referee_id')
        ->leftJoin('allowances','allowances.leage_matches_id','leage_matches.leage_matches_id')
        ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->where('referees.referee_id',request('referee_id'))
        ->where('league_start_date','like','%'.request('season_start_date').'%')
        ->where('league_end_date','like','%'.request('season_end_date').'%')
        ->selectRaw('referee_fullname,
                     league_name,
                     hometeams.team_name as team_home,
                     awayteams.team_name as team_away,
                     match_date,
                     hall_name,
                     total_amount
                     ')
        ->groupBy('leage_matches.leage_matches_id')
        // ->groupBy('allowances.referee_id')
        // ->groupBy('league_name')
        // league_name,
        //              hometeams.team_name as team_home,
        //              awayteams.team_name as team_away,
        //              match_date,
        //              hall_name,
        //              total_amount
        ->get();
        // ->toSql();
        // ->count();
        // return $data;

        return view('panel.search.search',compact(['referees']));
    }

    public function search()
    {
        if(request()->ajax()) 
        {
            $output = '';
            $total = 0;
            $data = DB::table('matches_referees')
            ->leftJoin('leage_matches','matches_referees.leage_matches_id','leage_matches.leage_matches_id')
            ->leftJoin('leagues','leagues.league_id','leage_matches.league_id')
            ->leftJoin('referees','referees.referee_id','matches_referees.referee_id')
            ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
            ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
            ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
            ->leftJoin('allowances','allowances.leage_matches_id','leage_matches.leage_matches_id')
            ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
            ->where('referees.referee_id',request('referee_id'))
            ->where('league_start_date','like','%'.request('season_start_date').'%')
            ->where('league_end_date','like','%'.request('season_end_date').'%')
            ->selectRaw('referee_fullname,
                        league_name,
                        hometeams.team_name as team_home,
                        awayteams.team_name as team_away,
                        match_date,
                        hall_name,
                        total_amount')
            // ->groupBy('allowances_values.allowances_values_id')
            ->groupBy('leage_matches.leage_matches_id')
            ->get();
            // ->paginate(15);

            $total_row = $data->count();

            if ($total_row > 0) 
            {                  
                    foreach($data as $row)
                    {
                     $output .= '
                     <tr>
                     <td>'.$row->referee_fullname.'</td>
                     <td>'.$row->league_name.'</td>
                     <td>'.$row->team_home.'</td>
                     <td>'.$row->team_away.'</td>
                     <td>'.$row->match_date.'</td>
                     <td>'.$row->hall_name.'</td>
                     <td>'.$row->total_amount.'</td>
                     </tr>
                     ';
                     $total += $row->total_amount;
                    }                    
            }
               
                return response()->json([$output,$total], 200);
            }
    }

    public function declineView()
    {
        $referees = Referee::get();
        $leagues = League::get();

        return view('panel.search.decline',compact(['referees','leagues']));
    }

    public function decline()
    {
        if(request()->ajax()) 
        {
            $output = '';
            $data = DB::table('leage_matches')
            ->leftjoin('teams as hometeams','hometeams.team_id','leage_matches.home_team')
            ->leftjoin('teams as awayteams','awayteams.team_id','leage_matches.away_team')
            ->leftjoin('halls','halls.hall_id','leage_matches.match_hall')
            ->leftJoin('matches_referees','matches_referees.leage_matches_id','leage_matches.leage_matches_id')
            ->leftJoin('leagues','leagues.league_id','leage_matches.league_id')
            ->leftJoin('referees','referees.referee_id','matches_referees.referee_id')
            ->leftJoin('declines','declines.referee_id','referees.referee_id')
            ->where('declines.referee_id',request('referee_id'))
            ->where('league_start_date','LIKE','%'.request('season_start_date')."%")
            ->where('league_end_date','LIKE','%'.request('season_end_date')."%")
            ->selectRaw('referee_fullname,
                         league_name,
                         hometeams.team_name as team_home,
                         awayteams.team_name as team_away,
                         match_date,
                         hall_name')
            ->groupBy('referees.referee_id')
            ->groupBy('league_name')
            ->get();

            $total_row = $data->count();

            if ($total_row > 0) 
            {                  
                    foreach($data as $row)
                    {
                     $output .= '
                     <tr>
                     <td>'.$row->referee_fullname.'</td>
                     <td>'.$row->league_name.'</td>
                     <td>'.$row->team_home.'</td>
                     <td>'.$row->team_away.'</td>
                     <td>'.$row->match_date.'</td>
                     <td>'.$row->hall_name.'</td>
                     </tr>
                     ';
                    }                    
                } 
               
                return response()->json([$output,$total_row], 200);
            }
    }

//   //minibasket//
//   public function miniBasketView()
//   {
//       $leagues = League::where('league_type','mini_basket')->get();
//       return view('panel.search.minibasket.minibasketSearch',compact('leagues'));
//   }

//   public function miniBasketTableAjax()
//   {
//       if(request()->ajax()) 
//       {
//           $output = '';
//           $minibasketreports = 
//           DB::table('allowances')
//           ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
//           ->leftjoin('referees','referees.referee_id','allowances.referee_id')
//           ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
//           ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
//           ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
//           ->where('league_type','mini_basket')
//           ->where('allowances_values.allowance_type','mini_basket')
//           ->where('leage_matches.league_id',request('league_id'))
//           ->selectRaw('referee_fullname_ar,
//                       referee_card_number,
//                       transition_allowance,
//                       nutrition_allowance,
//                       league_name,
//                       match_date,
//                       period_value,
//                       leage_matches.num_of_periods,
//                       total_amount,
//                       ten_percent_taxes,
//                       net_amount
//                       ')
//           ->groupBy('referees.referee_id')
//           ->groupBy('league_name')
//           ->get();
      
//           $arrayMiniObj = [];
//           $total = 0;
//           $total_value_of_the_periods = 0;
//           $total_transition_allowance = 0;
//           $total_feeding_days         = 0;
//           $total_number_of_periods    = 0;
//           $total_feeding_allowance    = 0;
      
//           foreach((array)$minibasketreports as $minibasketreport)
//           {
//               foreach($minibasketreport as $singleMiniReport)
//               {
//                   $miniObj = new MiniBasketReport();
//                   $miniObj->referee_fullname_ar        = implode(' ',(array)$singleMiniReport->referee_fullname_ar);
//                   $miniObj->referee_card_number        = implode(' ',(array)$singleMiniReport->referee_card_number);
//                   $miniObj->league_name                = implode(' ',(array)$singleMiniReport->league_name);
//                   $miniObj->match_date                 = implode(' ',(array)$singleMiniReport->match_date);
//                   $miniObj->period_value               = implode(' ',(array)$singleMiniReport->period_value);
//                   $miniObj->num_of_periods             = implode(' ',(array)$singleMiniReport->num_of_periods);
//                   $miniObj->feeding_allowance          = implode(' ',(array)$singleMiniReport->nutrition_allowance);
//                   $miniObj->transition_allowance       = implode(' ',(array)$singleMiniReport->transition_allowance);
                  
//                   $total_transition_allowance          += $miniObj->transition_allowance; 
//                   $total_number_of_periods             += $miniObj->num_of_periods;
//                   $total_value_of_the_periods           = $total_number_of_periods*$miniObj->period_value;
//                   $total_feeding_allowance             += $miniObj->feeding_allowance;
//                   if ($miniObj->num_of_periods > 2) {
//                       $total_feeding_days++;
//                   }
//                   // $miniObj->total_transition_allowance = implode(' ',(array)$singleMiniReport->total_transition_allowance); 
//                   // $miniObj->total_number_of_periods    = implode(' ',(array)$singleMiniReport->total_number_of_periods);
                  
      
//                   $miniObj->total_amount            = implode(' ',(array)$singleMiniReport->total_amount);
//                   $miniObj->ten_percent_taxes       = implode(' ',(array)$singleMiniReport->ten_percent_taxes);
//                   $miniObj->net_amount              = implode(' ',(array)$singleMiniReport->net_amount);
      
//                   $total                          += $miniObj->net_amount;
//                   array_push($arrayMiniObj,$miniObj);
//               }
//           }
//       }
//               return response()->json([$arrayMiniObj,$total,$total_feeding_allowance,
//               $total_feeding_days,
//               $total_transition_allowance,$total_value_of_the_periods,$total_number_of_periods], 200);
//   }

//   public function miniBasketSearchExportExcel()
//   {
//       $url = explode('=',url()->previous());
//       $id = $url[1];
//       return (new MiniBasketTableView($id))->download('MiniBasketSearch.xlsx');
//   }
//   //minibasket//

//   //cairoArea//
//   public function cairoAreaView()
//   {
//       $leagues = League::where('league_type','cairo_area')->get();
//       return view('panel.search.cairoarea.cairoAreaSearch',compact('leagues'));
//   }

//   public function cairoAreaTableAjax()
//   {
//       if(request()->ajax()) 
//       {
//           $output = '';
//           $cairoareareports = DB::table('allowances')
//           ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
//           ->leftjoin('referees','referees.referee_id','allowances.referee_id')
//           ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
//           ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
//           ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
//           ->where('league_type','cairo_area')
//           ->where('allowances_values.allowance_type','cairo_area')
//           ->where('leage_matches.league_id',request('league_id'))
//           ->selectRaw('referee_fullname_ar,
//                       referee_card_number,
//                       transition_allowance,
//                       arbitration_allowance,
//                       league_name,
//                       match_date,
//                       total_amount,
//                       ten_percent_taxes,
//                       net_amount
//                       ')
//           ->groupBy('referees.referee_id')
//           ->groupBy('league_name')
//           // ->toSql();
//           ->get();
      
//           // return $cairoareareports;
      
//           $arrayCairoObj = [];
//           $total = 0;
//           $total_transition_allowance =0;
//           $total_refereeing_allowance =0;
      
//           foreach((array)$cairoareareports as $cairoareareport)
//           {
//               foreach($cairoareareport as $singleCairoReport)
//               {
//                   $cairoObj = new CairoAreaReport();
//                   $cairoObj->referee_fullname_ar        = implode(' ',(array)$singleCairoReport->referee_fullname_ar);
//                   $cairoObj->referee_card_number        = implode(' ',(array)$singleCairoReport->referee_card_number);
//                   $cairoObj->league_name                = implode(' ',(array)$singleCairoReport->league_name);
//                   $cairoObj->match_date                 = implode(' ',(array)$singleCairoReport->match_date);
//                   $cairoObj->refereeing_allowance       = implode(' ',(array)$singleCairoReport->arbitration_allowance);
//                   $cairoObj->transition_allowance       = implode(' ',(array)$singleCairoReport->transition_allowance);
      
//                   $total_transition_allowance += $cairoObj->transition_allowance; 
//                   $total_refereeing_allowance += $cairoObj->refereeing_allowance;
      
//                   // $cairoObj->total_transition_allowance = implode(' ',(array)$singleCairoReport->total_transition_allowance); 
//                   // $cairoObj->total_refereeing_allowance = implode(' ',(array)$singleCairoReport->total_arbitration_allowance);
      
//                   $cairoObj->total_amount            = implode(' ',(array)$singleCairoReport->total_amount);
//                   $cairoObj->ten_percent_taxes       = implode(' ',(array)$singleCairoReport->ten_percent_taxes);
//                   $cairoObj->net_amount              = implode(' ',(array)$singleCairoReport->net_amount);
//                   $total                            += $cairoObj->net_amount;
//                   array_push($arrayCairoObj,$cairoObj);
                  
//               }
          
//           }
//       }
//       return response()->json([$arrayCairoObj,$total,$total_transition_allowance,$total_refereeing_allowance], 200);
//   }

//   public function cairoAreaSearchExportExcel()
//   {
//         $url = explode('=',url()->previous());
//         $id = $url[1];
//       return Excel::download(new CairoAreaTableView($id), 'CairoAreaSearch.xlsx');
//   }
//   //cairoArea//

//   //association//
//   public function associationView()
//   {
//       $leagues = League::where('league_type','association')->get();
//       return view('panel.search.association.associationSearch',compact('leagues'));
//   }

//   public function associationTableAjax()
//   {
//       if(request()->ajax()) 
//       {
//           $output = '';
//           $associationreports = DB::table('allowances')
//           ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
//           ->leftjoin('referees','referees.referee_id','allowances.referee_id')
//           ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
//           ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
//           ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
//           ->where('league_type','association')
//           ->where('allowances_values.allowance_type','association')
//           ->where('leage_matches.league_id',request('league_id'))
//           ->selectRaw('referee_fullname_ar,
//                       referee_card_number,
//                       match_date,
//                       league_name,
//                       transition_allowance,
//                       arbitration_allowance,
//                       subsistance_allowance,
//                       tournament_allowance,
//                       total_amount,
//                       ten_percent_taxes,
//                       net_amount
//           ')
//           ->groupBy('referees.referee_id')
//           ->groupBy('league_name')
//           ->get();

//           $arrayAssociationObj = [];
//           $total = 0;
//           $total_transition_allowance =0;
//           $total_refereeing_allowance =0;
//           $total_tournament_allowance =0;
//           $total_subsistance_allowance=0;

//           foreach((array)$associationreports as $associationreport)
//           {
//               foreach($associationreport as $singleAssociationReport)
//               {

//                   $associationObj = new AssociationReport();

//                   $associationObj->referee_fullname_ar        = implode(' ',(array)$singleAssociationReport->referee_fullname_ar);
//                   $associationObj->referee_card_number        = implode(' ',(array)$singleAssociationReport->referee_card_number);
//                   $associationObj->league_name                = implode(' ',(array)$singleAssociationReport->league_name);
//                   $associationObj->match_date                 = implode(' ',(array)$singleAssociationReport->match_date);
                  
//                   $associationObj->transition_allowance       = implode(' ',(array)$singleAssociationReport->transition_allowance);
//                   $associationObj->refereeing_allowance       = implode(' ',(array)$singleAssociationReport->arbitration_allowance);
//                   $associationObj->tournament_allowance       = implode(' ',(array)$singleAssociationReport->tournament_allowance);
//                   $associationObj->subsistance_allowance      = implode(' ',(array)$singleAssociationReport->subsistance_allowance);
                  
//                   $total_transition_allowance  += $associationObj->transition_allowance; 
//                   $total_refereeing_allowance  += $associationObj->refereeing_allowance;
//                   $total_subsistance_allowance += $associationObj->subsistance_allowance;
//                   $total_tournament_allowance  += $associationObj->tournament_allowance;

//                   $associationObj->total_amount            = implode(' ',(array)$singleAssociationReport->total_amount);
//                   $associationObj->ten_percent_taxes       = implode(' ',(array)$singleAssociationReport->ten_percent_taxes);
//                   $associationObj->net_amount              = implode(' ',(array)$singleAssociationReport->net_amount);
                  
//                   $total                                  += $associationObj->net_amount;
//                   array_push($arrayAssociationObj,$associationObj);
//               }
//           }
//       }
//       return response()->json([$arrayAssociationObj,
//       $total,
//       $total_transition_allowance,
//       $total_refereeing_allowance,
//       $total_tournament_allowance,
//       $total_subsistance_allowance
//       ], 200);
//   }

//   public function associationSearchExportExcel()
//   {
//       $url = explode('=',url()->previous());
//       $id = $url[1];
//       return Excel::download(new AssociationTableView($id), 'AssociationSearch.xlsx');
//   }
  //association//


}
