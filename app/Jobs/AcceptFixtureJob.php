<?php

namespace App\Jobs;

use App\Enum\FixtureStatus;
use App\Enum\PointType;
use App\Enum\StatStatus;
use App\Models\Fixture;
use App\Models\FixturePoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AcceptFixtureJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Fixture $fixture)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->fixture->stats()->update([
            'status' => StatStatus::Active,
        ]);


        $this->resolveWinner();
        $this->fixture->update([
            'status' => FixtureStatus::Completed,
        ]);

    }

    public function resolveWinner()
    {
        if (!$this->fixture->scoresMatch) {
            throw new \Exception('Fixture scores do not match');
        }

        $score = explode('-', $this->fixture->proppedScore);

        $homeScore = $score[0];
        $awayScore = $score[1];

        if ($homeScore > $awayScore) {
            $home_points = 3;
            $away_points = 0;
        } elseif ($homeScore < $awayScore) {
            $home_points = 0;
            $away_points = 3;
        } elseif ($homeScore == $awayScore) {
            $home_points = 1;
            $away_points = 1;
        }

        FixturePoint::create([
            'fixture_id' => $this->fixture->id,
            'club_id' => $this->fixture->home_club_id,
            'points' => $home_points,
            'season' => $this->fixture->homeClub->league->season,
            'league_id' => $this->fixture->homeClub->league->season,
            'type' => PointType::League,
        ]);

        FixturePoint::create([
            'fixture_id' => $this->fixture->id,
            'club_id' => $this->fixture->away_club_id,
            'points' => $away_points,
            'season' => $this->fixture->awayClub->league->season,
            'league_id' => $this->fixture->awayClub->league->season,
            'type' => PointType::League,
        ]);
    }
}
