<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'category_id' =>  Category::inRandomOrder()->first()->id, 
            'description' => $this->faker->text,
            'discount' => $this->faker->randomFloat(2, 0, 100), 
            'price' => $this->faker->randomFloat(0, 100000, 1000000), 
            'sold_quantity' => $this->faker->numberBetween(0, 1000), 
            'remain_quantity' => $this->faker->numberBetween(0, 1000), 
            'default_product_variant_id' => $this->faker->numberBetween(1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $productVariant = ProductVariant::factory()->count(4)->create([
                'product_id' => $product->id
            ]);
            
            $imageProduct = ImageProduct::factory(4)->create([
                'product_id' => $product->id
            ]);
        });
    }
}