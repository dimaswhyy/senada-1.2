@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard/ Transaksi / Jenis Transaksi /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Jenis Transaksi</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('jenis-transaksi.update', $jenistransaksis->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input name="account_id" class="form-control" id="account_id" value="{{ old('account_id', $jenistransaksis->account_id) }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="study_group_id">Rombongan Belajar</label>
                            <select name="study_group_id" class="form-control" id="study_group_id">
                                <option>1A</option>
                                {{-- @foreach ($getRombel as $item)
                                <option value="{{$item->id}}" {{$jenistransaksis->study_group_id == $item->id ? 'selected':''}}>{{$item->rombongan_belajar}}</option>
                                @endforeach --}}
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
                                placeholder="Masukkan Jenis Transaksi" value="{{ old('transaction_type', $jenistransaksis->transaction_type) }}">
                            @error('transaction_type')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_fees">Biaya Transaksi</label>
                            <input name="transaction_fees" class="form-control" id="transaction_fees"
                                placeholder="Masukkan Biaya Transaksi" value="{{ old('transaction_fees', $jenistransaksis->transaction_fees) }}">
                            @error('transaction_fees')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Perbaharui Sekarang</button>
                        <a href="{{route('jenis-transaksi.index')}}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
