<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Gold'],
            ['name' => 'Accounts'],
            ['name' => 'Boosting'],
            ['name' => 'Items'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}