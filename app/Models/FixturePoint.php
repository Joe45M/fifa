<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixturePoint extends Model
{
    protected $fillable = [
        'fixture_id',
        'club_id',
        'points',
        'season',
        'league_id',
        'type',
    ];

    public function club()
    {
        return $this->hasOne(Club::class, 'id', 'club_id');
    }

    public function scopeSeason(int $season)
    {
        return $this->where('season', $season);
    }
}
