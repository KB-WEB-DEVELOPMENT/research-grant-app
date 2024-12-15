<?php
 
namespace App\Jobs;

use Illuminate\Bus\Queuable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Bus\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;
 
class CreateFinanceJob implements ShouldQueue
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
		
		DB::beginTransaction();
		
		try {
		
			$current_budget = DB::table('governance')->where('dept_name',$dept_name)->value('dept_current_budget');
		
		} catch (Throwable $e) {

			DB::rollBack();

			return response()->json(['error' => 'There was an error querying the governance table.'],500);		
		}
		
		$researcher_grant_id = $this->data['id'];
		
		$researcher_grant_status = ($current_budget >= $grant_amount_requested) ? 'approved' : 'rejected';
		
		$staff_comment = 'No comment entered yet.';
		
		try {
		
			DB::insert('insert into finance (researcher_grant_id,researcher_grant_status,staff_comment) values (?,?,?)',
					[$researcher_grant_id,$researcher_grant_status,$staff_comment]
				);

		} catch (Throwable $e) {
			
			DB::rollBack();

			return response()->json(['error' => 'There was an error inserting into the finance table.'],500);		
		}			
    }
}