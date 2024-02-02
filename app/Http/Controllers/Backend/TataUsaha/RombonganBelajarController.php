<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\RombonganBelajar;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RombonganBelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = RombonganBelajar::latest()->get();
            // dd($data);

            return datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('study_group'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['study_group'], $request->get('study_group')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                            if (Str::contains(Str::lower($row['study_group']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['study_group']), Str::lower($request->get('search')))) {
                                return true;
                            }

                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    $dropBtn ='<div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href='.route("rombongan-belajar.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('rombongan-belajar.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" onclick="return confirm(\'Beneran nih mau di hapus ?\')"><i class="bx bx-trash me-1"></i> Hapus</button></form>
                        </div>
                        </div>';
                    $btn = $dropBtn;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.senada.tatausaha.rombongan_belajar.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.senada.tatausaha.rombongan_belajar.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'account_id'   => 'required',
            'study_group' => 'required'

        ]);

        $rombonganbelajars = RombonganBelajar::create([
            'id'    => Str::uuid(),
            'account_id'     => $request->account_id,
            'study_group'     => $request->study_group

        ]);

        if ($rombonganbelajars) {
            //redirect dengan pesan sukses
            return redirect()->route('rombongan-belajar.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('rombongan-belajar.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $rombonganbelajars = RombonganBelajar::find($id);
        return view('backend.senada.tatausaha.rombongan_belajar.edit', compact('rombonganbelajars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rombonganbelajars = RombonganBelajar::findOrFail($id);

        $rombonganbelajars->update([
            'account_id'     => $request->account_id,
            'study_group'     => $request->study_group
        ]);

        if ($rombonganbelajars) {
            //redirect dengan pesan sukses
            return redirect()->route('rombongan-belajar.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('rombongan-belajar.edit')->with(['error' => 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $rombonganbelajars = RombonganBelajar::findorfail($id);
        $rombonganbelajars->delete();
        
        if($rombonganbelajars){
            //redirect dengan pesan sukses
            return redirect()->route('rombongan-belajar.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('rombongan-belajar.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
