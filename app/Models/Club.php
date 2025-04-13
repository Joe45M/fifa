<?php

namespace App\Models;

use App\Enum\ContractStatus;
use App\Enum\ContractType;
use Awobaz\Compoships\Compoships;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{

    use InteractsWithMedia, HasFactory;

    public $with = ['league'];

    public $fillable = ['name', 'status', 'league_id'];

    public function league()
    {
        return $this->hasOne(League::class, 'id', 'league_id');
    }

    public function players()
    {
        return $this->hasManyThrough(User::class, Contract::class,
            'club_id',
            'id',
            'id',
            'user_id')->where('contracts.status', ContractStatus::Active);
    }

    public function manager()
    {
        return $this
            ->hasOneThrough(User::class, Contract::class,
                'club_id',
                'id',
                'id',
                'user_id')
            ->where('contracts.status', ContractStatus::Active)
            ->where('contracts.type', ContractType::Manager);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Get the home fixtures for the club.
     */
    public function homeFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'home_club_id', 'id');
    }

    /**
     * Get the away fixtures for the club.
     */
    public function awayFixtures(): HasMany
    {
        return $this->hasMany(Fixture::class, 'away_club_id', 'id');
    }
    public function getFixturesAttribute()
    {
        return $this->homeFixtures()->get()->merge($this->awayFixtures()->get());
    }

    public function fixturePoints()
    {
        return $this->hasMany(FixturePoint::class, 'club_id', 'id');
    }

    public function getPointsThisSeasonAttribute()
    {
        return $this->fixturePoints()
            ->where('season', $this->league->season)
            ->where('league_id', $this->league->id)
            ->sum('points');
    }

    public function getGamesPlayedThisSeasonAttribute()
    {
        return $this->fixturePoints()
            ->where('season', $this->league->season)
            ->count();
    }

    public function getFormAttribute()
    {
        $points = $this->fixturePoints()
            ->limit(5)
            ->get('points')
            ->sortByDesc('created_at');

        return $points->map(function ($point) {

            if ($point->points > 0) {
                return 'W';
            } elseif ($point->points < 0) {
                return 'L';
            } else {
                return 'D';
            }

        });
    }
}
