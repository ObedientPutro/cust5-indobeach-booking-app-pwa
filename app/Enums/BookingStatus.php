<?php

namespace App\Enums;

enum BookingStatus: string
{
    case WaitingApproval = 'waiting approval';
    case Payment = 'payment';
    case WaitingPaymentConfirmation = 'waiting payment confirmation';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Rejected = 'rejected';
    case WaitingCancelConfirmation = 'waiting cancel confirmation';
    case Cancelled = 'cancelled';
}
