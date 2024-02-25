<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/backend/img/logo/logo.png') }}" width="40" height="40" alt="">
            </span>
            <span class="app-brand-text demo menu-text text-uppercase fw-bolder ms-2">Senada</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        {{-- Super Admin --}}
        @if (Str::length(Auth::guard('account_super_admin')->user()) > 0)
            @if (Auth::guard('account_super_admin')->user()->role_id == 1)
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Super Admin</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-data"></i>
                        <div data-i18n="Account Settings">Kelola</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('akun-sekolah') ? 'active' : '' }}">
                            <a href="{{ route('akun-sekolah.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Akun Sekolah</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        {{-- Tata Usaha --}}
        @php
            $isCheck = false; // Inisialisasi variabel $isCheck di luar blok if-elseif
            if (Str::length(Auth::guard('account_sekolah')->user()) > 0) {
                $isRole = Auth::guard('account_sekolah')->user()->role_id == 3;
                $isCheck = true; // Atur $isCheck ke true jika akun sekolah ditemukan
            } elseif (Str::length(Auth::guard('account_super_admin')->user()) > 0) {
                $isRole = Auth::guard('account_super_admin')->user()->role_id == 1;
                $isCheck = true; // Atur $isCheck ke true jika akun super admin ditemukan
            }
        @endphp
        @if ($isCheck)
            @if ($isRole)
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Tata Usaha</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-data"></i>
                        <div data-i18n="Account Settings">Kelola</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('data-peserta-didik') ? 'active' : '' }}">
                            <a href="{{ route('data-peserta-didik.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Data Peserta Didik</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('rombongan-belajar') ? 'active' : '' }}">
                            <a href="{{ route('rombongan-belajar.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Rombongan Belajar</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        {{-- Keuangan --}}
        @php
            $isCheck = false; // Inisialisasi variabel $isCheck di luar blok if-elseif
            if (Str::length(Auth::guard('account_sekolah')->user()) > 0) {
                $isRole = Auth::guard('account_sekolah')->user()->role_id == 4;
                $isCheck = true; // Atur $isCheck ke true jika akun sekolah ditemukan
            } elseif (Str::length(Auth::guard('account_super_admin')->user()) > 0) {
                $isRole = Auth::guard('account_super_admin')->user()->role_id == 1;
                $isCheck = true; // Atur $isCheck ke true jika akun super admin ditemukan
            }
        @endphp
        @if ($isCheck)
            @if ($isRole)
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Keuangan</span>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                        <div data-i18n="Account Settings">Transaksi</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('jenis-transaksi') ? 'active' : '' }}">
                            <a href="{{ route('jenis-transaksi.index') }}" class="menu-link">
                                <div data-i18n="Account">Jenis Transaksi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('pembayaran') ? 'active' : '' }}">
                            <a href="{{ route('pembayaran.index') }}" class="menu-link">
                                <div data-i18n="Account">Pembayaran</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ Request::is('laporan') ? 'active' : '' }}">
                    <a href="{{ route('laporan.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-report"></i>
                        <div data-i18n="Analytics">Laporan</div>
                    </a>
                </li>
            @endif
        @endif

        <!-- Siswa -->
        @if (Str::length(Auth::guard('peserta_didik')->user()) > 0)
            @if (Auth::guard('peserta_didik')->user()->role_id == 6)
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Peserta Didik</span></li>
                <!-- Profil -->
                {{-- <li class="menu-item">
                    <a href="cards-basic.html" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Basic">Profil</div>
                    </a>
                </li> --}}
                <!-- Pembayaran -->
                <li class="menu-item {{ Request::is('laporan') ? 'active' : '' }}">
                    <a href="{{ route('pembayaran-peserta-didik.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
                        <div data-i18n="Basic">Pembayaran</div>
                    </a>
                </li>
            @endif
        @endif
    </ul>
</aside>
