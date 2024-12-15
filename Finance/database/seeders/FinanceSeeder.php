<?php
 
namespace Database\Seeders;
 
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
		/*
		    Note: I purposely choose not to use database/factories/FinanceFactory in order to save more 
		    suitable data in the Finance table

			Note that the field 'researcher_grant_id' in the Finance table is technically a foreign key with unique value in the Finance table
			and it matches a primary key value in the Research table.
			I am not using Models relationships in this project (because it is not its goal) so this is just a workaround.		   
		*/
		
		$data = [];
		$data['researcher_grant_id'] = [1,2,3,4];
		$data['researcher_grant_status'] = ['approved','approved','approved','rejected'];
		$data['staff_comment'] = [
									'XY in the finance department approves the grant',
									'XY in the finance department approves the grant',
									'XY in the finance department approves the grant',
									'XY in the finance department rejects the grant',
								];
		
		foreach ($data as $key => $value) {
			
			DB::table('finance')->insert([
				'researcher_grant_id' => $value['researcher_grant_id'][$key],
				'researcher_grant_status' => $value['researcher_grant_status'][$key],
				'staff_comment' => $value['staff_comment'][$key],
			]);
		}    
	}
}
