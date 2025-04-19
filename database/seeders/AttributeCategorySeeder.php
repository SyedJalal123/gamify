<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attribute_category')->insert([
            // Assuming `category_id` 1 and 2 are defined in your categories table
            ['attribute_id' => 1, 'category_id' => 1], // Server -> Gold
            ['attribute_id' => 1, 'category_id' => 2], // Server -> Accounts
            ['attribute_id' => 1, 'category_id' => 3], // Server -> Boosting
            ['attribute_id' => 1, 'category_id' => 4], // Server -> Items

            ['attribute_id' => 2, 'category_id' => 2], // Rank -> Accounts
            ['attribute_id' => 2, 'category_id' => 3], // Rank -> Boosting

            ['attribute_id' => 3, 'category_id' => 2], // Level -> Accounts
            ['attribute_id' => 3, 'category_id' => 3], // Level -> Boosting
            ['attribute_id' => 3, 'category_id' => 4], // Level -> Items

            ['attribute_id' => 4, 'category_id' => 1], // Delivery Speed -> Gold
            ['attribute_id' => 4, 'category_id' => 2], // Delivery Speed -> Accounts
            ['attribute_id' => 4, 'category_id' => 3], // Delivery Speed -> Boosting
            ['attribute_id' => 4, 'category_id' => 4], // Delivery Speed -> Items

            ['attribute_id' => 5, 'category_id' => 1], // Warranty Period -> Gold
            ['attribute_id' => 5, 'category_id' => 2], // Warranty Period -> Accounts
            ['attribute_id' => 5, 'category_id' => 3], // Warranty Period -> Boosting
            ['attribute_id' => 5, 'category_id' => 4], // Warranty Period -> Items
        ]);
    }
}
