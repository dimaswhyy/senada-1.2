<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use App\Models\PesertaDidik;
use App\Models\RombonganBelajar;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view('backend.senada.keuangan.pembayaran.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $getSiswa = PesertaDidik::all();
        $getJenisTransaksi = JenisTransaksi::all();
        $getRombel = RombonganBelajar::all();
        return view('backend.senada.keuangan.pembayaran.add', compact('getSiswa', 'getRombel', 'getJenisTransaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        date_default_timezone_set('Asia/Jakarta');

        $idSchool = $request->school_id;
        $nameSCH = ($idSchool == '1') ? 'TK' : 'SD';

        // $no = 0000;
        // $pembayaran = Transaksi::where('school_id', $idSchool)->max('transaction_order');
        // if($pembayaran){
        //     $nourut = substr($pembayaran,3,10) + 1;
        //     $no_urut_str = substr($nourut,3,4);
        //     $no_urut = $nameSCH . "-" . $no_urut_str;
        //     $hasil = $no_urut;
        // }else{
        //     $nourut = $nameSCH . "-" . 0000001;
        //     $hasil = $nourut;
        // }
        // $notransaksi = $hasil;

        $pembayaran = Transaksi::where('school_id', $idSchool)->max('transaction_order');

        // Jika sudah ada nomor urut sebelumnya
        if ($pembayaran) {
            // Pisahkan bagian non-numerik (misalnya, 'SD-') dari bagian numerik
            $parts = explode('-', $pembayaran);
            $numericPart = intval($parts[1]); // Ubah bagian numerik menjadi integer
            $numericPart++; // Tambah 1 ke nomor urut

            // Format kembali nomor urut menjadi string dengan panjang yang sama
            $newNumericPart = str_pad($numericPart, strlen($parts[1]), '0', STR_PAD_LEFT);

            // Gabungkan kembali bagian non-numerik dan bagian numerik yang baru
            $hasil = $parts[0] . '-' . $newNumericPart;
        } else {
            // Jika belum ada nomor urut sebelumnya, mulai dengan nomor urut 1
            $hasil = $nameSCH . '-0000001';
        }

        $notransaksi = $hasil;

        $dataJT = $request->transaction_type;
        $dataBT = $request->transaction_month;
        $dataBiT = $request->transaction_fee;
        $total = count($dataJT);
        $tahunTrans = date('Y');

        $successCount = 0;

        for ($i = 1; $i <= $total; $i++) {
            $pembayarans = Transaksi::create([
                'id'                => Str::uuid(),
                'account_id'        => $request->account_id,
                'school_id'         => $request->school_id,
                'study_group_id'    => $request->study_group_id,
                'class_id'          => $request->class_id,
                'student_id'        => $request->student_id,
                'transaction_date'  => $request->transaction_date,
                'transaction_order' => $notransaksi,
                'transaction_type'  => $dataJT[$i],
                'transaction_month' => $dataBT[$i],
                'transaction_year'  => $tahunTrans,
                'transaction_fee'   => $dataBiT[$i],
                'transaction_total' => $request->transaction_total,
                'transaction_via'   => $request->transaction_via,
                'transfer_evidence' => "Dummy",
                'information'       => $request->information
            ]);

            if ($pembayarans) {
                $successCount++; // Jika penyimpanan berhasil, tambahkan counter
            }
        }



        if ($successCount == $total) {
            //redirect dengan pesan sukses
            return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('pembayaran.add')->with(['error' => 'Data Gagal Disimpan!']);
        }
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

    public function getJenisTransaksiList($id)
    {
        $listJenis = JenisTransaksi::where('study_group_id', $id)->get();
        return response()->json($listJenis);
    }
}
