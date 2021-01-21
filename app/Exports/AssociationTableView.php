<?php

namespace App\Exports;

use App\Model\AssociationReport;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Events\AfterSheet;


class AssociationTableView extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView,WithEvents,WithCustomValueBinder
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $associationreports = DB::table('allowances')
        ->leftjoin('allowances_values','allowances_values.allowances_values_id','allowances.allowances_values_id')
        ->leftjoin('referees','referees.referee_id','allowances.referee_id')
        ->leftjoin('matches_referees','matches_referees.referee_id','referees.referee_id')
        ->leftjoin('leage_matches','leage_matches.leage_matches_id','matches_referees.leage_matches_id')
        ->leftjoin('leagues','leagues.league_id','leage_matches.league_id')
        ->where('league_type','association')
        ->where('allowances_values.allowance_type','association')
        ->where('leage_matches.league_id',$this->id)
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
        ->groupBy('league_name')
        ->get();

// return $associationreports;

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
    
        return view('panel.search.association.associationTable',compact(
            ['arrayAssociationObj',
            'total',
            'total_transition_allowance',
            'total_refereeing_allowance',
            'total_tournament_allowance',
            'total_subsistance_allowance']));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
}
