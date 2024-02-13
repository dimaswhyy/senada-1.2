@extends('backend.senada.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Transaksi / Pembayaran /</span> Tambah Pembayaran
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Pembayaran</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('pembayaran.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input name="transaction_order" class="form-control" id="transaction_order" readonly hidden>
                        <input name="account_id" class="form-control" id="account_id" value="1" readonly hidden>
                        <input name="information" class="form-control" id="information" value="Disetujui" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="school_id">Sekolah</label>
                            <select name="school_id" class="form-control" id="school_id">
                                <option>- Pilih Sekolah -</option>
                                <option value="1">TK</option>
                                <option value="2">SD</option>
                            </select>
                            @error('school_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="study_group_id">Rombongan Belajar</label>
                            <select name="study_group_id" class="form-control" id="study_group_id">
                                {{-- onclick="getKelas();getJenisTransactionSelected();" Nanti Bakal Di Pake --}}
                                <option>- Pilih Rombongan Belajar -</option>
                                @foreach ($getRombel as $item)
                                    <option value="{{ $item->id }}">{{ $item->study_group }}</option>
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
                            <select name="class_id" class="form-control" id="class_id">
                                <option>- Pilih Kelas -</option>
                                <option>1A</option>
                                <option>1B</option>
                                <option>2A</option>
                                <option>2B</option>
                                <option>3</option>
                                <option>4A</option>
                                <option>4B</option>
                                <option>5A</option>
                                <option>5B</option>
                                <option>6A</option>
                                <option>6B</option>
                            </select>
                            @error('class_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="student_id">Siswa</label>
                            <select name="student_id" class="select2 form-select form-select-lg" id="student_id">
                                
                            </select>
                            @error('student_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_date">Tanggal Transaksi</label>
                            <input name="transaction_date" class="form-control" type="date" value="1999-11-17"
                                id="transaction_date" />
                            @error('transaction_date')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Repeater Form --}}
                        <hr class="my-5">
                        <div class="row">
                            <div class="form-group reapeat-pay-table">
                                <table class="table table-bordered table-responsive repeat-form-pay" id="dynamicAddRemove">
                                    <thead>
                                        <tr>
                                            <th>Jenis Transaksi</th>
                                            <th>Bulan</th>
                                            <th>Biaya</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Otomatis Tambah Tabel --}}
                                    </tbody>
                                </table>
                                <div class="mt-2 align-right">
                                    <a href="javascript:void(0)"
                                        class="btn rounded-pill btn-sm btn-success addRow">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        {{-- End Repeat Pay Form --}}

                        <div class="form-group mb-3">
                            <label for="transaction_total">Total</label>
                            <input name="transaction_total" class="form-control" id="transaction_total" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="transaction_via">Jenis Pembayaran</label>
                            <select name="transaction_via" class="form-control" id="transaction_via">
                                <option>- Pilih -</option>
                                <option>Tunai</option>
                                <option>Transfer</option>
                            </select>
                            @error('transaction_via')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Upload Bukti Transfer</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('transfer_evidance') is-invalid @enderror"
                                    name="transfer_evidance">
                                @error('transfer_evidance')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan Sekarang</button>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-light">Nanti Aja</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('jsAddmultiple')
    <script type="text/javascript">
        var i = 0;
        $(".addRow").click(function() {
            ++i;

            fileinput = "<tr>" +
                "<td>" +
                "<div class='form-group mb-3'>" +
                "<select name='transaction_type[" + i + "]' class='form-control' id='transaction_type_" + i +
                "' onclick='getValuesNumber(" + i + "); sumBiaya();' onchange='sumBiaya();'>" +
                "<option>- Pilih Jenis Transaksi -</option>" +
                "@foreach ($getJenisTransaksi as $item)" +
                "<option value='{{ $item->id }}'>{{ $item->transaction_type }}</option>" +
                "@endforeach" +
                "</select>" +
                "@error('transaction_type')" +
                "<div class='alert alert-danger mt-2'>" +
                "{{ $message }}" +
                "</div>" +
                "@enderror" +
                "</div>" +
                "</td>" +
                "<td>" +
                "<div class='form-group mb-3'>" +
                "<select name='transaction_month[" + i + "]' class='form-control' id='transaction_month'>" +
                "<option>- Pilih Bulan -</option>" +
                "<option value='1'>Januari</option>" +
                "<option value='2'>Februari</option>" +
                "<option value='3'>Maret</option>" +
                "<option value='4'>April</option>" +
                "<option value='5'>Mei</option>" +
                "<option value='6'>Juni</option>" +
                "<option value='7'>Juli</option>" +
                "<option value='8'>Agustus</option>" +
                "<option value='9'>September</option>" +
                "<option value='10'>Oktober</option>" +
                "<option value='11'>November</option>" +
                "<option value='12'>Desember</option>" +
                "</select>" +
                "@error('transaction_month')" +
                "<div class='alert alert-danger mt-2'>" +
                "{{ $message }}" +
                "</div>" +
                "@enderror" +
                "</div>" +
                "</td>" +
                "<td><input name='transaction_fees[" + i + "]' class='form-control' id='transaction_fees_" + i +
                "'></td>" +
                "<th><a href='javascript:void(0)' class='btn rounded-pill btn-sm btn-danger remove-input-field'>-</a></th>" +
                "</tr>"
            $("#dynamicAddRemove").append(
                fileinput);
            getJenisTransactionButton();

        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });


        function getSelectedOptionAttribute(select, attribute) {
            var selectedOption = select.options[select.selectedIndex];
            return selectedOption.getAttribute(attribute);
        }

        function getValuesNumber(id) {
            var awal = '#transaction_type_' + id;
            // // console.log(id);
            // // console.log(awal);
            // // console.log($(awal+' option:selected').val());
            // // console.log($(awal+' option:selected').text());
            dataPrice = $(awal + ' option:selected').attr("data-price-" + id);
            //     var select = document.getElementById(awal);
            //   var dataPrice = getSelectedOptionAttribute(select, "data-price-"+id);
            $('#transaction_fees_' + id).val(dataPrice);
        }

        function sumBiaya() {
            sumtotal = 0;
            cek = 0;
            // console.log(i);
            for (let a = 0; a <= i; a++) {
                // console.log($('#biaya_'+i).val());
                cek = 0;
                // console.log("log"+a+"= "+$('#biaya_'+a).val())
                if ($('#transaction_fees_' + a).val() !== undefined) {
                    console.log("tidak undefined")
                    cek = parseInt($('#transaction_fees_' + a).val());
                }
                sumtotal += cek;

            }
            // console.log(sumtotal);
            $('#transaction_total').val(sumtotal);
        }

        function minBiaya() {

        }

        function getJenisTransactionSelected() {
            console.log("Jalan");
            var nilaiId = '';
            nilaiId = $('#study_group_id option:selected').val();
            console.log(i);
            $.ajax({
                url: '/api/jenis/byIdRombel/' + nilaiId,
                type: 'GET',
                success: function(response) {
                    // Parsing data from the API response
                    var data = (response);
                    //   console.log(data)
                    for (var ilangOption = 0; ilangOption <= i; ilangOption++) {
                        $('#transaction_type_' + ilangOption).empty();
                        $('#transaction_type_' + ilangOption).append(
                            '<option value="">-- Pilih Kelas --</option>');
                    }
                    // Iterating through the data and creating an option element for each item
                    for (var nilaiawal = 0; nilaiawal <= i; nilaiawal++) {
                        // console.log("JALAN LOOP")
                        for (var awal = 0; awal < data.length; awal++) {
                            var item = data[awal];
                            var option = document.createElement('option');
                            option.value = item["transaction_type"];
                            option.text = item["transaction_type"];
                            option.setAttribute("data-price-" + i, item["transaction_fees"]);
                            // console.log("JALAN DATA");
                            $('#transaction_type_' + nilaiawal).append(option);
                        }
                    }
                }
            });
        }

        function getJenisTransactionButton() {
            console.log("Jalan Button");
            var nilaiId = '';
            nilaiId = $('#study_group_id option:selected').val();
            console.log(i);
            $.ajax({
                url: '/api/jenis/byIdRombel/' + nilaiId,
                type: 'GET',
                success: function(response) {
                    $('#transaction_type_' + i).empty();
                    $('#transaction_type_' + i).append('<option value="">- Pilih Jenis Transaksi -</option>');


                    var data = (response);
                    for (var awal = 0; awal < data.length; awal++) {
                        var item = data[awal];
                        var option = document.createElement('option');
                        option.value = item["transaction_type"];
                        option.text = item["transaction_type"];
                        option.setAttribute("data-price-" + i, item["transaction_fees"]);
                        $('#transaction_type_' + i).append(option);

                    }
                }
            });
        }

        // Perbarui fungsi subtractBiaya()
        function subtractBiaya(id) {
            var cek = 0;
            if ($('#transaction_fees_' + id).val() !== undefined) {
                cek = parseInt($('#transaction_fees_' + id).val());
            }
            // Perbarui variabel sumtotal dengan pengurangan nilai biaya pada baris ke-id
            sumtotal -= cek;
            // Perbarui nilai total pada input 'transaction_total' dengan nilai sumtotal yang baru
            $('#transaction_total').val(sumtotal);
        }

        // Perbarui fungsi remove-input-field() untuk memanggil subtractBiaya() dan ambil indeks baris dengan index()
        $(document).on('click', '.remove-input-field', function() {
            var id = $(this).closest('tr').index();
            subtractBiaya(id);
            $(this).parents('tr').remove();
        });


        


        // Nanti Bakal di Pake
        // function getKelas() {
        // // console.log("Jalan");
        // var nilaiId ='';
        // nilaiId = $('#id_rombel option:selected').val();

        // $.ajax({
        // url: '/api/kelas/byIdRombel/'+nilaiId,
        // type: 'GET',
        // success: function(response) {
        // $('#dropdownKelas').empty();
        // $('#dropdownKelas').append('<option value="">- Pilih Kelas -</option>');
        // // Parsing data from the API response
        // var data = (response);
        // console.log(data)
        // // Iterating through the data and creating an option element for each item
        // for (var i = 0; i < data.length; i++) { // var item=data[i]; // var option=document.createElement('option'); //
        // option.value = item[
        // "id"]; // option.text=item["kelas"]; // $('#dropdownKelas').append(option); // } // } // }); // }
        // Nanti Bakal di Pake // function getSiswa() { // console.log("Jalan"); // var nilaiId =''; //
        // nilaiId = $('#dropdownKelas option:selected').val(); // $.ajax({ // url: '/api/siswa/byIdRombel/' +nilaiId, //
        // type: 'GET', // success: function(response) { // $('#dropdownSiswa').empty(); //
            // $('#dropdownSiswa').append('<option value="">- Pilih Siswa -</option>');
        // // Parsing data from the API response
        // var data = (response);
        // console.log(data)
        // // Iterating through the data and creating an option element for each item
        // for (var i = 0; i < data.length; i++) { // var item=data[i]; // var option=document.createElement('option'); //
        // option.value = item["id_siswa"]; // option.text=item["name"]; // $('#dropdownSiswa').append(option); // } // } //
        // }); // } 
    </script>
@endpush
