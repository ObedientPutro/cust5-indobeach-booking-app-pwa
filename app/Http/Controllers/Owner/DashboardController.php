<?php

namespace App\Http\Controllers\Owner;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = [
            BookingStatus::WaitingApproval,
            BookingStatus::WaitingPaymentConfirmation,
            BookingStatus::WaitingCancelConfirmation,
        ];

        $bookings = Booking::whereIn('status', $statuses)
            ->latest('updated_at')
            ->with(['post', 'user'])
            ->paginate(10);

        $reserved_bookings = Booking::where('status', BookingStatus::Confirmed)
            ->latest('start_date')
            ->with(['post', 'user'])
            ->paginate(10);

        return Inertia::render('Owner/Dashboard/Dashboard', [
            'bookings' => $bookings,
            'reserved_bookings' => $reserved_bookings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('admin.dashboard.index');
    }
}
