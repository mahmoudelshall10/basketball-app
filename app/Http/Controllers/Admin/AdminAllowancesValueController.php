<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AllowancesValue;
use App\Model\City;
use App\Model\LeageMatches;
use App\Model\League;
use App\Model\RefereePlaces;
use Illuminate\Support\Facades\Validator;

class AdminAllowancesValueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $referee_types  = ["International","First Division","Second Division","Third Division","Mini Basket","Commessioner"];
    protected $num_of_periods = [1,1.5,2,2.5,3];
    // 
    public function index()
    {
        return view('panel.allowance_value.index');
    }
    
    public function create()
    {
        $arrCities = City::orderBy('gov_id')->get();
        $leagues = League::get();
        $refereePlaces = RefereePlaces::get();
        return view('panel.allowance_value.create',compact(['arrCities','leagues','refereePlaces']));
    }

    public function store()
    {
        // dd(request('city_from'));
        $rules = [
            'allowance_name'             => 'required|string',
            'allowance_type'             => 'required|in:association,cairo_area,mini_basket', 
            'city_to'                    => 'required|integer|exists:cities,city_id',
            'season_start_date'          => 'required|digits:4|integer|min:2019',
            'referee_place'              => 'required|integer|exists:referee_places,referee_place_id',
            'referee_type'               => 'required|string|in:' . implode(',', $this->referee_types),
            'transition_allowance'       => 'required|integer|min:1',
            'arbitration_allowance'      => 'sometimes|nullable|integer|min:0',
            'subsistance_allowance'      => 'sometimes|nullable|integer|min:0',
            'tournament_allowance'       => 'sometimes|nullable|integer|min:0',
            'nutrition_allowance'        => 'sometimes|nullable|integer|min:0',
            'period_value'               => 'sometimes|nullable|integer',
            'num_of_periods'             => 'sometimes|nullable|in:' . implode(',', $this->num_of_periods),
        ];
        // |max:'.(date('Y')+1),
        
        if (request('allowance_type') == 'mini_basket') {
            $rules['period_value']               = 'required|integer|min:0';
            $rules['nutrition_allowance']        = 'required|integer|min:0';
            $rules['num_of_periods']             = 'required|in:' . implode(',', $this->num_of_periods);
        }
        if (request('allowance_type') == 'association') {
            $rules['city_from']              = 'required|integer|exists:cities,city_id';
            $rules['subsistance_allowance']  = 'required|integer|min:1';
            $rules['tournament_allowance']   = 'required|integer|min:1';
            $rules['arbitration_allowance']  = 'required|integer|min:1';
        }
        
        if (request('allowance_type') == 'cairo_area') {
            $rules['arbitration_allowance'] = 'required|integer|min:1';
        }

        $names = [
            'allowance_name'        => 'Allowance Name',
            'allowance_type'        => 'Allowance Type',
            'city_from'             => 'From City',
            'city_to'               => 'To City',
            'season_start_date'     => 'Season Start Date',
            'referee_place'         => 'Referee Place',
            'referee_type'          => 'Referee Type',
            'subsistance_allowance' => 'Subsistance Allowance',
            'arbitration_allowance' => 'Refereeing Allowance',
            'transition_allowance'  => 'Transition Allowance',
            'tournament_allowance'  => 'Tournament Allowance',
            'nutrition_allowance'   => 'Nutrition Allowance',
            'period_value'          => 'Period Value',
            'num_of_periods'        => 'Number Of Periods'
        ];
        $data = $this->validate(request(),$rules,[],$names);

        $data['season_start_date'] = request('season_start_date');

        $data['season_end_date'] = $data['season_start_date'] + 1;

        $data['num_of_periods'] = request('num_of_periods');

        if (request('allowance_type') == 'mini_basket') {
            $data['city_from']  = 1;
            $data['subsistance_allowance']  = 0;
            $data['tournament_allowance']  = 0;
            $data['arbitration_allowance']  = 0;

            if((double)$data['num_of_periods'] < 2)
            {
                $feeding = 0;
            }else{
                $feeding =  (int)$data['nutrition_allowance'];
            }

            $data['total_amount'] = (int)$data['transition_allowance']  + (int)$feeding + ((double)$data['num_of_periods'] * (int)$data['period_value']);
        }

        if (request('allowance_type') == 'cairo_area') {
            $data['city_from']  = 1;
            $data['subsistance_allowance']  = 0;
            $data['tournament_allowance']  = 0;
            $data['nutrition_allowance']  = 0;
            $data['period_value']  = 0;

            if((int)$data['city_from'] == (int)$data['city_to'])
            {
                $data['transition_allowance']  = 0;
            }

            $data['total_amount'] = $data['transition_allowance'] +  $data['arbitration_allowance'];
        }

        if (request('allowance_type') == 'association') {
            $data['nutrition_allowance']  = 0;
            $data['period_value']  = 0;

            if((int)$data['city_from'] == (int)$data['city_to'])
            {
                $data['transition_allowance']  = 0;
            }

            $data['total_amount'] =  $data['subsistance_allowance'] + $data['tournament_allowance'] 
            + $data['arbitration_allowance']  + $data['transition_allowance'] ;
        }


        $data['ten_percent_taxes'] = $data['total_amount'] * 0.1;

        $data['net_amount']        = $data['total_amount'] - $data['ten_percent_taxes'];

        AllowancesValue::create($data);
        return back()->with('success','Allowance Value Created Successfully');
        // return redirect()->route('allowancesvalues.index')->with('success','Allowance Value Created Successfully');
    }
    
    public function show($id)
    {
        $allowance_value = AllowancesValue::findOrfail($id);
        return view('panel.allowance_value.show',compact('allowance_value'));
    }

    public function edit($id)
    {
        $allowance_value = AllowancesValue::findOrfail($id);
        // return $allowance_value;
        $arrCities = City::orderBy('gov_id')->get();
        $leagues = League::get();
        $refereePlaces = RefereePlaces::get();
        return view('panel.allowance_value.edit',compact(['allowance_value','arrCities','leagues','refereePlaces']));
    }

    public function update($id)
    {
        $allowance_value = AllowancesValue::findOrfail($id);
        $rules = [
            'allowance_name'             => 'required|string',
            'allowance_type'             => 'required|in:association,cairo_area,mini_basket', 
            'city_to'                    => 'required|integer|exists:cities,city_id',
            'season_start_date'          => 'required|digits:4|integer|min:2020',
            'referee_place'              => 'required|integer|exists:referee_places,referee_place_id',
            'referee_type'               => 'required|string|in:' . implode(',', $this->referee_types),
            'transition_allowance'       => 'required|integer|min:1',
            'arbitration_allowance'      => 'sometimes|nullable|integer|min:0',
            'subsistance_allowance'      => 'sometimes|nullable|integer|min:0',
            'tournament_allowance'       => 'sometimes|nullable|integer|min:0',
            'nutrition_allowance'        => 'sometimes|nullable|integer|min:0',
            'period_value'               => 'sometimes|nullable|integer',
            'num_of_periods'             => 'sometimes|nullable|in:' . implode(',', $this->num_of_periods),
        ];
        
        if (request('allowance_type') == 'mini_basket') {
            $rules['period_value']               = 'required|integer|min:0';
            $rules['nutrition_allowance']        = 'required|integer|min:0';
            $rules['num_of_periods']             = 'required|in:' . implode(',', $this->num_of_periods);
        }

        if (request('allowance_type') == 'association') {
            $rules['city_from']              = 'required|integer|exists:cities,city_id';
            $rules['subsistance_allowance']  = 'required|integer|min:1';
            $rules['tournament_allowance']   = 'required|integer|min:1';
            $rules['arbitration_allowance']  = 'required|integer|min:1';
        }
        if (request('allowance_type') == 'cairo_area') {
            $rules['arbitration_allowance'] = 'required|integer|min:1';
        }
        
        $names = [
            'allowance_name'        => 'Allowance Name',
            'allowance_type'        => 'Allowance Type',
            'city_from'             => 'From City',
            'city_to'               => 'To City',
            'season_start_date'     => 'Season Start Date',
            'referee_place'         => 'Referee Place',
            'referee_type'          => 'Referee Type',
            'arbitration_allowance' => 'Refereeing Allowance',
            'subsistance_allowance' => 'Subsistance Allowance',
            'transition_allowance'  => 'Transition Allowance',
            'tournament_allowance'  => 'Tournament Allowance',
            'period_value'          => 'Period Value',
            'nutrition_allowance'   => 'Nutrition Allowance',
            'num_of_periods'        => 'Number Of Periods'
        ];

        $data = $this->validate(request(),$rules,[],$names);
        // $data = Validator::make(request()->all(),$rules,[],$names);

        // if ($data->passes()) {
        //     dd('yes');
        // }else
        // {
        //     dd($data->errors());
        // }
        
        $data['season_start_date'] = request('season_start_date');
        $data['season_end_date']   = $data['season_start_date'] + 1;

        $data['num_of_periods'] = request('num_of_periods');

        if (request('allowance_type') == 'mini_basket') {
            $data['city_from']  = 1;
            $data['subsistance_allowance']  = 0;
            $data['tournament_allowance']  = 0;
            $data['arbitration_allowance']  = 0;
            
            if((double)$data['num_of_periods'] < 2)
            {
                $feeding = 0;
            }else{
                $feeding =  $data['nutrition_allowance'];
            }

            $data['total_amount'] = (int)$data['transition_allowance']  + (int)$feeding + ((double)$data['num_of_periods'] * (int)$data['period_value']);
        }
        if (request('allowance_type') == 'cairo_area') {
            $data['city_from']  = 1;
            $data['subsistance_allowance']  = 0;
            $data['tournament_allowance']  = 0;
            $data['nutrition_allowance']  = 0;
            $data['period_value']  = 0;
            $data['num_of_periods']  = 0;

            if((int)$data['city_from'] == (int)$data['city_to'])
            {
                $data['transition_allowance']  = 0;
            }
            $data['total_amount'] = $data['transition_allowance'] +  $data['arbitration_allowance'];
        }

        if (request('allowance_type') == 'association') {
            $data['nutrition_allowance']  = 0;
            $data['period_value']  = 0;
            $data['num_of_periods']  = 0;

            if((int)$data['city_from'] == (int)$data['city_to'])
            {
                $data['transition_allowance']  = 0;
            }

            $data['total_amount'] =  $data['subsistance_allowance'] + $data['tournament_allowance'] 
            + $data['arbitration_allowance']  + $data['transition_allowance'] ;
        }


        $data['ten_percent_taxes'] = $data['total_amount'] * 0.1;

        $data['net_amount']        =  $data['total_amount'] - $data['ten_percent_taxes'];
        
        $allowance_value->update($data);
        return redirect()->route('allowancesvalues.index')->with('success','Allowance Value Updated Successfully');  
    }

    public function delete($id)
    {
        $allowance_value = AllowancesValue::findOrFail($id);
        $allowance_value->delete();
        return redirect()->route('allowancesvalues.index')->with('success','Allowance Value Deleted Successfully');
    }

    public function associationIndex()
    {
        $associationAllowancesValues = AllowancesValue::where('allowance_type','association')->orderBy('created_at','desc')->get();
        return view('panel.allowance_value.association',compact('associationAllowancesValues'));
    }

    public function cairoAreaIndex()
    {
        $cairoAreaAllowancesValues = AllowancesValue::where('allowance_type','cairo_area')->orderBy('created_at','desc')->get();
        return view('panel.allowance_value.cairo_area',compact('cairoAreaAllowancesValues'));
    }
    
    public function miniBasketIndex()
    {
        $miniBasketAllowancesValues = AllowancesValue::where('allowance_type','mini_basket')->orderBy('created_at','desc')->get();
        return view('panel.allowance_value.mini_basket',compact('miniBasketAllowancesValues'));
    }
    
    public function viewCopy()
    {

        $leagues = League::get();
        return view('panel.allowance_value.copy',compact('leagues'));
    }

    public function storeCopy()
    {
        $rules = 
        [
            'from_season'  => 'required|digits:4|integer|min:2019',
            'to_season'    => 'required|digits:4|integer|min:2020',
        ];

        $names =
        [
            'from_season' => 'From Season',
            'to_season' => 'To Season',
        ];
        
        $data = $this->validate(request(),$rules,[],$names);
        $allowances = AllowancesValue::where('season_start_date',request('from_season'))->get();
        if(count($allowances) != 0){
            $allowanceExists = AllowancesValue::where('season_start_date',request('to_season'))->get();
            if (count($allowanceExists) < count($allowances)) {
                foreach ($allowances as $allowance) {
                    $new_allowances = new AllowancesValue;
                    $new_allowances = $allowance->replicate();
                    $new_allowances->season_start_date = request('to_season');
                    $new_allowances->season_end_date   = $new_allowances->season_start_date + 1;
                    $new_allowances->save();
                }
                return redirect()->route('allowancesvalues.index')->with('success','Allowance Value Copied Successfully');
            } else {
                return back()->with('success','Allowances Exist');
            }
        }else{
            return back()->with('success','There are no allowances available');
        }
    }

    public function leagueId($league_id)
    {
        $league = League::where('league_id','!=',$league_id)->get();
        return  response()->json($league, 200) ;   /// json 
    }

    
}
