<?php

namespace App\Http\Controllers\Owner;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class OwnerBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function acceptBooking(Booking $booking)
    {
        $booking->load('user');
        switch ($booking->status) {
            case BookingStatus::WaitingApproval:
                $booking->update(['status' => BookingStatus::Payment]);
                return back()->with('success', 'Booking from ' . $booking->user->name . ' Approved');
            case BookingStatus::WaitingPaymentConfirmation:
                $booking->update(['status' => BookingStatus::Confirmed]);
                return back()->with('success', 'Payment from ' . $booking->user->name . ' Confirmed');
            case BookingStatus::WaitingCancelConfirmation:
                $booking->update(['status' => BookingStatus::Cancelled]);
                return back()->with('success', 'Cancellation Request from ' . $booking->user->name . ' Accepted');
        }
        return back()->with('error', 'Something Wrong with Acception, Call Developer!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function rejectBooking(Booking $booking)
    {
        $booking->load('user');
        switch ($booking->status) {
            case BookingStatus::WaitingApproval:
                $booking->update(['status' => BookingStatus::Rejected]);
                return back()->with('success', 'Booking from ' . $booking->user->name . ' Rejected');
            case BookingStatus::WaitingPaymentConfirmation:
                $booking->update(['status' => BookingStatus::Payment]);
                return back()->with('success', 'Payment from ' . $booking->user->name . ' Rejected');
            case BookingStatus::WaitingCancelConfirmation:
                $booking->update(['status' => BookingStatus::Confirmed]);
                return back()->with('success', 'Cancellation Request from ' . $booking->user->name . ' Rejected');
        }
        return back()->with('error', 'Something Wrong with Acception, Call Developer!');
    }
}
