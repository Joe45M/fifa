<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixtureMeta extends Model
{
    protected $fillable = [
        'fixture_id',
        'meta_key',
        'meta_value',
    ];

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    public function scopeHomeScore()
    {
        return $this->where('meta_key', 'home_propped_score');
    }

    public function scopeAwayScore()
    {
        return $this->where('meta_key', 'away_propped_score');
    }
}
