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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@stack('jsAddmultiple')

@stack('jsAPIData')

@stack('jsPopUpCetak')

    {{-- <script>

        $(function() {
            var table = $('.repeat-form-pay').document{
                $('thead').on('click', '.addRow', function(){
            var tr = "<tr>"+
                        "<td>"+
                            "<div class='form-group mb-3'>"+
                                "<select name='jenis_transaksi' class='form-control' id='jenis_transaksi'>"+
                                    "<option>- Pilih Jenis Transaksi -</option>"+
                                    "@foreach ($getJenis as $item)"+
                                    "<option>{{ $item->jenis_transaksi }}</option>"+
                                    "@endforeach"+
                                "</select>"+
                                "@error('jenis_transaksi')"+
                                "<div class='alert alert-danger mt-2'>"+
                                "{{ $message }}"+
                                "</div>"+
                                "@enderror"+
                            "</div>"+
                        "</td>"+
                        "<td>"+
                            "<div class='form-group mb-3'>"+
                                "<select name='transaksi_bulan' class='form-control' id='transaksi_bulan'>"+
                                    "<option>- Pilih Bulan -</option>"+
                                    "<option value='1'>Januari</option>"+
                                    "<option value='2'>Februari</option>"+
                                    "<option value='3'>Maret</option>"+
                                    "<option value='4'>April</option>"+
                                    "<option value='5'>Mei</option>"+
                                    "<option value='6'>Juni</option>"+
                                    "<option value='7'>Juli</option>"+
                                    "<option value='8'>Agustus</option>"+
                                    "<option value='9'>September</option>"+
                                    "<option value='10'>Oktober</option>"+
                                    "<option value='11'>November</option>"+
                                    "<option value='12'>Desember</option>"+
                                "</select>"+
                                "@error('transaksi_bulan')"+
                                    "<div class='alert alert-danger mt-2'>"+
                                    "{{ $message }}"+
                                    "</div>"+
                                "@enderror"+
                            "</div>"+
                        "</td>"+
                        "<td><input name='biaya' class='form-control' id='biaya' readonly></td>"+
                        "<th><a href='javascript:void(0)' class='btn btn-sm btn-danger deleteRow'>-</a></th>"+
                    "</tr>"

            $('tbody').append(tr);
        });
            }
        }):

    </script> --}}

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
                      data: 'study_group_id',
                      name: 'study_group_id'
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



        });
    </script>

    
    
    {{-- @include('sweetalert::alert') --}}
  </body>
</html>
