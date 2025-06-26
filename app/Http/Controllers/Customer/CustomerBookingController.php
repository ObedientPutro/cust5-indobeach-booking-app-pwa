<?php

namespace App\Http\Controllers\Customer;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UploadPaymentBookingRequest;
use App\Models\Booking;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CustomerBookingController extends Controller
{
    private string $image_path = 'images/payment';

    public function bookingList(Request $request) {
        $request->validate([
            'search' => 'nullable|string|max:100',
        ]);

        $searchFilter = $request->input('search');

        $bookingsQuery = Booking::where('user_id', auth()->id())
            ->with(['post.images']);

        if ($searchFilter) {
            $bookingsQuery->whereHas('post', function ($query) use ($searchFilter) {
                $query->where('title', 'like', '%' . $searchFilter . '%');
            });
        }

        $bookings = $bookingsQuery->latest('created_at')->paginate(10)->withQueryString();

        return Inertia::render('Customer/Booking/BookingList', [
            'bookings' => $bookings,
            'filters' => ['search' => $searchFilter],
        ]);
    }

    public function bookingDetail(Booking $booking) {
        $booking->load('post.images', 'post.category', 'user');

        if (auth()->user() != $booking->user) {
            return back();
        }

        $isUploadPayment = $booking->status == BookingStatus::Payment;

        return Inertia::render('Customer/Booking/BookingView', [
            'statusOptions' => BookingStatus::toArray(),
            'booking' => $booking,
            'isUploadPayment' => $isUploadPayment,
        ]);
    }

    public function createBooking(Post $post)
    {
        return Inertia::render('Customer/Booking/BookingForm', [
            'post' => $post,
        ]);
    }

    public function storeBooking(StoreBookingRequest $request, Post $post)
    {
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $hasOverlap = Booking::where('post_id', $request->post_id)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start_date', '<=', $start)
                            ->where('end_date', '>=', $end);
                    });
            })->exists();

        if ($hasOverlap) {
            return back()->with('error', 'Selected dates are not available. Please choose different dates.');
        }

        // Calculate duration and total price
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) + 1;

        $totalPrice = $days * $post->price;

        Booking::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $totalPrice,
            'status' => BookingStatus::WaitingApproval,
        ]);

        return redirect()->route('gazebo.detail', $post->id)->with('success', 'Booking Success, Waiting for Approval');
    }

    public function bookingPaymentForm(Booking $booking) {
        $booking->load('post', 'user');

        if (auth()->user() != $booking->user) return back();

        if ($booking->status != BookingStatus::Payment) return back();

        return Inertia::render('Customer/Booking/BookingPaymentForm', [
            'booking' => $booking,
        ]);
    }

    public function uploadBookingPayment(UploadPaymentBookingRequest $request, Booking $booking) {
        $booking->load('post', 'user');

        if (auth()->user() != $booking->user) return back();

        if ($booking->status != BookingStatus::Payment) return back();

        if ($booking->payment_image_path != null) {
            Storage::disk('public')->delete($booking->payment_image_path);
        }

        $imageLinkPath = $request->file('image_path')->store($this->image_path, 'public');

        $booking->update([
            'payment_image_path' => $imageLinkPath,
            'status' => BookingStatus::WaitingPaymentConfirmation,
        ]);

        return redirect()->route('booking.detail', $booking->id)->with('success', 'Payment Uploaded Successfully');
    }

}
