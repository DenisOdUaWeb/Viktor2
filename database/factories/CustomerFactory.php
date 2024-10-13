<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "company_id" => \App\Models\Company::factory()->create(), //return id, but why, ADN looks like doesnt make any company ???? 
            'name' => fake()->name, // or name() or .... ?
            'email' => fake()->email(),
            'active' => 1,
        ];
    }
}
