@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard/ Transaksi / Pembayaran /</span> Ubah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Ubah Pembayaran</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('pembayaran.update', $pembayarans->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input name="account_id" class="form-control" id="account_id"
                            value="{{ old('account_id', $pembayarans->account_id) }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="transaction_order">Nomor Transaksi</label>
                            <input name="transaction_order" class="form-control" id="transaction_order"
                                value="{{ old('transaction_order', $pembayarans->transaction_order) }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="school_id">Sekolah</label>
                            <select name="school_id" class="form-control" id="school_id" readonly>
                                @if ($pembayarans->school_id == '')
                                    <option>- Pilih -</option>
                                    <option value="1">TK</option>
                                    <option value="2">SD</option>
                                @elseif ($pembayarans->school_id == '1')
                                    <option value="1">TK</option>
                                    <option value="2">SD</option>
                                @else
                                    <option value="2">SD</option>
                                    <option value="1">TK</option>
                                @endif
                            </select>
                            @error('school_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="study_group_id">Rombongan Belajar</label>
                            <select name="study_group_id" class="form-control" id="study_group_id" readonly>
                                @foreach ($getRombel as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pembayarans->study_group_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->study_group }}</option>
                                @endforeach
                            </select>
                            @error('study_group_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="class_id">Kelas</label>
                            <select name="class_id" class="form-control" id="class_id" readonly>
                                <option>- Pilih Kelas -</option>
                                @foreach ($kelasOptions as $kelasOption)
                                    <option value="{{ $kelasOption }}"
                                        {{ $kelasOption == old('class_id', $pembayarans->class_id) ? 'selected' : '' }}>
                                        {{ $kelasOption }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="student_id">Siswa</label>
                            <select name="student_id" class="form-select form-select-lg" id="student_id" readonly>
                                @foreach ($getSiswa as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pembayarans->student_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_date">Tanggal Transaksi</label>
                            <input name="transaction_date" class="form-control" type="date"
                                value="{{ old('transaction_type', $pembayarans->transaction_date) }}" id="transaction_date"
                                readonly />
                            @error('transaction_date')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_type">Jenis Transaksi</label>
                            <input name="transaction_type" class="form-control" id="transaction_type"
                                placeholder="Masukkan Jenis Transaksi"
                                value="{{ old('transaction_type', $pembayarans->transaction_type) }}" readonly>
                            @error('transaction_type')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_month">Jenis Transaksi</label>
                            <input name="transaction_month" class="form-control" id="transaction_month"
                                placeholder="Masukkan Jenis Transaksi"
                                value="{{ old('transaction_month', $pembayarans->transaction_month) }}" readonly>
                            @error('transaction_month')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_fee">Biaya Transaksi</label>
                            <input name="transaction_fee" class="form-control" id="transaction_fee"
                                placeholder="Masukkan Biaya Transaksi"
                                value="{{ old('transaction_fee', $pembayarans->transaction_fee) }}" readonly>
                            @error('transaction_fee')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_total">Total</label>
                            <input name="transaction_total" class="form-control" id="transaction_total"
                                value="{{ old('transaction_total', $pembayarans->transaction_total) }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_via">Jenis Pembayaran</label>
                            <input name="transaction_via" class="form-control" id="transaction_via"
                                value="{{ old('transaction_via', $pembayarans->transaction_via) }}" readonly>
                            @error('transaction_via')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Upload Bukti Transfer</label>
                            <div class="input-group col-xs-12">
                                <input type="file"
                                    class="form-control @error('transfer_evidance') is-invalid @enderror"
                                    name="transfer_evidance">
                                @error('transfer_evidance')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="Information">Keterangan</label>
                            <select name="Information" class="form-control" id="Information">
                                @if ($pembayarans->information == '')
                                    <option>- Pilih -</option>
                                    <option>Disetujui</option>
                                    <option>Dalam Antrian</option>
                                    <option>Tidak Disetujui</option>
                                @elseif ($pembayarans->information == 'Disetujui')
                                    <option>Disetujui</option>
                                    <option>Dalam Antrian</option>
                                    <option>Tidak Disetujui</option>
                                @elseif ($pembayarans->information == 'Dalam Antrian')
                                    <option>Dalam Antrian</option>
                                    <option>Tidak Disetujui</option>
                                    <option>Disetujui</option>
                                @else
                                    <option>Tidak Disetujui</option>
                                    <option>Dalam Antrian</option>
                                    <option>Disetujui</option>
                                @endif
                            </select>
                            @error('Information')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Perbaharui Sekarang</button>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
