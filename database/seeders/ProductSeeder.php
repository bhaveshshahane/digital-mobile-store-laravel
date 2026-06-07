<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'iPhone 15 Pro',
                'description' => 'The latest iPhone with A17 Pro chip and titanium design.',
                'price' => 999.00,
                'stock' => 50,
            ],
            [
                'category_id' => 1,
                'name' => 'Samsung Galaxy S24 Ultra',
                'description' => 'Flagship Android smartphone with powerful AI features.',
                'price' => 1199.00,
                'stock' => 30,
            ],
            [
                'category_id' => 2,
                'name' => 'iPad Air M2',
                'description' => 'Powerful and lightweight tablet for creativity and productivity.',
                'price' => 599.00,
                'stock' => 20,
            ],
            [
                'category_id' => 3,
                'name' => 'AirPods Pro 2',
                'description' => 'Wireless earbuds with active noise cancellation.',
                'price' => 249.00,
                'stock' => 100,
            ],
            [
                'category_id' => 3,
                'name' => 'Fast Charging Adapter 20W',
                'description' => 'USB-C fast charging adapter for mobile devices.',
                'price' => 19.99,
                'stock' => 200,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
