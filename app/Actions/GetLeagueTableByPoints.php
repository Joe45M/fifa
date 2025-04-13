<?php

namespace App\Actions;

use App\Models\League;
use Illuminate\Support\Facades\Log;

class GetLeagueTableByPoints
{
    public static function get(League $league)
    {
        return $league->clubs()
            ->get(['id', 'name', 'league_id'])
            ->append(['pointsThisSeason', 'league'])
            ->sortByDesc('pointsThisSeason');
    }
}
