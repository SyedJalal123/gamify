<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attributes')->insert([
            // Game-Specific Attributes
            [
                'name' => 'Server',
                'options' => json_encode(['NA', 'EU', 'ASIA']),
                'applies_to' => 'game',
                // 'game_id'  => 1,
                // 'category_id'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rank',
                'options' => json_encode(['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond']),
                'applies_to' => 'game',
                // 'game_id'  => 1,
                // 'category_id'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Level',
                'options' => json_encode(['1-10', '11-20', '21-30', '31-40', '41+']),
                'applies_to' => 'game',
                // 'game_id'  => 1,
                // 'category_id'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Category-Specific Attributes
            [
                'name' => 'Delivery Speed',
                'options' => json_encode(['Instant', '1-6 Hours', '6-12 Hours', '1-2 Days']),
                'applies_to' => 'category',
                // 'game_id'  => null,
                // 'category_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Warranty Period',
                'options' => json_encode(['No Warranty', '7 Days', '30 Days', 'Lifetime']),
                'applies_to' => 'category',
                // 'game_id'  => null,
                // 'category_id'  => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
