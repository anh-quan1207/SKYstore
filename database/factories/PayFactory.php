<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pay>
 */
class PayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name, 
            'shipping_customer' => $this->faker->address, 
            'customer_phone' => $this->faker->phoneNumber, 
            'payments' =>$this->faker->randomElement([1,2]),
        ];
    }
}