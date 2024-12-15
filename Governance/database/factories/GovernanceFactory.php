<?php

namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\Department;
 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Governance>
 */
class GovernanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Governance::class;
 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
		
		$initial_budget_value = fake()->numberBetween(1000000,2000000);
		
		return [
            'dept_name' => fake()->unique()->randomElement(Department::cases())->value,
            'dept_initial_budget' => $initial_budget_value,
            'dept_current_budget' => $initial_budget_value,
        ];
    }
}