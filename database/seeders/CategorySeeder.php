<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Smartphones'],
            ['name' => 'Tablets'],
            ['name' => 'Accessories'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
