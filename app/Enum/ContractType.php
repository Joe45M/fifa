<?php

namespace App\Enum;

enum ContractType: string
{
    case Manager = 'manager';
    case CoManager = 'co-manager';
    case Player = 'player';
}
