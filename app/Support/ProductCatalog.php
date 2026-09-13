<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;

class ProductCatalog
{
    private const SESSION_KEY = 'catalogue.products.v3';

    /**
     * @return array<int, array<string, string|int|bool>>
     */
    public static function all(): array
    {
        return session()->get(self::SESSION_KEY, self::defaults());
    }

    /**
     * @return array<int, array<string, string|int|bool>>
     */
    public static function visible(): array
    {
        return array_values(array_filter(self::all(), fn (array $product): bool => $product['visible']));
    }

    /**
     * @param array<string, string> $attributes
     * @return array<string, string|int|bool>
     */
    public static function create(array $attributes): array
    {
        $product = [
            'id' => (string) Str::uuid(),
            'brand' => $attributes['brand'],
            'name' => $attributes['name'],
            'price' => $attributes['price'],
            'rating' => 'New',
            'reviews' => '0',
            'badge' => $attributes['badge'],
            'image' => $attributes['image'],
            'alt' => $attributes['brand'].' '.$attributes['name'].' smartphone',
            'visible' => true,
        ];

        self::save([...self::all(), $product]);

        return $product;
    }

    /**
     * @param array<string, string> $attributes
     */
    public static function update(string $id, array $attributes): bool
    {
        $updated = false;
        $products = array_map(function (array $product) use ($id, $attributes, &$updated): array {
            if ($product['id'] !== $id) {
                return $product;
            }

            $updated = true;

            return array_merge($product, Arr::only($attributes, ['brand', 'name', 'price', 'badge', 'image']));
        }, self::all());

        self::save($products);

        return $updated;
    }

    public static function delete(string $id): void
    {
        self::save(array_values(array_filter(self::all(), fn (array $product): bool => $product['id'] !== $id)));
    }

    public static function toggleVisibility(string $id): void
    {
        self::save(array_map(function (array $product) use ($id): array {
            if ($product['id'] === $id) {
                $product['visible'] = ! $product['visible'];
            }

            return $product;
        }, self::all()));
    }

    /**
     * @param array<int, array<string, string|int|bool>> $products
     */
    private static function save(array $products): void
    {
        session()->put(self::SESSION_KEY, $products);
    }

    /**
     * @return array<int, array<string, string|int|bool>>
     */
    private static function defaults(): array
    {
        $products = [
            ['brand' => 'A6t', 'name' => 'Pro', 'price' => 'Rp3.199.000', 'rating' => '4.5', 'reviews' => '320', 'badge' => 'New', 'image' => self::image('A6t Pro.png'), 'alt' => 'A6t Pro smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy A07', 'price' => 'Rp2.599.000', 'rating' => '4.6', 'reviews' => '480', 'badge' => 'Popular', 'image' => self::image('Galaxy A07.png'), 'alt' => 'Samsung Galaxy A07 smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy A17 5G', 'price' => 'Rp5.299.000', 'rating' => '4.7', 'reviews' => '1.2k', 'badge' => 'Best Seller', 'image' => self::image('Galaxy A17 5G.png'), 'alt' => 'Samsung Galaxy A17 5G smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy A37 5G', 'price' => 'Rp4.799.000', 'rating' => '4.7', 'reviews' => '740', 'badge' => 'Popular', 'image' => self::image('Galaxy A37 5G.png'), 'alt' => 'Samsung Galaxy A37 5G smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy A56 5G', 'price' => 'Rp6.499.000', 'rating' => '4.8', 'reviews' => '930', 'badge' => 'Popular', 'image' => self::image('Galaxy A56 5G.png'), 'alt' => 'Samsung Galaxy A56 5G smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy A57 5G', 'price' => 'Rp9.999.000', 'rating' => '4.8', 'reviews' => '510', 'badge' => 'New', 'image' => self::image('Galaxy A57 5G.png'), 'alt' => 'Samsung Galaxy A57 5G smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy S26 Ultra', 'price' => 'Rp24.499.000', 'rating' => '4.8', 'reviews' => '4.8k', 'badge' => 'Popular', 'image' => self::image('Galaxy S26 Ultra.png'), 'alt' => 'Samsung Galaxy S26 Ultra smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy Z Flip 8', 'price' => 'Rp15.999.000', 'rating' => '4.7', 'reviews' => '680', 'badge' => 'New', 'image' => self::image('Galaxy Z Flip 8.png'), 'alt' => 'Samsung Galaxy Z Flip 8 smartphone'],
            ['brand' => 'Samsung', 'name' => 'Galaxy Z Fold 8', 'price' => 'Rp32.999.000', 'rating' => '4.9', 'reviews' => '420', 'badge' => 'New', 'image' => self::image('Galaxy Z Fold 8.png'), 'alt' => 'Samsung Galaxy Z Fold 8 smartphone'],
            ['brand' => 'Apple', 'name' => 'iPhone 16', 'price' => 'Rp13.999.000', 'rating' => '4.8', 'reviews' => '2.1k', 'badge' => 'Best Seller', 'image' => self::image('Iphone 16.png'), 'alt' => 'Apple iPhone 16 smartphone'],
            ['brand' => 'Apple', 'name' => 'iPhone 17', 'price' => 'Rp16.999.000', 'rating' => '4.5', 'reviews' => '856', 'badge' => 'Best Seller', 'image' => self::image('Iphone 17.png'), 'alt' => 'Apple iPhone 17 smartphone'],
            ['brand' => 'Apple', 'name' => 'iPhone SE (2025)', 'price' => 'Rp9.999.000', 'rating' => '4.6', 'reviews' => '690', 'badge' => 'Popular', 'image' => self::image('iPhone SE (2025).png'), 'alt' => 'Apple iPhone SE 2025 smartphone'],
            ['brand' => 'POCO', 'name' => 'X7 Pro', 'price' => 'Rp4.499.000', 'rating' => '4.7', 'reviews' => '1.4k', 'badge' => 'Best Seller', 'image' => self::image('Poco X7 Pro.png'), 'alt' => 'POCO X7 Pro smartphone'],
            ['brand' => 'TECNO', 'name' => 'POVA 7 5G', 'price' => 'Rp3.499.000', 'rating' => '4.9', 'reviews' => '2.3k', 'badge' => 'New', 'image' => self::image('Pova 7 5G.png'), 'alt' => 'TECNO POVA 7 5G smartphone'],
            ['brand' => 'Redmi', 'name' => 'Note 14 Pro', 'price' => 'Rp4.999.000', 'rating' => '4.6', 'reviews' => '870', 'badge' => 'Popular', 'image' => self::image('Redmi Note 14 Pro.png'), 'alt' => 'Redmi Note 14 Pro smartphone'],
            ['brand' => 'OPPO', 'name' => 'Reno 13', 'price' => 'Rp6.999.000', 'rating' => '4.7', 'reviews' => '650', 'badge' => 'New', 'image' => self::image('Reno 13.png'), 'alt' => 'OPPO Reno 13 smartphone'],
            ['brand' => 'Vivo', 'name' => 'V70', 'price' => 'Rp6.499.000', 'rating' => '4.6', 'reviews' => '530', 'badge' => 'Popular', 'image' => self::image('V70.png'), 'alt' => 'Vivo V70 smartphone'],
            ['brand' => 'vivo', 'name' => 'X300 Ultra', 'price' => 'Rp21.999.000', 'rating' => '4.8', 'reviews' => '410', 'badge' => 'New', 'image' => self::image('X300 Ultra.png'), 'alt' => 'vivo X300 Ultra smartphone'],
            ['brand' => 'Xiaomi', 'name' => '15T', 'price' => 'Rp9.499.000', 'rating' => '4.7', 'reviews' => '790', 'badge' => 'Popular', 'image' => self::image('Xiaomi 15T.png'), 'alt' => 'Xiaomi 15T smartphone'],
            ['brand' => 'Xiaomi', 'name' => '17 Ultra', 'price' => 'Rp19.999.000', 'rating' => '4.9', 'reviews' => '380', 'badge' => 'New', 'image' => self::image('Xiaomi 17 Ultra.png'), 'alt' => 'Xiaomi 17 Ultra smartphone'],
            ['brand' => 'Y', 'name' => '500', 'price' => 'Rp3.499.000', 'rating' => '4.5', 'reviews' => '290', 'badge' => 'Popular', 'image' => self::image('Y500.png'), 'alt' => 'Y500 smartphone'],
            ['brand' => '7Hz', 'name' => 'Salnotes Zero', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('7Hz - Salnotes Zero.png'), 'alt' => '7Hz Salnotes Zero earphones'],
            ['brand' => 'Acome', 'name' => 'Inpods AT09', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Acome Inpods AT09.png'), 'alt' => 'Acome Inpods AT09 earphones'],
            ['brand' => 'Anker Soundcore', 'name' => 'Life Q35', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Anker Soundcore - Life Q35.png'), 'alt' => 'Anker Soundcore Life Q35 headphones'],
            ['brand' => 'Beats', 'name' => 'Studio Pro', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Beats - Studio Pro.png'), 'alt' => 'Beats Studio Pro headphones'],
            ['brand' => 'Bose', 'name' => 'QuietComfort Ultra', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Bose - QuietComfort Ultra.png'), 'alt' => 'Bose QuietComfort Ultra headphones'],
            ['brand' => 'CCA', 'name' => 'CRA+', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('CCA - CRA+.png'), 'alt' => 'CCA CRA plus earphones'],
            ['brand' => 'CCA', 'name' => 'Phoenix', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('CCA - Phoenix.png'), 'alt' => 'CCA Phoenix earphones'],
            ['brand' => 'CVJ', 'name' => 'Vivian', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('CVJ Vivian.png'), 'alt' => 'CVJ Vivian earphones'],
            ['brand' => 'Huawei', 'name' => 'FreeBuds SE 4 ANC', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Huawei FreeBuds SE 4 ANC.png'), 'alt' => 'Huawei FreeBuds SE 4 ANC earphones'],
            ['brand' => 'JBL', 'name' => 'Live Beam 3', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('JBL - Live Beam 3.png'), 'alt' => 'JBL Live Beam 3 earphones'],
            ['brand' => 'JBL', 'name' => 'Tune 720BT', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('JBL - Tune 720BT.png'), 'alt' => 'JBL Tune 720BT headphones'],
            ['brand' => 'KZ', 'name' => 'EDX Pro', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('KZ - EDX Pro.png'), 'alt' => 'KZ EDX Pro earphones'],
            ['brand' => 'KZ', 'name' => 'ZSN Pro X', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('KZ - ZSN Pro X.png'), 'alt' => 'KZ ZSN Pro X earphones'],
            ['brand' => 'Marshall', 'name' => 'Major V', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Marshall - Major V.png'), 'alt' => 'Marshall Major V headphones'],
            ['brand' => 'Moondrop', 'name' => 'Aria 2', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Moondrop - Aria 2.png'), 'alt' => 'Moondrop Aria 2 earphones'],
            ['brand' => 'Moondrop', 'name' => 'Chu II', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Moondrop - Chu II.png'), 'alt' => 'Moondrop Chu II earphones'],
            ['brand' => 'Nothing', 'name' => 'Ear (3)', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Nothing - Ear (3).png'), 'alt' => 'Nothing Ear 3 earphones'],
            ['brand' => 'OPPO', 'name' => 'Enco Buds3 Pro', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Oppo Enco Buds3 Pro.png'), 'alt' => 'OPPO Enco Buds3 Pro earphones'],
            ['brand' => 'Redmi', 'name' => 'Buds 6', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Redmi Buds 6.png'), 'alt' => 'Redmi Buds 6 earphones'],
            ['brand' => 'Redskull', 'name' => 'ET01', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Redskull ET01.png'), 'alt' => 'Redskull ET01 earphones'],
            ['brand' => 'Robot', 'name' => 'Enco Buds 6', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Robot Enco Buds 6.png'), 'alt' => 'Robot Enco Buds 6 earphones'],
            ['brand' => 'Samsung', 'name' => 'Galaxy Buds 3 Pro', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Samsung - Galaxy Buds 3 Pro.png'), 'alt' => 'Samsung Galaxy Buds 3 Pro earphones'],
            ['brand' => 'Sennheiser', 'name' => 'Momentum 4', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Sennheiser - Momentum 4.png'), 'alt' => 'Sennheiser Momentum 4 headphones'],
            ['brand' => 'Simgot', 'name' => 'EW300', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Simgot - EW300.png'), 'alt' => 'Simgot EW300 earphones'],
            ['brand' => 'Skullcandy', 'name' => 'Crusher ANC 2', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Skullcandy - Crusher ANC 2.png'), 'alt' => 'Skullcandy Crusher ANC 2 headphones'],
            ['brand' => 'Sony', 'name' => 'WF-1000XM5', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Sony - WF-1000XM5.png'), 'alt' => 'Sony WF-1000XM5 earphones'],
            ['brand' => 'Sony', 'name' => 'WH-1000XM6', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Sony - WH-1000XM6.png'), 'alt' => 'Sony WH-1000XM6 headphones'],
            ['brand' => 'Soundcore', 'name' => 'R501', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Soundcore r501.png'), 'alt' => 'Soundcore R501 earphones'],
            ['brand' => 'Soundcore', 'name' => 'R60i NC', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Soundcore R60i NC.png'), 'alt' => 'Soundcore R60i NC earphones'],
            ['brand' => 'Tanchjim', 'name' => 'Bunny', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Tanchjim Bunny.png'), 'alt' => 'Tanchjim Bunny earphones'],
            ['brand' => 'TRN', 'name' => 'MT1 Pro', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('TRN - MT1 Pro.png'), 'alt' => 'TRN MT1 Pro earphones'],
            ['brand' => 'Truthear', 'name' => 'Gate', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Truthear - Gate.png'), 'alt' => 'Truthear Gate earphones'],
            ['brand' => 'Truthear', 'name' => 'Hexa', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'Popular', 'category' => 'Earphone', 'image' => self::headphone('Truthear - Hexa.png'), 'alt' => 'Truthear Hexa earphones'],
            ['brand' => 'Ultrapods', 'name' => 'Pro', 'price' => 'Price pending', 'rating' => 'New', 'reviews' => '0', 'badge' => 'New', 'category' => 'Earphone', 'image' => self::headphone('Ultrapods Pro.png'), 'alt' => 'Ultrapods Pro earphones'],
        ];

        return array_map(fn (array $product): array => [...$product, 'id' => (string) Str::uuid(), 'visible' => true], $products);
    }

    private static function image(string $filename): string
    {
        return Vite::asset('resources/images/phones/'.$filename);
    }

    private static function headphone(string $filename): string
    {
        return Vite::asset('resources/images/headphones/'.$filename);
    }
}
