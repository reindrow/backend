<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

//User Route
Route::get('/customers', [UserController::class, 'getCustomers']);
Route::get('/servers', [UserController::class, 'getServers']);
Route::get('/admin', [AdminController::class, 'index']);
Route::put('/customers/{id}', [UserController::class, 'updateCustomer']);

Route::middleware(['auth', 'verified'])->post('/set-location', [UserController::class, 'setLocation']);


//Voucher Route
Route::post('/vouchers', [VoucherController::class, 'createVoucher']);
Route::get('/vouchers', [VoucherController::class, 'index']);
Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy']);
Route::get('/totalvouchersaktif', [VoucherController::class, 'getTotalActiveVouchers']);
Route::post('/vouchers/{id}/restore', [VoucherController::class, 'restore']);

//Lokasi Update
Route::get('/lokasis', [LokasiController::class, 'index']);
Route::post('/lokasis', [LokasiController::class, 'store']);
Route::delete('/lokasis/{id}', [LokasiController::class, 'destroy']);
Route::put('/lokasis/{id}', [LokasiController::class, 'update']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/set-location', [UserController::class, 'chooseLocation']);
});

//Server Route
Route::post('/addServer', [ServerController::class, 'addServer']);

//Booking Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/bookings', [BookingController::class, 'createBooking']);
    Route::put('/bookings/{bookingId}/confirm', [BookingController::class, 'confirmBooking']);
    Route::put('/bookings/{bookingId}/reject', [BookingController::class, 'rejectBooking']);
    Route::put('/bookings/{bookingId}/cancel', [BookingController::class, 'cancelBooking']);
    Route::put('/bookings/{bookingId}/finish', [BookingController::class, 'finishBooking']);

});

//  Route Produk
Route::prefix('produk')->group(function () {
    Route::post('/tambahjenisproduk', [ProdukController::class, 'tambahJenisProduk']);
    Route::put('/update/{id}', [ProdukController::class, 'updateProduk']);
    Route::delete('/hapus/{id}', [ProdukController::class, 'hapusProduk']);
    Route::get('/ambilsemuaproduk', [ProdukController::class, 'ambilProduk']);

    // Tambahkan rute lainnya sesuai kebutuhan Anda
    Route::middleware('auth')->group(function () {
        // Rute-rute yang membutuhkan autentikasi di sini
        Route::post('/create-transaction', [TransactionController::class, 'createTransaction']);
        Route::post('/finish-transaction', [TransactionController::class, 'finishTransaction'])->name('transaksi.finish');

});
    });
    

