<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AccountSekolah;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AkunSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = AccountSekolah::latest()->get();
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
                          <a class="dropdown-item" href='.route("akun-sekolah.edit", $row->id).'><i class="bx bx-edit-alt me-1"></i> Ubah</a>
                          <a href='.route("akun-sekolah.destroy", $row->id).' class="dropdown-item" data-confirm-delete="true"><i class="bx bx-trash me-1"></i> Hapus</a>
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

        return view('backend.senada.superadmin.akun_sekolah.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.senada.superadmin.akun_sekolah.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'     => 'required',
            'gender'     => 'required',
            'role_id'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
        ]);

        $akunsekolahs = AccountSekolah::create([
            'id'    => Str::uuid(),
            'name'     => $request->name,
            'gender'     => $request->gender,
            'role_id'     => $request->role_id,
            'email'     => $request->email,
            'password'     => Hash::make($request->password),
        ]);

        if ($akunsekolahs) {
            //redirect dengan pesan sukses
            return redirect()->route('akun-sekolah.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('akun-sekolah.add')->with(['error' => 'Data Gagal Disimpan!']);
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
        $akunsekolahs = AccountSekolah::find($id);
        return view('backend.senada.superadmin.akun_sekolah.edit', compact('akunsekolahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $akunsekolahs = AccountSekolah::findOrFail($id);

        $akunsekolahs->update([
            'name'     => $request->name,
            'gender'     => $request->gender,
            'role_id'     => $request->role_id,
            'email'     => $request->email,
            'password'     => Hash::make($request->password)
        ]);

        if ($akunsekolahs) {
            //redirect dengan pesan sukses
            return redirect()->route('akun-sekolah.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('akun-sekolah.edit')->with(['error' => 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $akunsekolahs = AccountSekolah::findorfail($id);
        $akunsekolahs->delete();
        
        if($akunsekolahs){
            //redirect dengan pesan sukses
            return redirect()->route('akun-sekolah.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('akun-sekolah.edit')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
