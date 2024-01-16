<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function createBooking(Request $request)
{
    // Validasi data yang dikirimkan untuk membuat booking
    $validatedData = $request->validate([
        'id_user' => 'required|exists:users,id_user',
        'id_lokasi' => 'required|exists:lokasis,id_lokasi',
        'id_voucher' => 'nullable|exists:vouchers,id_voucher',
        'tanggal_booking' => 'required|date_format:Y-m-d H:i',
    ]);

    // Tambahkan status 'request' saat membuat booking
    $bookingData = $request->input() + ['status' => 'request'];

    // Buat booking baru
    $booking = Booking::create($bookingData);

    return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 201);
}

    public function confirmBooking($bookingId)
{
    // Temukan booking berdasarkan ID
    $booking = Booking::findOrFail($bookingId);

    // Ubah status booking menjadi 'reserved'
    $booking->update(['status' => 'reserved']);

    return response()->json(['message' => 'Booking confirmed successfully', 'booking' => $booking]);
}

public function rejectBooking($bookingId)
{
    // Temukan booking berdasarkan ID
    $booking = Booking::findOrFail($bookingId);

    // Ubah status booking menjadi 'rejected'
    $booking->update(['status' => 'rejected']);

    return response()->json(['message' => 'Booking rejected successfully', 'booking' => $booking]);
}

public function cancelBooking($bookingId)
{
    // Temukan booking berdasarkan ID
    $booking = Booking::findOrFail($bookingId);

    // Ubah status booking menjadi 'cancel'
    $booking->update(['status' => 'cancelled']);

    return response()->json(['message' => 'Booking cancelled successfully', 'booking' => $booking]);
}

public function finishBooking($bookingId)
{
    // Temukan booking berdasarkan ID
    $booking = Booking::findOrFail($bookingId);

    // Ubah status booking menjadi 'finish'
    $booking->update(['status' => 'finished']);

    return response()->json(['message' => 'Booking finished successfully', 'booking' => $booking]);
}
}
