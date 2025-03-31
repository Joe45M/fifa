<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
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
    ];

    public function homeClub()
    {
        return $this->hasOne(Club::class, 'id', 'home_club_id');
    }

    public function awayClub()
    {
        return $this->hasOne(Club::class, 'id', 'away_club_id');
    }
}
