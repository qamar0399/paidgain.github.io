<?php

namespace Database\Factories;

use App\Models\ReferralCommission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => ReferralCommission::factory()->create()->id,
            'name' => $this->faker->title(),
            'price' => $this->faker->randomFloat(2),
            'ad_limit'=> $this->faker->randomNumber(),
            'status' => $this->faker->numberBetween(0,3),
            'days' => $this->faker->randomNumber(),
            'is_trial' => $this->faker->boolean(),
        ];
    }
}
