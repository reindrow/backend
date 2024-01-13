<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ServerController;
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
Route::middleware(['auth:sanctum', 'verified'])->post('/set-location', [UserController::class, 'setLocation']);


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
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/', [UserController::class, 'chooseLocation']);
});
Route::post('/choose-location', [UserController::class, 'chooseLocation']);

//Server Route
Route::post('/addServer', [ServerController::class, 'addServer']);
