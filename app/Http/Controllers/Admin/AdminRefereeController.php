<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Referee;
use JWTAuth;
use File;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Governorate;

class AdminRefereeController extends Controller
{
    protected $referee_types = ["International","First Division","Second Division","Third Division", "Mini Basket","Commessioner"];

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
        $referees = Referee::orderBy('created_at','desc')->get();
        return view('panel.referee.index',['referees'=>$referees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::get();
        $cities = City::get();
        return view('panel.referee.create',compact('governorates','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->referee_type);
       
        $rules = [
            'referee_username'              =>  'required|string|max:50|unique:referees,referee_username',
            'referee_mobile'                =>  'required|numeric|digits:11|unique:referees,referee_mobile',
            'referee_email'                 =>  'required|email|max:50|unique:referees,referee_email',
            'refree_password'               =>  'required|string|min:8|confirmed',
            'referee_fullname'              =>  'required|string|min:8',
            'referee_fullname_ar'           =>  'required|string|min:8',
            'referee_address'               =>  'nullable|string|',
            'gov_id'                        =>  'required|integer|exists:governorates,gov_id',
            'city_id'                       =>  'required|integer|exists:cities,city_id',
            'referee_birthday'              =>  'required|date|before:10 years ago',
            'referee_identity'              =>  'nullable|string',
            'referee_nationl_identity'      =>  'nullable|numeric|min:8',
            'referee_card_number'           =>  'nullable|numeric|min:8',
            'referee_image'                 =>  'nullable|mimes:jpeg,jpg,png,bmp,gif',
            'referee_type'                  =>  'nullable|string|in:' . implode(',', $this->referee_types),
        ];
        $names = [
            'referee_username'              =>  'Username',
            'referee_mobile'                =>  'Mobile',
            'referee_email'                 =>  'Email',
            'refree_password'               =>  'Password',
            'referee_fullname'              =>  'Full Name',
            'referee_address'               =>  'Address',
            'gov_id'                        =>  'Governorate',
            'city_id'                       =>  'City',
            'referee_birthday'              =>  'Birthday',
            'referee_identity'              =>  'ID',
            'referee_nationl_identity'      =>  'National ID',
            'referee_card_number'           =>  'Card Number',
            'referee_image'                 =>  'Image',
            'referee_type'                  =>  'Type',
        ];
        $data = $this->validate($request,$rules,[],$names);
        $data['referee_birthday'] = $newDate = date("Y-m-d", strtotime($data['referee_birthday']));
        $data['refree_password']= bcrypt($data['refree_password']);
        // referee_image
        
        // if (!file_exists('referee_image/')) {
        //         mkdir('referee_image/', 0777, true);
        //     }
            
        if($request->hasFile('referee_image') ){
            $image = $request->referee_image;
            $fileName = time()."-$request->referee_username.".$image->getClientOriginalExtension();
            $image->move('referee_image/', $fileName);
            $uploadImage = 'referee_image/'.$fileName;
            $data['referee_image']  = $uploadImage;
        }
        $refree = Referee::create($data);
        $token  = JWTAuth::fromUser($refree);
        // return $token;
        return redirect()->route('referee.index')->with('success','New Referee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $referee = Referee::findOrFail($id);
        // return $referee->city_id;
        return view('panel.referee.show',compact('referee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $referee = Referee::findOrFail($id);
         $governorates = Governorate::get();
         $cities = City::get();
        return view('panel.referee.edit',compact('referee','governorates','cities'));
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
        $referee = Referee::findOrFail($id);
         $rules = [
            'referee_username'              =>  "required|string|max:50|unique:referees,referee_username,$id,referee_id",
            'referee_mobile'                =>  "required|numeric|digits:11|unique:referees,referee_mobile,$id,referee_id",
            'referee_email'                 =>  "required|email|max:50|unique:referees,referee_email,$id,referee_id",
            'refree_password'               =>  'nullable|string|min:8|confirmed',
            'referee_fullname'              =>  'required|string|min:8',
            'referee_fullname_ar'           =>  'required|string|min:8',
            'referee_address'               =>  'nullable|string|',
            'gov_id'                        =>  "required|integer|exists:governorates,gov_id",
            'city_id'                       =>  "required|integer|exists:cities,city_id",
            'referee_birthday'              =>  'required|date|before:10 years ago',
            'referee_identity'              =>  'nullable|string',
            'referee_nationl_identity'      =>  'nullable|numeric|min:8',
            'referee_card_number'           =>  'nullable|numeric|min:8',
            'referee_image'                 =>  'nullable|mimes:jpeg,jpg,png,bmp,gif',
            'referee_type'                  =>  'nullable|string|in:' . implode(',', $this->referee_types),
        ];
        $names = [
            'referee_username'              =>  'Username',
            'referee_mobile'                =>  'Mobile',
            'referee_email'                 =>  'Email',
            'refree_password'               =>  'Password',
            'referee_fullname'              =>  'Full Name',
            'referee_address'               =>  'Address',
            'gov_id'                        =>  'Governorate',
            'city_id'                       =>  'City',
            'referee_birthday'              =>  'Birthday',
            'referee_identity'              =>  'ID',
            'referee_nationl_identity'      =>  'National ID',
            'referee_card_number'           =>  'Card Number',
            'referee_image'                 =>  'Image',
            'referee_type'                  =>  'Type',
        ];
        $data = $this->validate($request,$rules,[],$names);
        // return $data;
        if($request->hasFile('referee_image') ){
                $image = $request->referee_image;
                $fileName = time()."-$request->referee_username.".$image->getClientOriginalExtension();
                $image->move('referee_image/', $fileName);
                $uploadImage = 'referee_image/'.$fileName;
                $data['referee_image']  = $uploadImage;
                File::delete($referee->referee_image);
            }
            if($request->refree_password === null)
            {
                $data['refree_password'] = $referee->refree_password;
            }else{
                $data['refree_password']= bcrypt($data['refree_password']);
            }
            if($request->referee_birthday !== null)
            {
                $data['referee_birthday'] = $newDate = date("Y-m-d", strtotime($data['referee_birthday']));
            }
            $referee->update($data);
            return redirect()->route('referee.index')->with('success','Referee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $referee = Referee::findOrFail($id);
         File::delete($referee->referee_image);
         $referee->delete();
         return redirect()->route('referee.index')->with('success','Referee Deleted Successfully');
    }


}
