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

    /**
     * Mengembalikan label yang ramah untuk dibaca pengguna.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::WaitingApproval => 'waiting approval',
            self::WaitingPaymentConfirmation => 'waiting payment confirmation',
            self::WaitingCancelConfirmation => 'waiting cancel confirmation',
            self::Payment => 'payment',
            self::Confirmed => 'confirmed',
            self::Completed => 'completed',
            self::Rejected => 'rejected',
            self::Cancelled => 'cancelled',
        };
    }

    /**
     * Mengembalikan kelas warna Tailwind CSS untuk badge status.
     */
    public function getColorClass(): string
    {
        return match ($this) {
            self::Confirmed, self::Completed => 'bg-green-100 text-green-700',
            self::Payment => 'bg-blue-100 text-blue-700',
            self::WaitingApproval, self::WaitingPaymentConfirmation, self::WaitingCancelConfirmation => 'bg-yellow-100 text-yellow-800',
            self::Rejected => 'bg-red-100 text-red-700',
            self::Cancelled => 'bg-gray-100 text-gray-700',
        };
    }

    /**
     * Mendapatkan semua status dalam format array untuk dropdown atau filter.
     * @return array
     */
    public static function toArray(): array
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[] = [
                'id' => $case->value,
                'name' => $case->getLabel(),
                'color' => $case->getColorClass(),
            ];
        }
        return $cases;
    }
}
