<?php

namespace App\Http\Controllers\Customer;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Post;
use Carbon\Carbon;
use Inertia\Inertia;

class CustomerBookingController extends Controller
{
    public function createBooking(Post $post)
    {
        return Inertia::render('Customer/Booking/BookingForm', [
            'post' => $post
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
}
