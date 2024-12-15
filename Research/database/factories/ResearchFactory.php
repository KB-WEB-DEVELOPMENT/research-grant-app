<?php

namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\Department;
 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Research::class;
 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        				
		
        /* 
            Note that to generate more appropriate data, ResearchSeeder.php does not actually need to call ResearchFactory.php in this project.
            See ResearchSeeder.php
        */
        
        return [
            'researcher_id' => fake()->regexify('[A-Z]{2}[0-9]{3}'),
            'dept_name' => fake()->randomElement(Department::cases())->value,
            'research_title' => fake()->words(3,true)->unique(),
			'research_description' => fake()->text(100),
			'grant_amount_requested' => fake()->numberBetween(100000,150000),
        ];
    }
}