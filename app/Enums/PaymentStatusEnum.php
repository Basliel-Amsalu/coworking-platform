<?php

namespace App\Enums;

enum PaymentStatusEnum
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}
