<?php

namespace App\Models;

use App\Enum\StatStatus;
use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
    protected $fillable = [
        'fixture_id',
        'club_id',
        'user_id',
        'season',
        'totw_points',
        'value',
        'position',
        'stat',
        'status'
    ];

    public function casts()
    {
        return [
            'status' => StatStatus::class,
        ];
    }

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
