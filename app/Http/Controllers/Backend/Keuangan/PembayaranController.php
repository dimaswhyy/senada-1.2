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
        $nameSCH="";
        if($idSchool == '1'){
            $nameSCH = 'TK';
        }else{
            $nameSCH = 'SD';
        }

        // $no = 0000;
        $pembayaran = Transaksi::where('school_id', $idSchool)->max('transaction_order');
        if($pembayaran){
            $nourut = substr($pembayaran,6,14) + 1;
            $no_urut_str = substr($nourut,6,10);
            $no_urut = $nameSCH . "-" . $no_urut_str;
            $hasil = $no_urut;
        }else{
            $nourut = $nameSCH . "-" . 0001;
            $hasil = $nourut;
        }
        $notransaksi = $hasil;

        $dataJT = $request->jenis_transaksi;
        $dataBT = $request->transaksi_bulan;
        $dataBiT = $request->biaya;
        $total = count($dataJT);
        $tahunTrans = date('Y');

        for ($i=1; $i<=$total; $i++){
            $pembayarans = Transaksi::create([
                'id'    => Str::uuid(),
                'id_unit' => $request->id_unit,
                'id_unit_account'     => $request->id_unit_account,
                'id_rombel' => $request->id_rombel,
                'id_kelas' => $request->id_kelas,
                'id_siswa' => $request->id_siswa,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'no_transaksi' => $notransaksi,
                'jenis_transaksi' => $dataJT[$i],
                'bulan_transaksi' => $dataBT[$i],
                'tahun_transaksi' => $tahunTrans,
                'biaya_transaksi' => $dataBiT[$i],
                'total_transaksi' => $request->total,
                'keterangan' => $request->keterangan,
                'bukti_transfer'     => null
            ]);
            // dd($pembayarans);
        }

        if($pembayarans){
            //redirect dengan pesan sukses
            return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!']);

        }else{
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
        $listJenis = JenisTransaksi::where('study_group_id',$id)->get();
        return response()->json($listJenis);
    }
}
