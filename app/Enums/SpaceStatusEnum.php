<?php

namespace App\Enums;

enum SpaceStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
}
