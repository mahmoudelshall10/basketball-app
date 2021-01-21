<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GlobalController extends Controller
{
   public function single_type(Request $request)
   {
   		if($request->ajax())
        {
	   		if($request->value == "0")
	   		{
	   			$html = view('panel.includes.single_type');
	   			echo $html;
	   		}elseif($request->value == "1"){
	   			$html = view('panel.includes.multi_type');
				echo $html;

	   		}elseif($request->value == "2"){
	   			$html = view('panel.includes.text_type');
				echo $html;

	   		}elseif($request->value == "3"){
	   			$html = view('panel.includes.video_type');
				echo $html;

	   		}elseif($request->value == "4"){
	   			$html = view('panel.includes.image_type');
				echo $html;

	   		}else{

	   			echo null;
	   		}
	   	}else{
	   		return view('errors.404');
	   	}

   }
}
