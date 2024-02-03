<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Keuangan\JenisTransaksiController;
use App\Http\Controllers\Backend\Keuangan\PembayaranController;
use App\Http\Controllers\Backend\TataUsaha\PesertaDidikController;
use App\Http\Controllers\Backend\TataUsaha\RombonganBelajarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('/dashboard', DashboardController::class);

//Tata Usaha
Route::resource('/data-peserta-didik', PesertaDidikController::class);
Route::resource('/rombongan-belajar', RombonganBelajarController::class);

// Keuangan
Route::resource('/jenis-transaksi', JenisTransaksiController::class);
Route::resource('/pembayaran', PembayaranController::class);

