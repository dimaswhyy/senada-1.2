<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Keuangan\LaporanController;
use App\Http\Controllers\Backend\Keuangan\TestimoniController;
use App\Http\Controllers\Backend\Keuangan\PembayaranController;
use App\Http\Controllers\Backend\TataUsaha\PesertaDidikController;
use App\Http\Controllers\Backend\Keuangan\JenisTransaksiController;
use App\Http\Controllers\Backend\PesertaDidik\PembayaranPesertaDidikController;
use App\Http\Controllers\Backend\SuperAdmin\AkunSekolahController;
use App\Http\Controllers\Backend\TataUsaha\RombonganBelajarController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth:account_super_admin,account_sekolah,peserta_didik')->group(function () {
    route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::middleware('auth:account_super_admin,account_sekolah')->group(function () {
    //Super Admin
    Route::resource('/akun-sekolah', AkunSekolahController::class);
});

Route::middleware('auth:account_super_admin,account_sekolah')->group(function () {
    //Tata Usaha
    Route::resource('/data-peserta-didik', PesertaDidikController::class);
    Route::resource('/rombongan-belajar', RombonganBelajarController::class);

    //Keuangan
    //extends
    Route::get('/pembayaran/invoice/{id}', [App\Http\Controllers\Backend\Keuangan\PembayaranController::class, 'invoice'])->name('pembayaran.invoice');
    Route::get('/laporan/export-data-transaksi', [App\Http\Controllers\Backend\Keuangan\LaporanController::class, 'export'])->name('export.data');
    
    //resource
    Route::resource('/jenis-transaksi', JenisTransaksiController::class);
    Route::resource('/pembayaran', PembayaranController::class);
    Route::resource('/laporan', LaporanController::class);
});

Route::middleware('auth:peserta_didik')->group(function () {
    //Peserta Didik
    Route::resource('/pembayaran-peserta-didik', PembayaranPesertaDidikController::class);
});