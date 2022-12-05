<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'trx_id' => $this->faker->text(10),
            'user_id' => User::factory()->create(),
            'charge' => $this->faker->randomFloat(2, 2),
            'amount' => $this->faker->numberBetween(5, 20000),
            'data' => '',
        ];
    }
}
