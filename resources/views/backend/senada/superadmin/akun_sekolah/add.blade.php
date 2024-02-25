@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Akun Sekolah /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Akun Sekolah</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('akun-sekolah.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap <span style="color: red;">*</span></label>
                            <input name="name" class="form-control" id="name"
                                placeholder="Masukkan Nama Lengkap">
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
                            <label for="role_id">Penugasan <span style="color: red;">*</span></label>
                            <select name="role_id" class="form-control" id="role_id">
                                <option>- Pilih Penugasan -</option>
                                <option value="3">Tata Usaha</option>
                                <option value="4">Keuangan</option>
                                {{-- <option value="5">Guru</option>
                                <option value="6">Peserta Didik</option> --}}
                            </select>
                            @error('role_id')
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
                        <a href="{{ route('jenis-transaksi.index') }}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
