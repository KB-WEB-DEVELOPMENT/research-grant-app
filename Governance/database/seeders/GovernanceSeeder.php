<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;

class GovernanceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
		// Note: The goal is to create a Governance table row entry for EACH (!) department (see all cases in App\Enums\Department)
		Governance::factory()->count(4)->create();
    }
}
