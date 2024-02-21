<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Exports\PembayaranExport;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $getJenisTransaksi = Transaksi::all();
        return view('backend.senada.keuangan.laporan.form', compact('getJenisTransaksi'));
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

    public function export(Request $request)
    {
        // localhost lu share
        // command lu share
        // dd("test");
        // $transactionType = $request->transaction_type; // Jenis transaksi
        $startDate = $request->start_date; // Tanggal awal
        $endDate = $request->end_date; // Tanggal akhir

        $pembayarans = Transaksi::whereBetween('transaction_date', [$startDate, $endDate])->get();

        // dd($pembayarans);

        return Excel::download(new PembayaranExport($pembayarans), 'data-transaksi.xlsx');
    }
}
