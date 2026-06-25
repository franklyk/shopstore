<?php

namespace App\Enums;

enum StockReceiptStatus: string
{
    case DRAFT = 'draft';

    case CONFIRMED = 'confirmed';

    case CANCELLED = 'cancelled';
    
}
