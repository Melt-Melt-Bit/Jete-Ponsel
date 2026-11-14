<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['sku' => 'SAM-A17-5G', 'brand' => 'Samsung', 'name' => 'Galaxy A17 5G', 'category' => 'phone', 'description' => 'A reliable everyday smartphone with a vivid display and 5G connectivity.', 'price' => 5_299_000, 'stock' => 12, 'badge' => 'Best Seller', 'image_path' => 'resources/images/phones/Galaxy A17 5G.png'],
            ['sku' => 'APL-IP17', 'brand' => 'Apple', 'name' => 'iPhone 17', 'category' => 'phone', 'description' => 'A latest-generation iPhone for everyday work and entertainment.', 'price' => 16_999_000, 'stock' => 8, 'badge' => 'Popular', 'image_path' => 'resources/images/phones/Iphone 17.png'],
            ['sku' => 'TEC-POVA7-5G', 'brand' => 'TECNO', 'name' => 'POVA 7 5G', 'category' => 'phone', 'description' => 'A performance-focused 5G smartphone with a large battery.', 'price' => 3_499_000, 'stock' => 18, 'badge' => 'New', 'image_path' => 'resources/images/phones/Pova 7 5G.png'],
            ['sku' => 'SAM-A07', 'brand' => 'Samsung', 'name' => 'Galaxy A07', 'category' => 'phone', 'description' => 'An accessible smartphone for essential daily tasks.', 'price' => 2_599_000, 'stock' => 20, 'badge' => 'Popular', 'image_path' => 'resources/images/phones/Galaxy A07.png'],
            ['sku' => '7HZ-SALNOTES-ZERO', 'brand' => '7Hz', 'name' => 'Salnotes Zero', 'category' => 'earphone', 'description' => 'Wired in-ear earphones with a balanced sound profile.', 'price' => 390_000, 'stock' => 16, 'badge' => 'New', 'image_path' => 'resources/images/headphones/7Hz - Salnotes Zero.png'],
            ['sku' => 'SAM-BUDS3-PRO', 'brand' => 'Samsung', 'name' => 'Galaxy Buds 3 Pro', 'category' => 'earphone', 'description' => 'Wireless earbuds for calls, music, and everyday listening.', 'price' => 3_499_000, 'stock' => 10, 'badge' => 'Popular', 'image_path' => 'resources/images/headphones/Samsung - Galaxy Buds 3 Pro.png'],
            ['sku' => 'JBL-LIVE-BEAM-3', 'brand' => 'JBL', 'name' => 'Live Beam 3', 'category' => 'earphone', 'description' => 'Wireless earbuds with adaptive noise cancellation.', 'price' => 1_999_000, 'stock' => 9, 'badge' => 'New', 'image_path' => 'resources/images/headphones/JBL - Live Beam 3.png'],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product);
        }
    }
}
