<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WithdrawMethod>
 */
class WithdrawMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName(),
            'image' => $this->faker->name,
            'min_limit' => $this->faker->numberBetween(10, 50),
            'max_limit' => $this->faker->numberBetween(50, 500),
            'delay' => $this->faker->numberBetween(30, 300),
            'fixed_charge' => $this->faker->numberBetween(20,50),
            'rate' => $this->faker->numberBetween(1,80),
            'percent_charge' => $this->faker->numberBetween(1,90),
            'currency' => 'usd',
            'user_data' => '',
            'instruction' => $this->faker->text(),
            'status' => $this->faker->randomElement([0, 1, 2, 3]),
        ];
    }
}
