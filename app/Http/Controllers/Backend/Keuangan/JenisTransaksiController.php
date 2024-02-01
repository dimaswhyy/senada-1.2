<?php

namespace App\Http\Controllers\Backend\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class JenisTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = JenisTransaksi::latest()->get();
            // dd($data);

            return datatables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {

                        if (!empty($request->get('transaction_type'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['transaction_type'], $request->get('transaction_type')) ? true : false;
                            });
                        }

                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                                if (Str::contains(Str::lower($row['transaction_type']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['transaction_type']), Str::lower($request->get('search')))) {
                                    return true;
                                }

                                return false;
                            });
                        }

                    })
                    ->addColumn('action', function($row){
                        $dropBtn ='<div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu">
                          
                        </div>
                        </div>
                        <a class="dropdown-item" href='.route("jenis-transaksi.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('jenis-transaksi.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Beneran nih mau di hapus ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>';
                        $btn = $dropBtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.senada.keuangan.jenis_transaksi.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.senada.keuangan.jenis_transaksi.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'account_id'   => 'required',
            'study_group_id' => 'required',
            'transaction_type'     => 'required',
            'transaction_fees'     => 'required'
        ]);

        $jenistransaksis = JenisTransaksi::create([
            'id'    => Str::uuid(),
            'account_id'     => $request->account_id,
            'study_group_id'     => $request->study_group_id,
            'transaction_type'     => $request->transaction_type,
            'transaction_fees'     => $request->transaction_fees
        ]);

        if($jenistransaksis){
            //redirect dengan pesan sukses
            return redirect()->route('jenis-transaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jenis-transaksi.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $jenistransaksis = JenisTransaksi::find($id);
        return view('backend.senada.keuangan.jenis_transaksi.edit', compact('jenistransaksis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $jenistransaksis = JenisTransaksi::findOrFail($id);

        $jenistransaksis->update([
            'account_id'     => $request->account_id,
            'study_group_id' => $request->study_group_id,
            'transaction_type'     => $request->transaction_type,
            'transaction_fees'     => $request->transaction_fees
        ]);

        if($jenistransaksis){
            //redirect dengan pesan sukses
            return redirect()->route('jenis-transaksi.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('jenis-transaksi.edit')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jenistransaksis = JenisTransaksi::findOrFail($id);

        $jenistransaksis->delete();
        if($jenistransaksis){
            //redirect dengan pesan sukses
        return redirect()->route('jenis-transaksi.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
        return redirect()->route('jenis-transaksi.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
