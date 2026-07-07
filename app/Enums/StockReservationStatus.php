<?php

namespace App\Enums;

enum StockReservationStatus: string
{
    case ACTIVE = 'active';

    case CONFIRMED = 'confirmed';

    case CANCELLED = 'cancelled';
    
    case EXPIRED = 'expired';
}
