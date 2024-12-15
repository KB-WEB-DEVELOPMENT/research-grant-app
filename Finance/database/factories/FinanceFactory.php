<?php

namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\GrantRequestStatus;
 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance>
 */
class FinanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Finance::class;
 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        				
		
        /*
            Note that to generate more appropriate data, FinanceSeeder.php does not actually need to call FinanceFactory.php in this project.
            See FinanceSeeder.php
        */
        return [
            'researcher_grant_id' => fake()->unique()->numberBetween(1,1000),
            'researcher_grant_status' => fake()->randomElement(GrantRequestStatus::cases())->value,
            'staff_comment' => fake()->text(100),
        ];
    }
}
