@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Transaksi / Jenis Transaksi /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Transaksi</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('jenis-transaksi.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="account_id" class="form-control" id="account_id" value="1" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="study_group_id">Rombongan Belajar</label>
                            <select name="study_group_id" class="form-control" id="study_group_id">
                                <option>- Pilih Rombongan Belajar-</option>
                                @foreach ($getRombel as $item)
                                <option value="{{$item->id}}">{{$item->study_group}}</option>
                                @endforeach
                            </select>
                            @error('study_group_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_type">Jenis Transaksi</label>
                            <input name="transaction_type" class="form-control" id="transaction_type"
                                placeholder="Masukkan Jenis Transaksi">
                            @error('transaction_type')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_fees">Biaya Transaksi</label>
                            <input name="transaction_fees" class="form-control" id="transaction_fees"
                                placeholder="Masukkan Biaya Transaksi">
                            @error('transaction_fees')
                                <div class="alert alert-danger mt-2">   
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan Sekarang</button>
                        <a href="{{route('jenis-transaksi.index')}}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
