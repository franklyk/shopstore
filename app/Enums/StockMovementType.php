<?php

namespace App\Enums;

enum StockMovementType: string
{
    case IN = 'in';

    case OUT = 'out';

    case RESERVED = 'reserved';

    case RELEASED = 'released';

    case ADJUSTMENT = 'adjustment';
}