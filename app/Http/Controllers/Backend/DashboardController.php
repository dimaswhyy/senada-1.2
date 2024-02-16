<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        // Hitung Total Penerimaan Masih Belum Berdasarkan transaction_order yang tidak sama
        $totalPenerimaan = Transaksi::whereDate('transaction_date', $today)
            ->select(Transaksi::raw('SUM(transaction_total) as total'))
            ->groupBy('transaction_order')
            ->pluck('total')
            ->sum();

        // Hitung Total Keuangan Masih Belum Berdasarkan transaction_order yang tidak sama
        $totalKeuangan = Transaksi::selectRaw('SUM(transaction_total) as total')->sum('transaction_total');

        // Menghitung jumlah transaksi per order berdasarkan tanggal hari ini Masih Belum Berdasrakan transaction_order yang tidak sama 
        $jumlahTransaksiPerOrder = Transaksi::whereDate('transaction_date', $today)->count();

        return view('backend.senada.dashboard.index', compact('totalPenerimaan', 'totalKeuangan', 'jumlahTransaksiPerOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
