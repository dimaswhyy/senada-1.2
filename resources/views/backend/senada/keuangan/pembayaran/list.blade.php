@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Transaksi /</span> Pembayaran
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header">
            <h5>Pembayaran</h5>

            <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-primary">Tambah</a>
            <div class="card-datatable table">
                <div class="card-datatable table-responsive text-nowrap">
                    <table class="dt-scrollableTable table data-table-pembayaran">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Transaksi</th>
                                <th>Bulan</th>
                                <th>Melalui</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
