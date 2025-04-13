<?php

namespace App\Models;

use App\Enum\FixtureStatus;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public $with = [
        'homeClub',
        'awayClub',
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

    public function location(Club $club)
    {
        if ($club->id == $this->home_club_id) {
            return 'home';
        } elseif ($club->id == $this->away_club_id) {
            return 'away';
        } else {
            throw new \Exception('Club not found in fixture');
        }
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

    public function fixtureMeta()
    {
        return $this->hasMany(FixtureMeta::class, 'fixture_id', 'id');
    }

    public function hasPropped($club = null)
    {

        if ($club) {
            return $this->fixtureMeta()->where('meta_key', $this->location(Club::find($club)) . '_propped')
                ->exists();
        }

        $result = $this->fixtureMeta()
            ->where('meta_key', $this->location(Auth::user()->currentContract->club) . '_propped')
            ->exists();

        return $result;
    }

    public function getScoresMatchAttribute()
    {
        return $this->fixtureMeta()->homeScore()?->first()?->meta_value === $this->fixtureMeta()->awayScore()?->first()?->meta_value;
    }

    public function getProppedScoreAttribute()
    {
        return $this->fixtureMeta()->where('meta_key', 'home_propped_score')->first('meta_value')?->meta_value;
    }

    public function stats()
    {
        return $this->hasMany(UserStat::class, 'fixture_id', 'id');
    }
}
