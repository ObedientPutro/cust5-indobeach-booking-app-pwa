<?php

namespace App\Enums;

enum BookingStatus: string
{
    case WaitingApproval = 'waiting approval';
    case WaitingPaymentConfirmation = 'waiting payment confirmation';
    case WaitingCancelConfirmation = 'waiting cancel confirmation';
    case Payment = 'payment';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
}
