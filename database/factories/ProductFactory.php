<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'sku' => fake()->unique()->bothify('SKU-#####'),
            'brand' => fake()->company(),
            'name' => fake()->words(2, true),
            'category' => fake()->randomElement(['phone', 'earphone', 'accessory']),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(100_000, 30_000_000),
            'stock' => fake()->numberBetween(0, 100),
            'badge' => fake()->randomElement(['New', 'Popular', 'Best Seller']),
            'image_path' => 'resources/images/phones/Galaxy A17 5G.png',
            'is_active' => true,
        ];
    }
}
