<?php

namespace App\Http\Controllers\Owner;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\BookingStatusUpdated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class OwnerBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('post', 'user')->latest('created_at')->paginate(10);

        return Inertia::render('Owner/Booking/BookingList', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load('post.images', 'post.category', 'user');

        return Inertia::render('Owner/Booking/BookingView', [
            'booking' => $booking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function acceptBooking(Booking $booking)
    {
        return DB::transaction(function () use ($booking) {
            $booking->load(['user', 'post']);

            // --- LOGIKA BARU UNTUK VALIDASI SAAT MENERIMA PERMINTAAN ---
            if ($booking->status === BookingStatus::WaitingApproval) {

                $post = $booking->post;
                $startDate = Carbon::parse($booking->start_date);
                $endDate = Carbon::parse($booking->end_date);

                // Hitung semua booking lain yang "memegang" slot pada tanggal yang sama
                $conflictingBookingsCount = Booking::where('post_id', $post->id)
                    ->where('id', '!=', $booking->id) // Abaikan booking yang sedang diproses
                    ->whereIn('status', [
                        BookingStatus::Confirmed,
                        BookingStatus::WaitingPaymentConfirmation,
                        BookingStatus::Payment
                    ])
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $endDate)
                            ->where('end_date', '>=', $startDate);
                    })
                    ->count();

                // Jika jumlah booking yang konflik >= kuantitas total, maka kembalikan error
                if ($conflictingBookingsCount >= $post->quantity) {
                    return back()->with('error', 'Post quantity is full at this date.');
                }
            }

            // --- LOGIKA LAMA UNTUK MENGUBAH STATUS ---
            switch ($booking->status) {
                case BookingStatus::WaitingApproval:
                    $booking->update(['status' => BookingStatus::Payment]);
                    $successMessage = 'Approval for' . $booking->user->name . ' accepted, waiting for payment.';
                    break;
                case BookingStatus::WaitingPaymentConfirmation:
                    $booking->update(['status' => BookingStatus::Confirmed]);
                    $this->autoRejectConflictingBookings($booking);
                    $successMessage = 'Payment for ' . $booking->user->name . ' confirmed.';
                    break;
                case BookingStatus::WaitingCancelConfirmation:
                    $booking->update(['status' => BookingStatus::Cancelled]);
                    $successMessage = 'Cancellation request for ' . $booking->user->name . ' accepted.';
                    break;
                default:
                    return back()->with('error', 'Something Wrong with Acception, Call Developer!');
            }

            // Kirim notifikasi ke pelanggan
            Notification::send($booking->user, new BookingStatusUpdated($booking));

            return back()->with('success', $successMessage);
        });
    }

    /**
     * Method terpisah untuk logika auto-reject agar kode lebih bersih.
     */
    protected function autoRejectConflictingBookings(Booking $confirmedBooking)
    {
        $post = $confirmedBooking->post;
        $startDate = Carbon::parse($confirmedBooking->start_date);
        $endDate = Carbon::parse($confirmedBooking->end_date);

        // Hitung semua booking yang sudah confirmed pada rentang tanggal tersebut
        $confirmedCount = Booking::where('post_id', $post->id)
            ->where('status', BookingStatus::Confirmed)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<=', $endDate)
                    ->where('end_date', '>=', $startDate);
            })->count();

        // Jika jumlah yang terkonfirmasi sudah memenuhi kuota
        if ($confirmedCount >= $post->quantity) {
            // Cari semua booking lain yang masih menunggu persetujuan pada tanggal yang sama
            $otherPendingBookings = Booking::where('post_id', $post->id)
                ->where('status', BookingStatus::WaitingApproval)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $startDate);
                })->get();

            // Tolak semua permintaan tersebut dan kirim notifikasi
            foreach ($otherPendingBookings as $bookingToReject) {
                $bookingToReject->update(['status' => BookingStatus::Rejected]);
                Notification::send($bookingToReject->user, new BookingStatusUpdated($bookingToReject));
            }
        }
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
                Notification::send($booking->user, new BookingStatusUpdated($booking));
                return back()->with('success', 'Booking from ' . $booking->user->name . ' Rejected');
            case BookingStatus::WaitingPaymentConfirmation:
                $booking->update(['status' => BookingStatus::Payment]);
                Notification::send($booking->user, new BookingStatusUpdated($booking));
                return back()->with('success', 'Payment from ' . $booking->user->name . ' Rejected');
            case BookingStatus::WaitingCancelConfirmation:
                $booking->update(['status' => BookingStatus::Confirmed]);
                Notification::send($booking->user, new BookingStatusUpdated($booking));
                return back()->with('success', 'Cancellation Request from ' . $booking->user->name . ' Rejected');
        }
        return back()->with('error', 'Something Wrong with Acception, Call Developer!');
    }
}
