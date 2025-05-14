<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Payment = 'payment';
    case Confirmed = 'confirmed';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
    case Completed = 'completed';
}
