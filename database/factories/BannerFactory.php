<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'activity' => $this->faker->boolean(),
            'active_from' => $this->faker->date(),
            'active_to' => $this->faker->date(),
            'url' => $this->faker->url(),
            'picture' => $this->faker->image()
        ];
    }
}
