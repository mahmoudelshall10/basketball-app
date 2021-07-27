<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AssociationReportsExport;
use App\Exports\AssociationReportsExportView;
use App\Exports\CairoAreaReportsExport;
use App\Exports\CairoAreaReportsExportView;
use App\Exports\MiniBasketReportsExportView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Referee;
use App\Exports\ReportsExport;
use App\Model\Allowance;
use App\Model\AllowancesValue;
use App\Model\MiniBasketReport;
use App\Model\CairoAreaReport;
use App\Model\AssociationReport;
use App\Model\Governorate;
use App\Model\League;
use App\Model\MatchesReferees;
use App\Model\Report;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DateTime;
use Illuminate\Support\Arr;
class ReportController extends Controller
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
    return view('panel.report.index');
}



////////////Mini Basket//////////

public function MiniBasketIndex()
{   
    return view('panel.report.minibasket_report.mini_basket_report');
}

public function MiniBasketReport(Request $request)
{
    if(request()->ajax())
    {
        $start_date                    = [];
        $period_value                  = [];
        $nutrition_allowance           = [];
        $arr_num_of_periods            = [];
        $arr_transition_allowance      = [];
        $sum_num_of_periods            = [];
        $sum_of_transition_allowance   = [];
        $total_of_nutrition_days       = [];
        $all_total                     = [];
        $ten_tax                       = [];
        $final_total                   = [];
        $transition_allowance          = [];
        $total_of_period_value         = [];
        $total_of_nutrition_allowances = [];
        $league_start_date = request('league_start_date');
        $league_end_date   = request('league_end_date');

        $referees = Referee::whereIn('referee_type',['Second Division','Third Division','Mini Basket','Commessioner'])->whereHas('gov',function($q){
                $q->where('gov_id',1);
            })->pluck('referee_id')->toArray();

        $referee_fullname_ar = Referee::whereIn('referee_type',['Second Division','Third Division','Mini Basket','Commessioner'])->whereHas('gov',function($q){
                $q->where('gov_id',1);
            })->pluck('referee_fullname_ar')->toArray();

        $referee_card_number = Referee::whereIn('referee_type',['Second Division','Third Division','Mini Basket','Commessioner'])->whereHas('gov',function($q){
                $q->where('gov_id',1);
            })->pluck('referee_card_number')->toArray();

    
        $leagues_id   = League::where('league_type','mini_basket')
        ->where('league_start_date','like','%'. $league_start_date .'%')
        ->where('league_end_date','like','%'. $league_end_date .'%')
        ->pluck('league_id')->toArray();
        
        $leagues_name = League::where('league_type','mini_basket')
        ->where('league_start_date','LIKE','%'.$league_start_date.'%')
        ->where('league_end_date','LIKE','%'.$league_end_date.'%')
        ->pluck('league_name')->toArray();

        $start_dates = League::where('league_type','mini_basket')
        ->where('league_start_date','LIKE','%'.$league_start_date.'%')
        ->where('league_end_date','LIKE','%'.$league_end_date.'%')
        ->pluck('league_start_date')->toArray();

        foreach($start_dates as $start)
        {
            array_push($start_date,DateTime::createFromFormat('d F Y - H:i', $start)->format('d-Y-M'));
        }

        foreach($referees as $referee)
        {
            $period_value[] = DB::table('allowances')
            ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
            ->leftjoin('referees','allowances.referee_id','referees.referee_id')
            ->leftjoin('leagues','allowances.league_id','leagues.league_id')
            ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
            ->where('allowance_type','mini_basket')
            ->where('league_type','mini_basket')
            ->whereIn('allowances.league_id',$leagues_id)
            ->where('allowances.referee_id',$referee)
            ->pluck('period_value')->first();

            $nutrition_allowance[] = DB::table('allowances')
            ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
            ->leftjoin('referees','allowances.referee_id','referees.referee_id')
            ->leftjoin('leagues','allowances.league_id','leagues.league_id')
            ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
            ->where('allowance_type','mini_basket')
            ->where('league_type','mini_basket')
            ->whereIn('allowances.league_id',$leagues_id)
            ->where('allowances.referee_id',$referee)
            ->pluck('nutrition_allowance')->first();


            $sum_num_of_periods[] = DB::table('allowances')
            ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
            ->leftjoin('referees','allowances.referee_id','referees.referee_id')
            ->leftjoin('leagues','allowances.league_id','leagues.league_id')
            ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
            ->where('allowance_type','mini_basket')
            ->where('league_type','mini_basket')
            ->whereIn('allowances.league_id',$leagues_id)
            ->where('allowances.referee_id',$referee)
            ->get('num_of_periods')
            ->sum('num_of_periods');

            $sum_of_transition_allowance[] = DB::table('allowances')
            ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
            ->leftjoin('referees','allowances.referee_id','referees.referee_id')
            ->leftjoin('leagues','allowances.league_id','leagues.league_id')
            ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
            ->where('allowance_type','mini_basket')
            ->where('league_type','mini_basket')
            ->whereIn('allowances.league_id',$leagues_id)
            ->where('allowances.referee_id',$referee)
            ->get('transition_allowance')
            ->sum('transition_allowance');

            $total_of_nutrition_days[] = DB::table('allowances')
            ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
            ->leftjoin('referees','allowances.referee_id','referees.referee_id')
            ->leftjoin('leagues','allowances.league_id','leagues.league_id')
            ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
            ->where('allowance_type','mini_basket')
            ->where('league_type','mini_basket')
            ->whereIn('allowances.league_id',$leagues_id)
            ->where('allowances.referee_id',$referee)
            ->where('num_of_periods','>=','2')
            ->count();
    
        }
        foreach($leagues_id as $league){
            foreach($referees as $referee){    
                $arr_num_of_periods[] = DB::table('allowances')
                ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
                ->leftjoin('referees','allowances.referee_id','referees.referee_id')
                ->leftjoin('leagues','allowances.league_id','leagues.league_id')
                ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
                ->where('allowance_type','mini_basket')
                ->where('league_type','mini_basket')
                ->where('allowances.league_id',$league)
                ->where('allowances.referee_id',$referee)
                ->pluck('num_of_periods')
                ->toArray();
            }
        }

        $arr_transition_allowance[] = DB::table('allowances')
        ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
        ->where('allowance_type','mini_basket')
        ->where('league_type','mini_basket')
        ->whereIn('allowances.league_id',$leagues_id)
        ->whereIn('allowances.referee_id',$referees)
        ->groupBy('allowances.league_id')
        ->groupBy('allowances.referee_id')
        ->pluck('transition_allowance')->toArray();
        $arr = [];
        foreach($arr_num_of_periods as $arr_num_of_period)
        {
            if(count($arr_num_of_period) > 1)
            {
                $arr[] = array_sum($arr_num_of_period);
            }else{
                $arr[] = $arr_num_of_period;
            }
        }
        $num_of_periods                = array_chunk(Arr::flatten($arr),count($referees)); 
        // $num_of_periods                = array_chunk(Arr::flatten($arr_num_of_periods),count($referees));
        $transition_allowance          = array_chunk(Arr::flatten($arr_transition_allowance),count($referees));
        

        $total_of_period_value         = mutlpileEle($sum_num_of_periods,$period_value);
        $total_of_nutrition_allowances = mutlpileEle($nutrition_allowance,$total_of_nutrition_days);

        $all_total                     = array_map(function (...$arrays) {return array_sum($arrays);},$total_of_period_value,$total_of_nutrition_allowances); 
        foreach($all_total as $item)
        {
            $ten_tax[]     = $item * 10/100;
            $final_total[] = $item - ($item * 10/100);   
        }
        return response()->json([$leagues_name,$start_date,$referee_fullname_ar,$referee_card_number,$period_value,$nutrition_allowance,doubleFor($num_of_periods,$transition_allowance),$sum_num_of_periods,$total_of_period_value,$sum_of_transition_allowance,$total_of_nutrition_days,$total_of_nutrition_allowances,$all_total,$ten_tax,$final_total],200);
    }
}


public function miniBasketReportExportPdf()
{
    // Fetch all customers from database

    $minibasketreports = 
    DB::table('allowances')
    ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
    ->leftjoin('referees','referees.referee_id','allowances.referee_id')
    ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
    ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
    ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
    ->where('league_type','mini_basket')
    ->where('allowances_values.allowance_type','mini_basket')
    ->selectRaw('referee_fullname_ar,
                referee_card_number,
                transition_allowance,
                nutrition_allowance,
                league_name,
                match_date,
                period_value,
                leage_matches.num_of_periods,
                total_amount,
                ten_percent_taxes,
                net_amount
                ')
    ->groupBy('referees.referee_id')
    ->groupBy('match_date')
    ->groupBy('league_name')
    ->get();


    $arrayMiniObj = [];
    $total = 0;
    $total_value_of_the_periods = 0;
    $total_transition_allowance = 0;
    $total_feeding_days         = 0;
    $total_number_of_periods    = 0;
    $total_feeding_allowance    = 0;

    foreach((array)$minibasketreports as $minibasketreport)
    {
        foreach($minibasketreport as $singleMiniReport)
        {
            $miniObj = new MiniBasketReport();
            $miniObj->referee_fullname_ar        = implode(' ',(array)$singleMiniReport->referee_fullname_ar);
            $miniObj->referee_card_number        = implode(' ',(array)$singleMiniReport->referee_card_number);
            $miniObj->league_name                = implode(' ',(array)$singleMiniReport->league_name);
            $miniObj->match_date                 = implode(' ',(array)$singleMiniReport->match_date);
            $miniObj->period_value               = implode(' ',(array)$singleMiniReport->period_value);
            $miniObj->num_of_periods             = implode(' ',(array)$singleMiniReport->num_of_periods);
            $miniObj->feeding_allowance          = implode(' ',(array)$singleMiniReport->nutrition_allowance);
            $miniObj->transition_allowance       = implode(' ',(array)$singleMiniReport->transition_allowance);
            
            $total_transition_allowance          += $miniObj->transition_allowance; 
            $total_number_of_periods             += $miniObj->num_of_periods;
            $total_value_of_the_periods           = $total_number_of_periods*$miniObj->period_value;
            $total_feeding_allowance             += $miniObj->feeding_allowance;
            if ($miniObj->num_of_periods > 2) {
                $total_feeding_days++;
            }

            $miniObj->total_amount            = implode(' ',(array)$singleMiniReport->total_amount);
            $miniObj->ten_percent_taxes       = implode(' ',(array)$singleMiniReport->ten_percent_taxes);
            $miniObj->net_amount              = implode(' ',(array)$singleMiniReport->net_amount);

            $total                          += $miniObj->net_amount;
            array_push($arrayMiniObj,$miniObj);
        }
    }


    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('panel.report.minibasket_report.miniBasketTable',compact(['arrayMiniObj',
    'total','total_value_of_the_periods',
    'total_transition_allowance',
    'total_feeding_days','total_number_of_periods','total_feeding_allowance'])

    )->setOption('encoding','UTF-8');
    // Finally, you can download the file using download function
    return $pdf->download('MiniBasketReports.pdf');
}


public function MiniBasketReportExportExcel()
{
    return Excel::download(new MiniBasketReportsExportView(), 'MiniBasketReports.xlsx');
}

////////////Mini Basket//////////

////////////Cairo Area//////////
public function cairoAreaIndex()
{
    $leagues = League::where('league_type','cairo_area')->get();
   
    return view('panel.report.cairoarea_report.cairo_area_report',compact('leagues'));
}

public function CairoAreaReport(Request $request)
{
    if(request()->ajax())
    {
        $referee_type = [];
        
        $referee_fullname_ar = Referee::where('referee_type','!=','Mini Basket')
        ->whereHas('gov',function($q){
            $q->where('gov_id',1);
        })->pluck('referee_fullname_ar')->toArray();

        $referee_card_number = Referee::where('referee_type','!=','Mini Basket')
        ->whereHas('gov',function($q){
            $q->where('gov_id',1);
        })->pluck('referee_card_number')->toArray();
    
        $type = Referee::where('referee_type','!=','Mini Basket')
        ->whereHas('gov',function($q){
            $q->where('gov_id',1);
        })->pluck('referee_type')->toArray();
    
        foreach($type as $singleType)
        {
            if($singleType == 'First Division')
            {
                $referee_type[] = 'درجة اولي';
            }else if($singleType == 'Second Division'){
                $referee_type[] = 'درجة ثانية';
    
            }else if($singleType == 'Third Division'){
                $referee_type[] = 'درجة ثالثة';
    
            }else if($singleType == 'International'){
                $referee_type[] = 'دولي';
            }else if($singleType == 'Mini Basket'){
                $referee_type[] = 'ميني باسكت';
            }else if($singleType == 'Commessioner'){
                $referee_type[] = 'مراقب';
            }
        }

        $referees = Referee::where('referee_type','!=','Mini Basket')
        ->whereHas('gov',function($q){
            $q->where('gov_id',1);
        })->pluck('referee_id')->toArray();

        $playground = [];
        $table = [];
        $trans_count_a = [];
        $trans_a = [];
        $trans_count_b = [];
        $trans_b = [];
        $referee_playground = [];
        $referee_table = [];
        $area_a = [];
        $area_b = [];
        $league = request('league_id');
    
        foreach($referees as $referee){
            

        $playground[] = MatchesReferees::where('referee_id',$referee)
            ->whereHas('referee_role.referee_place',function($q){
                $q->where('referee_position','playground');
            })->whereHas('leage_match.league',function($q) use ($league){
                $q->where('league_id',$league)->where('league_type','cairo_area');
            })->count();

        $table[] = MatchesReferees::where('referee_id',$referee)
            ->whereHas('referee_role.referee_place',function($q){
                $q->where('referee_position','table');
            })->whereHas('leage_match.league',function($q) use ($league){
                $q->where('league_id',$league)->where('league_type','cairo_area');
            })->count();

        $referee_playground[] = DB::table('allowances')
        ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place') //
        ->where('referee_position','playground')
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->where('allowances.referee_id',$referee)
        ->sum('arbitration_allowance');

        $referee_table[] =  DB::table('allowances')
        ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
        ->where('referee_position','table')
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->where('allowances.referee_id',$referee)
        ->sum('arbitration_allowance');

        $ref_total[]  = DB::table('allowances')
        ->leftjoin('allowances_values','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->leftjoin('referee_places','referee_places.referee_place_id','allowances_values.referee_place')
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->where('allowances.referee_id',$referee)
        ->sum('arbitration_allowance');

        ///a         
        $trans_a[] = DB::table('allowances_values')
        ->leftjoin('allowances','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->whereIn('city_to',[251,252,253])
        ->where('allowances.referee_id',$referee)
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->sum('transition_allowance');

        $trans_count_a[] = DB::table('allowances_values')
        ->leftjoin('allowances','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->whereIn('city_to',[251,252,253])
        ->where('allowances.referee_id',$referee)
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->count('transition_allowance');

        ///a
        ///b
        $trans_b[] = DB::table('allowances_values')
        ->leftjoin('allowances','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->whereIn('city_to',[254,255,256])
        ->where('allowances.referee_id',$referee)
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->sum('transition_allowance');
        
        $trans_count_b[] = DB::table('allowances_values')
        ->leftjoin('allowances','allowances.allowances_values_id','allowances_values.allowances_values_id')
        ->leftjoin('referees','allowances.referee_id','referees.referee_id')
        ->leftjoin('leagues','allowances.league_id','leagues.league_id')
        ->whereIn('city_to',[254,255,256])
        ->where('allowances.referee_id',$referee)
        ->where('allowance_type','cairo_area')
        ->where('league_type','cairo_area')
        ->where('allowances.league_id',$league)
        ->count('transition_allowance');
        
        ///b   

        }
        
        $final_total     = [];
        $ten_tax         = [];
        $area_a          = mutlpileEle((array)$trans_a,(array)$trans_count_a);
        $area_b          = mutlpileEle((array)$trans_b,(array)$trans_count_b);
        // $ref_playground  = mutlpileEle((array)$playground,(array)$referee_playground);
        // $ref_table       = mutlpileEle((array)$table,(array)$referee_table);
        // $ref_total       = array_map(function (...$arrays) {return array_sum($arrays);},(array)$ref_playground,(array)$ref_table);
       
        $area_total      = array_map(function (...$arrays) {return array_sum($arrays);},(array)$area_a,(array)$area_b);
        $all_total       = array_map(function (...$arrays) {return array_sum($arrays);},$ref_total ,(array)$area_total);
        
        foreach($all_total as $item)
        {
            $ten_tax[]     = $item * 10/100;
            $final_total[] = $item - ($item * 10/100);   
        }
    }   
        return response()->json([$referee_fullname_ar,$referee_card_number,$referee_type,$playground,$table,$referee_playground,$referee_table,$ref_total,$trans_count_a,$trans_a,$trans_count_b,$trans_b,$all_total,$ten_tax,$final_total],200);
}

public function cairoAreaReportExportPdf()
{
    $cairoareareports = DB::table('allowances')
    ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
    ->leftjoin('referees','referees.referee_id','allowances.referee_id')
    ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
    ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
    ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
    ->where('league_type','cairo_area')
    ->where('allowances_values.allowance_type','cairo_area')
    ->selectRaw('referee_fullname_ar,
                referee_card_number,
                transition_allowance,
                arbitration_allowance,
                league_name,
                match_date,
                total_amount,
                ten_percent_taxes,
                net_amount
                ')
    ->groupBy('referees.referee_id')
    ->groupBy('match_date')
    ->groupBy('league_name')
    // ->toSql();
    ->get();

    // return $cairoareareports;

    $arrayCairoObj = [];
    $total = 0;
    $total_transition_allowance = 0; 
    $total_refereeing_allowance = 0;

    foreach((array)$cairoareareports as $cairoareareport)
    {
        foreach($cairoareareport as $singleCairoReport)
        {
            $cairoObj = new CairoAreaReport();
            $cairoObj->referee_fullname_ar        = implode(' ',(array)$singleCairoReport->referee_fullname_ar);
            $cairoObj->referee_card_number        = implode(' ',(array)$singleCairoReport->referee_card_number);
            $cairoObj->league_name                = implode(' ',(array)$singleCairoReport->league_name);
            $cairoObj->match_date                 = implode(' ',(array)$singleCairoReport->match_date);
            $cairoObj->refereeing_allowance       = implode(' ',(array)$singleCairoReport->arbitration_allowance);
            $cairoObj->transition_allowance       = implode(' ',(array)$singleCairoReport->transition_allowance);
            $total_transition_allowance          += $cairoObj->transition_allowance; 
            $total_refereeing_allowance          += $cairoObj->refereeing_allowance;

            // $cairoObj->total_transition_allowance = implode(' ',(array)$singleCairoReport->total_transition_allowance); 
            // $cairoObj->total_refereeing_allowance = implode(' ',(array)$singleCairoReport->total_arbitration_allowance);

            $cairoObj->total_amount            = implode(' ',(array)$singleCairoReport->total_amount);
            $cairoObj->ten_percent_taxes       = implode(' ',(array)$singleCairoReport->ten_percent_taxes);
            $cairoObj->net_amount              = implode(' ',(array)$singleCairoReport->net_amount);
            $total                            += $cairoObj->net_amount;
            array_push($arrayCairoObj,$cairoObj);
        }
    }

    // return $arrayCairoObj;
    
    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('panel.report.cairoarea_report.cairoAreaTable',
    compact(['arrayCairoObj','total','total_transition_allowance','total_refereeing_allowance']))
    ->setOption('encoding','UTF-8');
    // Finally, you can download the file using download function
    return $pdf->download('CairoAreaReports.pdf');
}

public function cairoAreaReportExportExcel()
{
    return Excel::download(new CairoAreaReportsExportView(), 'CairoAreaReport.xlsx');
}

////////////Cairo Area//////////


///////////////Associations///////////////

public function AssociationReport()
{   
    $referees = Referee::select('referee_id','referee_fullname_ar','referee_type')->get();
    $league = 4;
    $governorate = [];
    $playground = [];
    $table = [];
    $trans_playground = [];
    $trans_table = [];
    $total_amount =[];
    $total =[];

        foreach($referees as $referee){

        $playground[] =  MatchesReferees::where('referee_id',$referee)
        ->whereHas('referee_role.referee_place',function($q){
            $q->where('referee_position','playground');
        })->whereHas('leage_match.league',function($q) use ($league){
            $q->where('league_id',$league)->where('league_type','association');
            
        })->count();
 

        $table[] = MatchesReferees::where('referee_id',$referee->referee_id)
        ->whereHas('referee_role.referee_place',function($q){
            $q->where('referee_position','table');
        })->whereHas('leage_match.league',function($q) use ($league){
            $q->where('league_id',$league)->where('league_type','association');
        })->count();

        $governorate[] = Governorate::whereHas('referees',function($q) use ($referee){
            $q->where('referee_id',$referee->referee_id);
        })
        ->orderBy('gov_id')
        ->pluck('governorate_name');

        // $trans_playground[]   =  
        // $trans_table[]      =  
        
        }
    // }
    ///
    foreach($governorate as $governate)
    {
       foreach($governate as $gover)
       {
           $gov[] = $gover;
       } 
    }
    ///
    
    return $trans_playground;
    // return $table;
    return view('panel.report.association_report.association_report',compact(['playground','table','referees','gov']));


    $associationreports = DB::table('allowances')
    ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
    ->leftjoin('referees','referees.referee_id','allowances.referee_id')
    ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
    ->leftjoin('cities','cities.city_id','referees.city_id')
    ->leftjoin('governorates','governorates.gov_id','cities.gov_id')
    ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
    ->leftjoin('referee_roles','matches_referees.referee_role_id','referee_roles.referee_role_id')
    ->leftjoin('referee_places','referee_roles.referee_place_id','referee_places.referee_place_id')
    ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
    ->where('league_type','association')
    ->where('allowances_values.allowance_type','association')
    ->selectRaw("referee_fullname_ar,
                referee_card_number,
                governorate_name,
                match_date,
                league_name,
                transition_allowance,
                arbitration_allowance,
                subsistance_allowance,
                tournament_allowance,
                referees.referee_id as RRefID,
                allowances.referee_id as ARefID,
                total_amount,
                ten_percent_taxes,
                net_amount,
                referees.referee_type,
                role_ar,
                referee_position
    ")
    ->where('referees.referee_id',1)
    ->groupBy('governorate_name')
    ->groupBy('match_date')
    ->groupBy('referees.referee_id')
    // ->groupBy('league_name')
    // ->get();
    ->count();
    return $associationreports;
    
    $arrayAssociationObj = [];
    $total = 0;
    $total_transition_allowance =0;
    $total_refereeing_allowance =0;
    $total_tournament_allowance =0;
    $total_subsistance_allowance=0;

    foreach((array)$associationreports as $associationreport)
    {
        foreach($associationreport as $singleAssociationReport)
        {

            $associationObj = new AssociationReport();

            $associationObj->referee_fullname_ar        = implode(' ',(array)$singleAssociationReport->referee_fullname_ar);
            $associationObj->referee_card_number        = implode(' ',(array)$singleAssociationReport->referee_card_number);
            $associationObj->league_name                = implode(' ',(array)$singleAssociationReport->league_name);
            $associationObj->match_date                 = implode(' ',(array)$singleAssociationReport->match_date);
            
            $associationObj->transition_allowance       = implode(' ',(array)$singleAssociationReport->transition_allowance);
            $associationObj->refereeing_allowance       = implode(' ',(array)$singleAssociationReport->arbitration_allowance);
            $associationObj->tournament_allowance       = implode(' ',(array)$singleAssociationReport->tournament_allowance);
            $associationObj->subsistance_allowance      = implode(' ',(array)$singleAssociationReport->subsistance_allowance);
            
            $total_transition_allowance  += $associationObj->transition_allowance; 
            $total_refereeing_allowance  += $associationObj->refereeing_allowance;
            $total_subsistance_allowance += $associationObj->subsistance_allowance;
            $total_tournament_allowance  += $associationObj->tournament_allowance;

            // $associationObj->total_transition_allowance = implode(' ',(array)$singleAssociationReport->total_transition_allowance); 
            
            // $associationObj->total_refereeing_allowance = implode(' ',(array)$singleAssociationReport->total_arbitration_allowance);
            
            // $associationObj->total_tournament_allowance = implode(' ',(array)$singleAssociationReport->total_tournament_allowance);
            
            // $associationObj->total_subsistance_allowance = implode(' ',(array)$singleAssociationReport->total_subsistance_allowance);

            $associationObj->total_amount            = implode(' ',(array)$singleAssociationReport->total_amount);
            $associationObj->ten_percent_taxes       = implode(' ',(array)$singleAssociationReport->ten_percent_taxes);
            $associationObj->net_amount              = implode(' ',(array)$singleAssociationReport->net_amount);
            
            $total                                  += $associationObj->net_amount;
            array_push($arrayAssociationObj,$associationObj);
        }
    }

    return view('panel.report.association_report.association_report',compact(['arrayAssociationObj','total',
    'total_transition_allowance','total_refereeing_allowance','total_tournament_allowance','total_subsistance_allowance']));
}

public function associationReportExportPdf()
{
    $associationreports = DB::table('allowances')
    ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
    ->leftjoin('referees','referees.referee_id','allowances.referee_id')
    ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
    ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
    ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
    ->where('league_type','association')
    ->where('allowances_values.allowance_type','association')
    ->selectRaw('referee_fullname_ar,
                referee_card_number,
                match_date,
                league_name,
                transition_allowance,
                arbitration_allowance,
                subsistance_allowance,
                tournament_allowance,
                total_amount,
                ten_percent_taxes,
                net_amount
                ')
    ->groupBy('referees.referee_id')
    ->groupBy('match_date')
    ->groupBy('league_name')
    ->get();
    $arrayAssociationObj = [];
    $total = 0;
    $total_transition_allowance =0;
    $total_refereeing_allowance =0;
    $total_tournament_allowance =0;
    $total_subsistance_allowance=0;
    
    foreach((array)$associationreports as $associationreport)
    {
        foreach($associationreport as $singleAssociationReport)
        {

            $associationObj = new AssociationReport();

            $associationObj->referee_fullname_ar        = implode(' ',(array)$singleAssociationReport->referee_fullname_ar);
            $associationObj->referee_card_number        = implode(' ',(array)$singleAssociationReport->referee_card_number);
            $associationObj->league_name                = implode(' ',(array)$singleAssociationReport->league_name);
            $associationObj->match_date                 = implode(' ',(array)$singleAssociationReport->match_date);
            
            $associationObj->transition_allowance       = implode(' ',(array)$singleAssociationReport->transition_allowance);
            $associationObj->refereeing_allowance       = implode(' ',(array)$singleAssociationReport->arbitration_allowance);
            $associationObj->tournament_allowance       = implode(' ',(array)$singleAssociationReport->tournament_allowance);
            $associationObj->subsistance_allowance       = implode(' ',(array)$singleAssociationReport->subsistance_allowance);
            
            $total_transition_allowance  += $associationObj->transition_allowance; 
            $total_refereeing_allowance  += $associationObj->refereeing_allowance;
            $total_subsistance_allowance += $associationObj->subsistance_allowance;
            $total_tournament_allowance  += $associationObj->tournament_allowance;

            // $associationObj->total_transition_allowance += $associationObj->transition_allowance; 
            // $associationObj->total_transition_allowance = implode(' ',(array)$singleAssociationReport->total_transition_allowance); 
            
            // $associationObj->total_refereeing_allowance += $associationObj->refereeing_allowance;
            // $associationObj->total_refereeing_allowance = implode(' ',(array)$singleAssociationReport->total_arbitration_allowance);
            
            // $associationObj->total_tournament_allowance += $associationObj->tournament_allowance;
            // $associationObj->total_tournament_allowance = implode(' ',(array)$singleAssociationReport->total_tournament_allowance);
            
            // $associationObj->total_subsistance_allowance += $associationObj->subsistance_allowance;
            // $associationObj->total_subsistance_allowance = implode(' ',(array)$singleAssociationReport->total_subsistance_allowance);

            $associationObj->total_amount            = implode(' ',(array)$singleAssociationReport->total_amount);
            $associationObj->ten_percent_taxes       = implode(' ',(array)$singleAssociationReport->ten_percent_taxes);
            $associationObj->net_amount              = implode(' ',(array)$singleAssociationReport->net_amount);
            
            $total                                  += $associationObj->net_amount;
            array_push($arrayAssociationObj,$associationObj);
        }
    }
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('panel.report.association_report.associationTable',compact(['arrayAssociationObj','total',
        'total_transition_allowance','total_refereeing_allowance','total_tournament_allowance',
        'total_subsistance_allowance']))->setOption('encoding','UTF-8');
        // Finally, you can download the file using download function
        return $pdf->download('AssociationReports.pdf');
}

public function associationReportExportExcel()
{
    return Excel::download(new AssociationReportsExportView(), 'AssociationReport.xlsx');
}

///////////////Associations///////////////


}


