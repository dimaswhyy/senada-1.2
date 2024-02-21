@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Transaksi /</span> Laporan Transaksi
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Laporan Transaksi</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('export.data') }}" method="GET" enctype="multipart/form-data">

                        <div class="form-group mb-3">
                            <label for="start_date">Tanggal Awal</label>
                            <input name="start_date" class="form-control" type="date" value="1999-11-17"
                                id="start_date" />
                            @error('start_date')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="end_date">Tanggal Akhir</label>
                            <input name="end_date" class="form-control" type="date" value="1999-11-17"
                                id="end_date" />
                            @error('end_date')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Unduh Sekarang</button>
                        <a href="{{route('laporan.index')}}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
