@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola /</span> Data Peserta Didik
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Data Peserta Didik</h5>

            <a href="{{ route('data-peserta-didik.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-peserta-didik">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
