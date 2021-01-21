<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\City;

class AdminCityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCities($city_id)
    {
        if($city_id == 1)
        {
            $gov_id = City::where('city_id',$city_id)->first()->gov_id;
            $arrCities = City::where('gov_id','!=',$gov_id)->get();
        }else{
            $arrCities = City::get();
        } 
        return  response()->json($arrCities, 200) ;   /// json 
         
    }

    public function getCairoAreas()
    {
        $arrCairoAreas = City::whereIn('gov_id',[1,2,12])
        ->get();
        return  response()->json($arrCairoAreas, 200) ;
    }

    // public function getMiniBasketAreas()
    // {
    //     $arrMiniBasketAreas = ['El-Shrouk','Helwan','15th Of May City ' , 'Al-Mukattam' , "El-Da\'ry ","Settlement"];
    //     return  response()->json($arrMiniBasketAreas, 200);
    // }

    public function getCitiesExId($id)
    {
        $getCityId = City::where('city_id',$id)->first()->gov_id;
        $arrCitiesExId = City::where('gov_id','!=',$getCityId)->get();
        return  response()->json($arrCitiesExId, 200);
    }

    public function getCityByGov($gov_id)
    {
        $getCities = City::where('gov_id',$gov_id)->get();
        return response()->json($getCities,200);
    }
}