<?php

namespace App\Http\Controllers\Backend\PesertaDidik;

use Yajra\DataTables\DataTables;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranPesertaDidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Transaksi::where('student_id','=',Auth::User()->id)->leftjoin('peserta_didiks', 'transaksis.student_id', '=', 'peserta_didiks.id')->select('transaksis.id', 'peserta_didiks.name', 'transaksis.*', 'transaksis.created_at')->latest()->get();
            // dd($data);

            return datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('transaction_order'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['transaction_order'], $request->get('transaction_order')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                            if (Str::contains(Str::lower($row['transaction_type']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['transaction_order']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href=' . route("pembayaran-peserta-didik.edit", $row->id) . '><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <a href='.route("pembayaran-peserta-didik.destroy", $row->id).' class="dropdown-item" data-confirm-delete="true"><i class="bx bx-trash me-1"></i> Hapus</a>
                        </div>
                        </div>';
                    $btn = $dropBtn;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $title = 'Hapus';
        $text = "Yakin ingin dihapus ?";
        confirmDelete($title, $text);

        // <a class="dropdown-item" href='.route("pembayaran-peserta-didik.invoice", $row->transaction_order).'><i class="bx bx-printer me-1"></i> Cetak</a>
        return view('backend.senada.pesertadidik.pembayaran_peserta_didik.list');
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
