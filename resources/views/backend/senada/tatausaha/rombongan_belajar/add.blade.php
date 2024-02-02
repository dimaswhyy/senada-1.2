@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Rombongan Belajar /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Rombongan Belajar</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('rombongan-belajar.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="account_id" class="form-control" id="account_id" value="1" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="study_group">Rombongan Belajar <span style="color: red;">*</span></label>
                            <input name="study_group" class="form-control" id="study_group"
                                placeholder="Masukkan Rombongan Belajar">
                            @error('study_group')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan Sekarang</button>
                        <a href="{{route('rombongan-belajar.index')}}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
