<?php

namespace App\Enums;

enum AssetStatusEnum
{
    case AVAILABLE = 'available';
    case IN_USE = 'in_use';
    case UNDER_MAINTENANCE = 'under_maintenance';
}
