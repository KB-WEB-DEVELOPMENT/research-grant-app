<?php

namespace App\Http\Controllers;

use App\Enums\GrantRequestStatus;
use App\Models\Research;
use App\Models\Governance;
use App\Models\Finance;

class FinanceController extends Controller
{
    public function index()
    {
        return Finance::all()->toJson();
    }

    public function show(Finance $finance)
    {
		/*
			Note: Returns a json reponse even if the model does not exist.
			See config file:  research-grant-app\Finance\bootstrap\app.php
		*/
     
		return $finance; 
	}
	
	/*  Note that only the 'staff_comment' field and no other fields in a Finance table row can be updated by a Finance staff member. 
		No rows in this table can be deleted.
	*/
	public function update(Request $request,Finance $finance)
    {
	   	   
		$rules=array(
			'staff_comment' => 'required|min:1|max:200',
		);
		   		   
		$messages=array(
			'staff_comment.required' => 'A Finance staff member comment is required.',
			'staff_comment.min' => 'The Finance staff member comment must contain at least one character',
			'staff_comment.max' => 'The Finance staff member comment must contain at least no more than 200 characters.',
		);
		
        $validator=Validator::make($request->all(),$rules,$messages);
        
		if($validator->fails())
        {
             return response()->json([
				'errors' => $validator->errors(),
				'status' => Response::HTTP_BAD_REQUEST,
			], Response::HTTP_BAD_REQUEST);;
        }
		
		// (1) $researcher_grant_id is the Research table primary key which is at the same time a unique foreign key in the Finance table 
		// see remark in file research-grant-app\Finance\database\migrations\2024_12_09_214645_create_finance_table.php
		$researcher_grant_id = $finance->researcher_grant_id;
		
		try {
			
			$finance = Finance::findOrFail($researcher_grant_id);
			
		} catch (ModelNotFoundException $modelNotFoundException) {
			 
			 return response()->json(
						['status' => 'failed',
						 'data' => null,
						 'message' => 'Finance Model not found'
						]);
		}
						
		$staff_comment = $request->staff_comment;
		
		Finance::where('researcher_grant_id',$researcher_grant_id)->update(['staff_comment' => $staff_comment]);
		
        return response()->json($finance, 200);
    }

}