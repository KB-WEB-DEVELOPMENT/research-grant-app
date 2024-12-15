<?php
 
namespace Database\Seeders;

use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
		/* 
			Note: I purposely choose not to use database/factories/ResearchFactory in order to save 
			more suitable data in the Research table		
		*/
		
		$data = [];
		$data['researcher_id'] = ['XY908','CZY107','ZR112','FB729'];
		$data['dept_name'] = ['Biology','Biochemistry','Chemistry','Physics'];
		$data['research_title'] = ['Any Biology Research Title',
								    'Any Biochemistry Research Title',
									'Any Chemistry Research Title',
									'Any Physics Research Title'
								];
		$data['research_description'] =['Any Biology Research description',
								    'Any Biochemistry Research description',
									'Any Chemistry Research description',
									'Any Physics Research description'
								];
		$data['grant_amount_requested'] = [10000,20000,30000,4000000];

		foreach ($data as $key => $value) {
			
			DB::table('research')->insert([
				'researcher_id' => $value['researcher_id'][$key],
				'dept_name' => $value['dept_name'][$key],
				'research_title' => $value['research_title'][$key],
				'research_description' => $value['research_description'][$key],
				'grant_amount_requested' => $value['grant_amount_requested'][$key],
			]);
		
		}
    }
}

