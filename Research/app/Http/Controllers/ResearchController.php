<?php

namespace App\Http\Controllers;

use App\Enums\Department;
use App\Models\Research;
use Illuminate\Validation\Rule;

use App\Jobs\CreateFinanceJob;
use App\Jobs\UpdateGovernanceJob;

class ResearchController extends Controller
{
    public function index()
    {
        return Research::all()->toJson();
    }

    public function show(Research $research)
    {
		/*
			Note: Returns a json reponse even if the model does not exist.
			See config file:  research-grant-app\Research\bootstrap\app.php
		*/
     
		return $research; 
	}
	
    public function store(Request $request)
    {
		$request->validate([
			'dept_name' => [Rule::enum(Department::class)],
		]);
		   		   
		$rules=array(
			'researcher_id' => 'required|regex:/^[A-Z]{2}[0-9]{3}$/',
			'research_title' => 'required|max:60|unique:App\Models\Research,research_title',
			'research_description' => 'required|max:200',
			'grant_amount_requested' => 'required|integer|min:1',
		);
		   		   
		$messages=array(
			'researcher_id.required' => 'Please enter the researcher ID.',
			'researcher_id.regex' => 'Please enter the correct researcher ID format (e.g: XZ817).',
			'research_title.required' => 'Please enter the research title.',
			'research_title.max' => 'Your research title should not contain more than 60 characters',
			'research_title.unique' => 'There already exists a research grant application with this title. Please change the title',
			'research_description.required' => 'Please enter the research description.',
			'research_description.max' => 'Your research description should not contain more than 200 characters',
			'grant_amount_requested.required' => 'Please enter the research grant amount requested.',
			'grant_amount_requested.integer' => 'Please enter a positive integer value for the requested research grant amount',
			'grant_amount_requested.min' => 'The requested research grant amount must be one or greater than one',
		);
		
        $validator=Validator::make($request->all(),$rules,$messages);
        
		if($validator->fails())
        {
             return response()->json([
				'errors' => $validator->errors(),
				'status' => Response::HTTP_BAD_REQUEST,
			], Response::HTTP_BAD_REQUEST);;
        }
	
		$research = Research::create([
						'researcher_id' => $request->researcher_id,
						'dept_name' => $request->dept_name,
						'research_title' => $request->research_title,
						'research_description' => $request->research_description,
						'grant_amount_requested' => $request->grant_amount_requested,
		]);
		
		CreateFinanceJob::dispatch($research->toArray());
		
		UpdateGovernanceJob::dispatch($research->toArray()); 
		
        return response()->json($research,201);
    }
}