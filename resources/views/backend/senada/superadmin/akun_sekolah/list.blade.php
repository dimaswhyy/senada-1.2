@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola /</span> Akun Sekolah
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Akun Sekolah</h5>

            <a href="{{ route('akun-sekolah.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-akun-sekolah">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
