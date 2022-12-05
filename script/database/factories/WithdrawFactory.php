<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WithdrawMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdraw>
 */
class WithdrawFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'withdraw_method_id' => WithdrawMethod::factory()->create(),
            'user_id' => User::factory()->create()->id,
            'status' => $this->faker->randomElement([0, 1, 2, 3]),
            'currency' => 'usd',
            'rate' => 1,
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'charge' => 2,
        ];
    }
}
