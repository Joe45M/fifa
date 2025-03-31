<?php

namespace App\Enum;

enum ContractStatus: string
{
    case Active = 'active';

    case Inactive = 'inactive';

    case Offered = 'offered';

    case Pending = 'pending';

    case Rejected = 'rejected';
}
