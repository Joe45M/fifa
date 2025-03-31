<?php

namespace App\Enum;

enum FixtureStatus: string
{
    case Pending = 'pending';
    case Unplayed = 'unplayed';
    case Completed = 'completed';
    case Postponed = 'postponed';
}
