<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageProduct>
 */
class ImageProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_path' => $this->faker->randomElement(['sp1.jpg','sp2.jpg','sp3.jpg','sp4.jpg'
        ,'sp5.jpg','sp6.jpg','sp7.jpg','sp8.jpg']), 
        ];
    }
}