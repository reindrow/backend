<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherController extends Controller
{
    // Fungsi untuk membuat voucher baru
    public function createVoucher(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_voucher' => 'required|unique:vouchers',
            'diskon' => 'required|numeric',
            'description' => 'required',
            'minimal_pembayaran' => 'required|numeric',
            'tanggal_mulai_berlaku' => 'required|date',
            'tanggal_berakhir_berlaku' => 'required|date|after:tanggal_mulai_berlaku',
            'is_new_user_only' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $voucher = Voucher::create($request->all());

        return response()->json($voucher, 201);
    }

    // Fungsi untuk mendapatkan total voucher yang masih berlaku
    public function index()
    {
        $vouchers = Voucher::all();
        return response()->json($vouchers);
    }

    // Mendapatkan total voucher yang masih aktif
    public function getTotalActiveVouchers()
    {
        $now = Carbon::now();

        $totalActiveVouchers = Voucher::where('tanggal_mulai_berlaku', '<=', $now)
            ->where('tanggal_berakhir_berlaku', '>=', $now)
            ->count();

        return response()->json(['total_active_vouchers' => $totalActiveVouchers], 200);
    }

    // Mengembalikan voucher yang telah dihapus secara lunak
    public function restore($id)
    {
        $voucher = Voucher::withTrashed()->find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        $voucher->restore(); // Mengembalikan entitas Voucher yang telah dihapus secara lunak

        return response()->json(['message' => 'Voucher restored successfully'], 200);
    }

    // Menghapus voucher berdasarkan ID
    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }
        $voucher->delete();
        return response()->json(['message' => 'Voucher deleted successfully'], 200);
    }
}
