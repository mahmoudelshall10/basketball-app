<?php

namespace App\Exports;

use App\Model\CairoAreaReport;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class CairoAreaReportsExportView extends  \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView,WithEvents,WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
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
        $total_transition_allowance =0;
        $total_refereeing_allowance =0;
    
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
    
                $total_transition_allowance += $cairoObj->transition_allowance; 
                $total_refereeing_allowance += $cairoObj->refereeing_allowance;
    
                // $cairoObj->total_transition_allowance = implode(' ',(array)$singleCairoReport->total_transition_allowance); 
                // $cairoObj->total_refereeing_allowance = implode(' ',(array)$singleCairoReport->total_arbitration_allowance);
    
                $cairoObj->total_amount            = implode(' ',(array)$singleCairoReport->total_amount);
                $cairoObj->ten_percent_taxes       = implode(' ',(array)$singleCairoReport->ten_percent_taxes);
                $cairoObj->net_amount              = implode(' ',(array)$singleCairoReport->net_amount);
                $total                            += $cairoObj->net_amount;
                array_push($arrayCairoObj,$cairoObj);
                
            }
    
        }
        return view('panel.report.cairoarea_report.cairoAreaTable',compact(
            ['arrayCairoObj',
            'total',
            'total_transition_allowance',
            'total_refereeing_allowance']));
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
