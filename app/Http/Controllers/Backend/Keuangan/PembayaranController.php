<?php

namespace App\Http\Controllers\Backend\Keuangan;

use DataTables;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use App\Models\PesertaDidik;
use Illuminate\Http\Request;
use App\Models\JenisTransaksi;
use App\Models\RombonganBelajar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Transaksi::leftjoin('peserta_didiks', 'transaksis.student_id', '=', 'peserta_didiks.id')->select('transaksis.id', 'peserta_didiks.name', 'transaksis.*', 'transaksis.created_at')->latest()->get();
            // dd($data);

            return datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('peserta_didiks.name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['peserta_didiks.name'], $request->get('peserta_didiks.name')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                            if (Str::contains(Str::lower($row['transaction_type']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['transaction_order']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['  name']), Str::lower($request->get('search')))) {
                                return true;
                            }

                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    $dropBtn = '<div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href=' . route("pembayaran.edit", $row->id) . '><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('pembayaran.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Beneran nih mau di hapus ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                    $btn = $dropBtn;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

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

        $this->validate($request, [
            'account_id'        => 'required',
            'school_id'         => 'required',
            'study_group_id'    => 'required',
            'class_id'          => 'required',
            'student_id'        => 'required',
            'transaction_date'  => 'required',
            'transaction_order' => 'required',
            'transaction_type'  => 'required',
            'transaction_month' => 'required',
            'transaction_year'  => 'required',
            'transaction_fee'   => 'required',
            'transaction_total' => 'required',
            'transaction_via'   => 'required',
            'transfer_evidence' => 'required',
            'information'       => 'required',
        ]);

        $dataJT = $request->transaction_type;
        $dataBT = $request->transaction_month;
        $dataBiT = $request->transaction_fee;
        $total = count($dataJT);
        $tahunTrans = date('Y');

        // $successCount = 0;

        if ($request->file("transfer_evidence") == "") {
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
                    'transfer_evidence' => "Tidak Melalui Transfer",
                    'information'       => $request->information
                ]);
            }
        } else {
            $buktiTransfer = $request->file('transfer_evidence');
            $buktiTransfer->storeAs('public/transfer_evidence', $buktiTransfer->hashName());

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
                    'transfer_evidence' => $buktiTransfer->hashName(),
                    'information'       => $request->information
                ]);
            }
        }

        if ($pembayarans) {
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
        $pembayarans = Transaksi::find($id);
        $getSiswa = PesertaDidik::all();
        $getJenisTransaksi = JenisTransaksi::all();
        $getRombel = RombonganBelajar::all();
        $kelasOptions = [
            '- Pilih Kelas -',
            'TK A',
            'TK B1',
            'TK B2',
            '1A',
            '1B',
            '2A',
            '2B',
            '3',
            '4A',
            '4B',
            '5A',
            '5B',
            '6A',
            '6B'
        ];
        return view('backend.senada.keuangan.pembayaran.edit', compact('pembayarans', 'getSiswa', 'getJenisTransaksi', 'getRombel', 'kelasOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request, [
            'account_id'        => 'required',
            'school_id'         => 'required',
            'study_group_id'    => 'required',
            'class_id'          => 'required',
            'student_id'        => 'required',
            'transaction_date'  => 'required',
            'transaction_order' => 'required',
            'transaction_type'  => 'required',
            'transaction_month' => 'required',
            'transaction_year'  => 'required',
            'transaction_fee'   => 'required',
            'transaction_total' => 'required',
            'transaction_via'   => 'required',
            'transfer_evidence' => 'required',
            'information'       => 'required',
        ]);
        
        $pembayarans = Transaksi::findOrFail($id);

        $pembayarans->update([
            'account_id'        => $request->account_id,
            'school_id'         => $request->school_id,
            'study_group_id'    => $request->study_group_id,
            'class_id'          => $request->class_id,
            'student_id'        => $request->student_id,
            'transaction_date'  => $request->transaction_date,
            'transaction_order' => $request->transaction_order,
            'transaction_type'  => $request->transaction_type,
            'transaction_month' => $request->transaction_month,
            'transaction_year'  => $request->transaction_year,
            'transaction_fee'   => $request->transaction_fee,
            'transaction_total' => $request->transaction_total,
            'transaction_via'   => $request->transaction_via,
            'transfer_evidence' => "Dummy",
            'information'       => $request->information
        ]);

        if ($pembayarans) {
            //redirect dengan pesan sukses
            return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('pembayaran.edit')->with(['error' => 'Data Gagal Diubah!']);
        }
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
