<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run()
    {
        $games = [
            ['name' => 'World of Warcraft'],
            ['name' => 'League of Legends'],
            ['name' => 'Fortnite'],
            ['name' => 'Counter-Strike 2'],
            ['name' => 'Call of Duty: Warzone'],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}