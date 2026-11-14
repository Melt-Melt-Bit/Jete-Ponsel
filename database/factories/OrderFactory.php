<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => 'JT-'.Str::upper((string) Str::ulid()),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->e164PhoneNumber(),
            'fulfillment_method' => 'pickup',
            'payment_method' => 'pay_at_pickup',
            'payment_status' => 'unpaid',
            'status' => 'pending',
            'subtotal' => 100_000,
            'tax_amount' => 0,
            'total' => 100_000,
            'notes' => null,
        ];
    }
}
