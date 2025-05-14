<?php

namespace App\Enums;

enum BookingStatus: string
{
    case WaitingApproval = 'waiting approval';
    case Payment = 'payment';
    case WaitingConfirmation = 'waiting confirmation';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
}
