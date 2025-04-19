<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryGameData = [
            ['category_id' => 1, 'game_id' => 1],
            ['category_id' => 2, 'game_id' => 1],
            ['category_id' => 3, 'game_id' => 1],
            ['category_id' => 4, 'game_id' => 1],
            ['category_id' => 1, 'game_id' => 2],
            ['category_id' => 4, 'game_id' => 2],
            ['category_id' => 2, 'game_id' => 3],
            ['category_id' => 3, 'game_id' => 3],
            ['category_id' => 2, 'game_id' => 4],
            ['category_id' => 3, 'game_id' => 4],
            ['category_id' => 4, 'game_id' => 4],
            ['category_id' => 2, 'game_id' => 5],
            ['category_id' => 3, 'game_id' => 5],
            ['category_id' => 4, 'game_id' => 5],
        ];

        DB::table('category_game')->insert($categoryGameData);
    }
}



