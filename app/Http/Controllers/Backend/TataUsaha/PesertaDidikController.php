<?php

namespace App\Http\Controllers\Backend\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\PesertaDidik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PesertaDidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = PesertaDidik::latest()->get();
            // dd($data);

            return datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['name'], $request->get('name')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {


                            if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))) {
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
                          <a class="dropdown-item" href='.route("data-peserta-didik.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <form action="' . route('data-peserta-didik.destroy', $row->id) . '" method="POST">' . csrf_field() . method_field("DELETE") . '<button type="submit" class="btn btn-light" data-confirm-delete="true"><i class="bx bx-trash me-1"></i> Hapus</button></form>
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
        return view('backend.senada.tatausaha.peserta_didik.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.senada.tatausaha.peserta_didik.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'account_id'   => 'required',
            'name' => 'required',
            'gender' => 'required',
            'email'     => 'required',
            'password'     => 'required',
            'role_id'   => 'required',
            'information'   => 'required'

        ]);

        $pesertadidiks = PesertaDidik::create([
            'id'    => Str::uuid(),
            'account_id'     => $request->account_id,
            'name'     => $request->name,
            'gender'     => $request->gender,
            'email'     => $request->email,
            'password'     => Hash::make($request->password),
            'role_id'     => $request->role_id,
            'information'     => $request->information

        ]);

        if ($pesertadidiks) {
            //redirect dengan pesan sukses
            return redirect()->route('data-peserta-didik.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('data-peserta-didik.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $pesertadidiks = PesertaDidik::find($id);
        return view('backend.senada.tatausaha.peserta_didik.edit', compact('pesertadidiks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pesertadidiks = PesertaDidik::findOrFail($id);

        $pesertadidiks->update([
            'account_id'     => $request->account_id,
            'name'     => $request->name,
            'gender'     => $request->gender,
            'email'     => $request->email,
            'password'     => Hash::make($request->password),
            'role_id'     => $request->role_id,
            'information'     => $request->information
        ]);

        if ($pesertadidiks) {
            //redirect dengan pesan sukses
            return redirect()->route('data-peserta-didik.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('data-peserta-didik.edit')->with(['error' => 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pesertadidiks = PesertaDidik::findorfail($id);
        $pesertadidiks->delete();
        
        if($pesertadidiks){
            //redirect dengan pesan sukses
            return redirect()->route('data-peserta-didik.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('data-peserta-didik.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
