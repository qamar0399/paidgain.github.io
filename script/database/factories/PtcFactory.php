<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ptc>
 */
class PtcFactory extends Factory
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
            'ads_type' => $this->faker->randomElement(['link_url', 'banner_image', 'script_code', 'youtube_subscriber', 'facebook_follower', 'twitter_follower', 'instagram_follower']),
            'ads_body' => $this->faker->imageUrl(),
            'title' => $this->faker->domainName(),
            'slug' => $this->faker->slug(),
            'amount' => $this->faker->randomFloat(2),
            'duration' => $this->faker->randomNumber(3),
            'max_limit' => $this->faker->randomNumber(3),
            'status' => $this->faker->boolean()
        ];
    }
}
