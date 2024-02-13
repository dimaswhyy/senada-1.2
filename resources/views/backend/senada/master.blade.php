<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SENADA | AL MANAR</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/backend/img/favicon/favicon-1.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    {{-- DataTables --}}
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    <!-- Helpers -->
    <script src="{{ asset('assets/backend/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/backend/js/config.js') }}"></script>

  </head>

  <body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('backend.tools.sidebar')
<
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('backend.tools.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

                @yield('content')

                <!--/ Transactions -->
              </div>
          </div>
            <!-- / Content -->
            
            <!-- Footer -->
            @include('backend.tools.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade">

            </div>
          <!-- Content wrapper -->
        </div>

        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/backend/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/backend/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/backend/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/backend/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/backend/js/dashboards-analytics.js') }}"></script>


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.5/dist/umd/popper.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

@stack('jsAddmultiple')

@stack('jsAPIData')

@stack('jsPopUpCetak')

    {{-- Sctipt Select2 --}}
    {{-- <script src="{{ asset('assets/backend/js/select2.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#student_id').select2({
                ajax: {
                    url: '/api/siswa-search',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true,
                    // Additional function to search based on term
                    data: function(params) {
                        return {
                            term: params.term,
                        };
                    },
                },
                placeholder: '- Pilih Siswa -',
                minimumInputLength: 0
            });
        });
    </script>

    {{-- Script List Data Table --}}
    <script type="text/javascript">
        $(function() {

            // Keuangan List Index
            // Datatable Jenis Transaksi
            var table = $('.data-table-jenis-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('jenis-transaksi.index') }}",
                    data: function(d) {
                        d.name = $('.searchName').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'study_group',
                        name: 'rombongan_belajars.study_group'
                    },
                    {
                        data: 'transaction_type',
                        name: 'transaction_type'
                    },
                    {
                        data: 'transaction_fees',
                        name: 'transaction_fees'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $(".searchName").keyup(function() {
                table.draw();
            });

            // Datatable Pembayaran
            var table = $('.data-table-pembayaran').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pembayaran.index') }}",
                    data: function(d) {
                        d.name = $('.searchName').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'transaction_order',
                        name: 'transaction_order'
                    },
                    {
                        data: 'name',
                        name: 'peserta_didiks.name'
                    },
                    {
                        data: 'class_id',
                        name: 'class_id'
                    },
                    {
                        data: 'transaction_type',
                        name: 'transaction_type'
                    },

                    {
                        data: 'transaction_via',
                        name: 'transaction_via'
                    },
                    {
                        data: 'information',
                        name: 'information',
                        render: function(data, type, row, meta) {
                            if (data == 'Disetujui') {
                                console.log(data);
                                return '<span class="badge bg-label-success me-1">Disetujui</span>';
                            } else if (data == 'Dalam Antrian') {
                                return '<span class="badge bg-label-warning me-1">Dalam Antrian</span>';
                            } else {
                                return '<span class="badge bg-label-danger me-1">Ditolak</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $(".searchName").keyup(function() {
                table.draw();
            });

            // Administrator atau Tata Usaha
            // Datatable Peserta Didik
            var table = $('.data-table-peserta-didik').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('data-peserta-didik.index') }}",
                    data: function(d) {
                        d.name = $('.searchName').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'information',
                        name: 'information',
                        render: function(data, type, row, meta) {
                            if (data == 'Aktif') {
                                console.log(data);
                                return '<span class="badge bg-label-success me-1">Aktif</span>';
                            } else {
                                return '<span class="badge bg-label-danger me-1">Tidak Aktif</span>';
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $(".searchName").keyup(function() {
                table.draw();
            });

            // Datatable Peserta Didik
            var table = $('.data-table-rombongan-belajar').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('rombongan-belajar.index') }}",
                    data: function(d) {
                        d.name = $('.searchName').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'study_group',
                        name: 'study_group'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $(".searchName").keyup(function() {
                table.draw();
            });

        });
    </script>
  
  @include('sweetalert::alert')

  </body>

</html>
