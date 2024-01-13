<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('login'); // Mengarahkan ke halaman login.blade.php
})->middleware(RedirectBasedOnRole::class);
*/
//Route::get('/admin/dashboard', 'AdminController@dashboard')->middleware(['auth', 'role'])->name('admin.dashboard');
//Route::get('/server/dashboard', 'ServerController@dashboard')->middleware(['auth', 'role'])->name('server.dashboard');
//Route::get('/android/dashboard', 'AndroidController@dashboard')->middleware(['auth', 'role'])->name('android.dashboard');


require __DIR__.'/auth.php';
