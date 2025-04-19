<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attribute_game')->insert([
            // Assuming `game_id` 1 and 2 are defined in your games table
            ['attribute_id' => 1, 'game_id' => 1], // Server -> World of Warcraft
            ['attribute_id' => 1, 'game_id' => 2], // Server -> League of Legends
            ['attribute_id' => 1, 'game_id' => 3], // Server -> Fortnite
            ['attribute_id' => 1, 'game_id' => 4], // Server -> Counter-Strike 2
            ['attribute_id' => 1, 'game_id' => 5], // Server -> Call of Duty: Warzone

            ['attribute_id' => 2, 'game_id' => 1], // Rank -> World of Warcraft
            ['attribute_id' => 2, 'game_id' => 2], // Rank -> League of Legends
            ['attribute_id' => 2, 'game_id' => 3], // Rank -> Fortnite
            ['attribute_id' => 2, 'game_id' => 4], // Rank -> Counter-Strike 2
            ['attribute_id' => 2, 'game_id' => 5], // Rank -> Call of Duty: Warzone
            
            ['attribute_id' => 3, 'game_id' => 1], // Level -> World of Warcraft
            ['attribute_id' => 3, 'game_id' => 2], // Level -> League of Legends
            ['attribute_id' => 3, 'game_id' => 3], // Level -> Fortnite
            ['attribute_id' => 3, 'game_id' => 4], // Level -> Counter-Strike 2
            ['attribute_id' => 3, 'game_id' => 5], // Level -> Call of Duty: Warzone
            
            ['attribute_id' => 4, 'game_id' => 1], // Delivery Speed -> World of Warcraft
            ['attribute_id' => 4, 'game_id' => 2], // Delivery Speed -> League of Legends
            ['attribute_id' => 4, 'game_id' => 3], // Delivery Speed -> Fortnite
            ['attribute_id' => 4, 'game_id' => 4], // Delivery Speed -> Counter-Strike 2
            ['attribute_id' => 4, 'game_id' => 5], // Delivery Speed -> Call of Duty: Warzone
            
            ['attribute_id' => 5, 'game_id' => 1], // Warranty Period -> World of Warcraft
            ['attribute_id' => 5, 'game_id' => 2], // Warranty Period -> League of Legends
            ['attribute_id' => 5, 'game_id' => 3], // Warranty Period -> Fortnite
            ['attribute_id' => 5, 'game_id' => 4], // Warranty Period -> Counter-Strike 2
            ['attribute_id' => 5, 'game_id' => 5], // Warranty Period -> Call of Duty: Warzone
        ]);
    }
}
