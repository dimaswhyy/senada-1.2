@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Data Peserta Didik /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Data Peserta Didik</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('data-peserta-didik.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input name="account_id" class="form-control" id="account_id" value="1" readonly hidden>
                        <input name="information" class="form-control" id="information" value="Aktif" readonly hidden>
                        <input name="role_id" class="form-control" id="role_id" value="6" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="name">Nama Peserta Didik <span style="color: red;">*</span></label>
                            <input name="name" class="form-control" id="name"
                                placeholder="Masukkan Nama Peserta Didik">
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender">Jenis Kelamin <span style="color: red;">*</span></label>
                            <select name="gender" class="form-control" id="gender">
                                <option>- Pilih Jenis Kelamin -</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Masukkan Email">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label for="password">Password <span style="color: red;">*</span></label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan Sekarang</button>
                        <a href="{{route('data-peserta-didik.index')}}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
