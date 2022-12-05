<?php

namespace Database\Factories;

use App\Models\Getway;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deposit>
 */
class DepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create();
        return [
            'user_id' => $user->id,
            'getway_id' => Getway::query()->inRandomOrder()->first()->id,
            'trx' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement([0, 1, 2, 3]),
            'payment_status' => $this->faker->randomElement([0, 1, 2, 3]),
        ];
    }
}
