<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\User;
use App\Models\PembelianItem;
use App\Models\Bill;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Validasi data request
        $serverUser = User::where('id_role', 2)->first(); // Mengambil user dengan peran 'server'
        // Buat transaksi pembelian
        $pembelian = Pembelian::create([
            'tanggal_pembelian' => Carbon::now(),
            'id_user' => $request->user()->id_user,
            'id_server' => $serverUser->id_user,
        ]);

        // Loop untuk menambahkan pembelian items
        foreach ($request->items as $item) {
            PembelianItem::create([
                'id_produk' => $item['id_produk'],
                'id_pembelian' => $pembelian->id_pembelian,
                'kuantitas' => $item['kuantitas'],
                'total_harga' => $item['total_harga'],
            ]);
        }

        // Hitung total harga dari seluruh items
        $totalHarga = array_sum(array_column($request->items, 'total_harga'));

        // Buat billing dengan status pending
        $bill = Bill::create([
            'id_user' => $request->user()->id_user,
            'status_pembayaran' => 'pending',
            'metode_pembayaran' => 'midtrans', // Sesuaikan dengan metode pembayaran
            'total_harga' => $totalHarga,
        ]);

        // Update billing ID pada pembelian
        $pembelian->update(['id_bill' => $bill->id_bill]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.is_production')
            ? config('midtrans.server_key')
            : config('midtrans.sandbox_server_key');
        Config::$isProduction = config('midtrans.is_production');

        // Buat pesanan pembayaran Midtrans
        $midtransParams = [
            'transaction_details' => [
                'order_id' => uniqid(), // Gunakan nilai unik sebagai order_id
                'gross_amount' => $totalHarga,
            ],
            // ... (lanjutkan sesuai kebutuhan)

            // Gunakan kunci sesuai dengan mode produksi/sandbox
            'enabled_payments' => config('midtrans.is_production')
                ? ['gopay', 'bank_transfer']
                : ['gopay', 'bank_transfer', 'echannel'],
        ];

        // Buat URL pembayaran Midtrans
        $midtransPaymentUrl = Snap::createTransaction($midtransParams)->redirect_url;

        return response()->json(['message' => 'Transaction created successfully', 'payment_url' => $midtransPaymentUrl]);
    }

    
    public function finishTransaction(Request $request)
{
    $user = $request->user();

    // Contoh menyimpan data transaksi ke tabel bills
    $bill = new Bill();
    $bill->id_user = $user->id_user;
    $bill->metode_pembayaran = 'Midtrans'; // Misalnya menggunakan Midtrans
    $bill->save();

    // Contoh menyimpan data pembelian item ke tabel pembelianitems
    foreach ($request->items as $item) {
        $pembelianItem = new Pembelianitem();
        $pembelianItem->id_produk = $item['id_produk'];
        $pembelianItem->id_pembelian = $bill->id_bill; // Menggunakan id_bill yang baru saja dibuat
        $pembelianItem->kuantitas = $item['kuantitas'];
        $pembelianItem->total_harga = $item['total_harga'];
        $pembelianItem->save();
    }

    // Tandai status_pembayaran di tabel bill menjadi 'Lunas'
    $bill->status_pembayaran = 'Lunas';
    $bill->save();

    return response()->json(['message' => 'Transaction finished successfully']);
}

}
