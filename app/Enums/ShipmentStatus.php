<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case PENDING = 'pending';

    case PICKING = 'picking';

    case PACKING = 'packing';

    case DISPATCHING = 'dispatching';

    case SHIPPED = 'shipped';

    case DELIVERED = 'delivered';

    case RETURNED = 'returned';
}
