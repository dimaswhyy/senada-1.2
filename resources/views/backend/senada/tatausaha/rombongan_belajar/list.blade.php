@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola /</span> Rombongan Belajar
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Rombongan Belajar</h5>

            <a href="{{ route('rombongan-belajar.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-rombongan-belajar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Rombongan Belajar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
