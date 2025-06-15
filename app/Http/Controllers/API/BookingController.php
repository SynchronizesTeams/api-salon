<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function sendBooking(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'no_telp' => 'required|string',
            'email' => 'required|email',
            'service' => 'required|string',
            'date' => 'required|date',
            'notes' => 'required|string',
        ]);

        $booking = null;

        DB::transaction(function () use ($request, &$booking) {
            $booking = DB::table('bookings')->insert([
                'name' => $request->name,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'service' => $request->service,
                'date' => $request->date,
                'notes' => $request->notes,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return response()->json([
            'success' => true,
            'data' => $booking
        ]);
    }

    public function getBookings() {
        $bookings = DB::table('bookings')->get();
        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    public function setStatus($id, $status) {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->status = $status;
            $booking->save();
        }

        return response()->json([
            'success' => $booking ? true : false,
            'data' => $booking
        ]);
    }

}
