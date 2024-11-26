<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => $this->faker->safeColorName, 
            'size' => $this->faker->randomElement([1,2,3,4,5]), 
            'sold_quantity' => $this->faker->numberBetween(0, 500),
            'remain_quantity' => $this->faker->numberBetween(0, 500), 
            'image_path' => $this->faker->randomElement(['sp1.jpg','sp2.jpg','sp3.jpg','sp4.jpg'
        ,'sp5.jpg','sp6.jpg','sp7.jpg','sp8.jpg']), 
        ];
    }
}