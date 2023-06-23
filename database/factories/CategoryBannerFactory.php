<?php

namespace Database\Factories;

use App\Models\CategoryBanner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoryBanner>
 */
class CategoryBannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(2, 101),
            'banner_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
