<?php
 
namespace App\Jobs;

use Illuminate\Bus\Queuable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Bus\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;
 
class UpdateGovernanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queuable, SerializesModels;
	
	private $data;
	
	public function __construct($data)
	{
		$this->data = $data;	
	}	
	/**
    * Execute the job.
	*/
    public function handle()
    {
		$dept_name = $this->data['dept_name'];
		
		$grant_amount_requested = $this->data['grant_amount_requested'];
		
		try {
		
			$current_budget = DB::table('governance')->where('dept_name',$dept_name)->value('dept_current_budget');
		
		} catch (Throwable $e) {

			DB::rollBack();

			return response()->json(['error' => 'There was an error querying the governance table.'],500);
		
		}
		
		if ($current_budget >= $grant_amount_requested)
			$current_budget -= $grant_amount_requested;	
		
		if ($current_budget > 0) {
			$stmt = 'update governance set dept_current_budget = ' . $current_budget . ' where dept_name = ?';
		} else {
			$stmt = 'update governance set dept_current_budget = 0 where dept_name = ?';
		}		
				
		try {			

			$num_rows_updated = DB::update($stmt,[$dept_name]);		
			
		} catch (Throwable $e) {
			
			DB::rollBack();

			return response()->json(['error' => 'There was an error inserting into the governance table.'],500);		
		}			
		
    }
}