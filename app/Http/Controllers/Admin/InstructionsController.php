<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Instructions;

class InstructionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $instructions = Instructions::get();
        return view('panel.instructions.index',compact('instructions'));
    }

    public function create()
    {
        return view('panel.instructions.create');
    }

    public function store()
    {
        $rules = 
        [
            'instruction' => 'required'
        ];

        $data = $this->validate(request(), $rules, [], [
            'instruction' => 'Instruction'
        ]);
        $data['instruction_id'] = 1;
        // Instructions::orderBy('instruction_id', 'desc')->updateOrCreate($data);
        Instructions::updateOrCreate(['instruction_id' => $data['instruction_id']],
                        ['instruction' => $data['instruction']]);
        return redirect()->route('instructions.index')->with('success','Instruction Created Successfully');
    }


}
