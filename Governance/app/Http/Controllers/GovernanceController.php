<?php

namespace App\Http\Controllers;

use App\Enums\Department;
use App\Models\Governance;
use Illuminate\Validation\Rule;

class GovernanceController extends Controller
{
    public function index()
    {
        return Governance::all()->toJson();
    }

    public function show(Governance $governance)
    {
		/*
			Note: Returns a json reponse even if the model does not exist.
			See config file:  research-grant-app\Governance\bootstrap\app.php
		*/
     
		return $governance; 
	}
	
    public function store(Request $request)
    {           
		$request->validate([
			'dept_name' => [Rule::enum(Department::class)],
		]);
		   
		/*
			Note:   I am not setting any rules for the 'dept_current_budget' field value because
		            when the Governance staff employee enters a value for the 'dept_initial_budget' field,
					'dept_current_budget' field value is automatically set to that value.
		*/
		   
		$rules = array(
			'dept_name' => 'required|unique:App\Models\Governance,dept_name',
			'dept_initial_budget' => 'required|integer|min:1',
		);
		   		   
		$messages=array(
			'dept_name.required' => 'Please enter the department name.',
			'dept_name.unique' => 'Each department name Biology, Biochemistry, Chemistry and Physics can only appear once in the Governance table',
			'dept_initial_budget.required' => 'Please enter the initial budget',
			'dept_initial_budget.integer' => 'Please enter an integer value for the initial budget',
			'dept_initial_budget.min' => 'Please enter an integer value greater or equal to one for the initial budget',
		);
        $validator=Validator::make($request->all(),$rules,$messages);
        
		if($validator->fails())
        {
             return response()->json([
				'errors' => $validator->errors(),
				'status' => Response::HTTP_BAD_REQUEST,
			], Response::HTTP_BAD_REQUEST);;
        }
    
		$dept_name = $request->dept_name;
		$dept_initial_budget = (int)$request->dept_initial_budget;
		$dept_current_budget = (int)$request->dept_initial_budget;
		
		
		$governance = Governance::create([
						'dept_name' => $dept_name,
						'dept_initial_budget' => $dept_initial_budget,
						'dept_current_budget' => $dept_current_budget
		]);

        return response()->json($governance,201);
    }
}