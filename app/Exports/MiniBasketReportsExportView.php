<?php

namespace App\Exports;

use App\Model\MiniBasketReport;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class MiniBasketReportsExportView extends  \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView,WithEvents,WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
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
                    net_amount')
        ->groupBy('referees.referee_id')
        ->groupBy('match_date')
        ->groupBy('league_name')
        ->get();
    
        // return $minibasketreports;
        
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
    
                // $miniObj->total_transition_allowance = implode(' ',(array)$singleMiniReport->total_transition_allowance); 
                // $miniObj->total_number_of_periods    = implode(' ',(array)$singleMiniReport->total_number_of_periods);
                
    
                $miniObj->total_amount            = implode(' ',(array)$singleMiniReport->total_amount);
                $miniObj->ten_percent_taxes       = implode(' ',(array)$singleMiniReport->ten_percent_taxes);
                $miniObj->net_amount              = implode(' ',(array)$singleMiniReport->net_amount);
                
                $total                           += $miniObj->net_amount;
                array_push($arrayMiniObj,$miniObj);
            }
        }
    
        return view('panel.report.minibasket_report.miniBasketTable',
        compact(['arrayMiniObj',
        'total','total_value_of_the_periods','total_transition_allowance',
        'total_feeding_days','total_number_of_periods','total_feeding_allowance']));
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
