<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case RESERVED = 'reserved';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
}
