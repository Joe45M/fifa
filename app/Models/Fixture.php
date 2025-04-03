<?php

namespace App\Models;

use App\Enum\FixtureStatus;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{

    use Compoships;
    public $fillable = [
        'league_id',
        'kickoff_at',
        'home_club_id',
        'away_club_id',
        'sewason',
        'type',
        'status',
    ];

    public $casts = [
        'kickoff_at' => 'datetime',
        'status' => FixtureStatus::class,
    ];
    public function homeClub()
    {
        return $this->hasOne(Club::class, 'id', 'home_club_id');
    }

    public function awayClub()
    {
        return $this->hasOne(Club::class, 'id', 'away_club_id');
    }

    public function canSubmitStats()
    {
        $canSubmit = true;

        if ($this->status == FixtureStatus::Completed ||
            $this->status == FixtureStatus::Pending   ||
            $this->status == FixtureStatus::Postponed) {
            $canSubmit = false;
        }

        if (!$this->kickoff_at->lt(now())) {
            $canSubmit = false;
        }

        return $canSubmit;
    }
}
