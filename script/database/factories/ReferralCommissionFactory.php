<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Categorymeta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReferralCommission>
 */
class ReferralCommissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => 'ReferralCommission',
            'name' => $this->faker->colorName(),
            'slug' => $this->faker->randomElement(['percentage', 'fixed']),
            'other' => $this->faker->randomFloat()
        ];
    }
}
