<?php

namespace Database\Seeders;

use App\Enum\FixtureStatus;
use App\Enum\FixtureType;
use App\Models\Club;
use App\Models\League;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $league = League::find(1);

        $clubs = Club::all();

        $fixtures = [
            [
                'kickoff_at' => now()->addHour(),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
            [
                'kickoff_at' => now()->subHour(),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
            [
                'kickoff_at' => now()->addDays(1),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
            [
                'kickoff_at' => now()->addDays(2),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
            [
                'kickoff_at' => now()->addDays(3),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
            [
                'kickoff_at' => now()->addDays(4),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
            [
                'kickoff_at' => now()->addDays(5),
                'home_club_id' => $clubs->random()->id,
                'away_club_id' => $clubs->random()->id,
                'league_id' => $league->id,
                'season' => $league->season,
                'type' => FixtureType::League,
                'status' => FixtureStatus::Unplayed,
            ],
        ];

        foreach ($fixtures as $fixture) {
            \App\Models\Fixture::create($fixture);
        }
    }
}
