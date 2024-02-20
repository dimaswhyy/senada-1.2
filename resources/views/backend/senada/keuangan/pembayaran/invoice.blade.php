<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <section class="main-pd-wrapper" style="width: 1000px; margin: auto">
        <div style="display: table-header-group">
            <h4 style="text-align: center; margin: 0">
                <b>Bukti Pembayaran</b>
            </h4>

            <table style="width: 100%; table-layout: fixed">
                <tr>
                    <td style="border-left: 1px solid #ddd; border-right: 1px solid #ddd">
                        <div
                            style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                ">
                            <svg width="220" height="10" viewBox="0 0 272 73" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <center><img src="{{ asset('assets/backend/img/logo/LA.png') }}" width="70"
                                        alt=""></center>

                            </svg>

                            <p style="font-weight: reguler; margin-top: 5px; font-size: 10px">
                                Jl. Pondok Kelapa Selatan, No. 26, RT 009 / RW 012
                            </p>
                            <p style="font-weight: reguler; font-size: 10px">
                                Kel. Pondok Kelapa, Kec. Duren Sawit, Jakarta Timur
                            </p>
                            <p style="font-weight: reguler; font-size: 10px">
                                No. Telp : (021) 8690 0906, Website : almanar.sch.id
                            </p>
                        </div>
                    </td>
                    <td align="right"
                        style="
                text-align: right;
                padding-left: 50px;
                line-height: 1.5;
                color: #323232;
              ">
                        <div>
                            <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px">
                                Diberikan kepada :
                            </h4>
                            <p style="font-size: 12px">Nama : <b>{{ $pembayaran[0]->name }}</b>, Kelas :
                                <b>{{ $pembayaran[0]->class_id }}</b>
                            </p>
                            <p style="font-size: 12px">Nomor Transaksi :<b>{{ $pembayaran[0]->transaction_order }}</b>
                            </p>
                            <p style="font-size: 12px">Tanggal Transaksi :
                                <b>{{ $pembayaran[0]->transaction_date }}</b>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table class="table table-bordered h4-14" style="width: 100%; -fs-table-paginate: paginate; margin-top: 15px">
            <thead style="display: table-header-group">
                <tr
                    style="
              margin: 0;
              background: #fcbd021f;
              padding: 15px;
              padding-left: 20px;
              -webkit-print-color-adjust: exact;
            ">
                </tr>

                <tr>
                    <th style="width: 50px">#</th>
                    <th style="width: 150px">
                        <h4>Jenis Transaksi</h4>
                    </th>
                    <th style="width: 80px">
                        <h4>
                            Bulan
                        </h4>
                    </th>
                    <th style="width: 80px">
                        <h4>Biaya Transaksi</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($pembayaran as $item)
                    <tr>
                        <td style="font-size: 12px">
                            {{ $no++ }}
                        </td>
                        <td style="font-size: 12px">{{ $item->transaction_type }}</td>
                        <td style="font-size: 12px">{{ $item->transaction_month }}</td>
                        <td style="font-size: 12px">Rp {{ number_format($item->transaction_fee, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>

        <table class="hm-p table-bordered" style="width: 100%; margin-top: 30px">
            <tr>
                <th style="width: 200px">
                    <p style="font-size: 14px">Metode Pembayaran</p>
                </th>
                <td style="width: 200px; border-right: none">
                    <p style="text-align: left">Tunai</p>
                </td>
                <td colspan="5" style="border-left: none"></td>
            </tr>
            <tr style="background: #84C225">
                <th>
                    <p style="font-size: 14px">Total Pembayaran</p>
                </th>
                <td style="width: 200px; text-align: right; border-right: none">
                    <p style="text-align: left">Rp {{ number_format($item->transaction_total, 2) }}</p>
                </td>
                <td style="width: 200px; text-align: right; border-right: none">
                    <p style="text-align: left">
                        <?php
                        function terbilang1($angka1)
                        {
                            $angka1 = abs($angka1);
                            $baca1 = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
                            $terbilang1 = '';
                            if ($angka1 < 12) {
                                $terbilang1 = ' ' . $baca1[$angka1];
                            } elseif ($angka1 < 20) {
                                $terbilang1 = terbilang1($angka1 - 10) . ' belas';
                            } elseif ($angka1 < 100) {
                                $terbilang1 = terbilang1($angka1 / 10) . ' puluh' . terbilang1($angka1 % 10);
                            } elseif ($angka1 < 200) {
                                $terbilang1 = ' seratus' . terbilang1($angka1 - 100);
                            } elseif ($angka1 < 1000) {
                                $terbilang1 = terbilang1($angka1 / 100) . ' ratus' . terbilang1($angka1 % 100);
                            } elseif ($angka1 < 2000) {
                                $terbilang1 = ' seribu' . terbilang1($angka1 - 1000);
                            } elseif ($angka1 < 1000000) {
                                $terbilang1 = terbilang1($angka1 / 1000) . ' ribu' . terbilang1($angka1 % 1000);
                            } elseif ($angka1 < 1000000000) {
                                $terbilang1 = terbilang1($angka1 / 1000000) . ' juta' . terbilang1($angka1 % 1000000);
                            } elseif ($angka1 < 1000000000000) {
                                $terbilang1 = terbilang1($angka1 / 1000000000) . ' miliar' . terbilang1($angka1 % 1000000000);
                            } elseif ($angka1 < 1000000000000000) {
                                $terbilang1 = terbilang1($angka1 / 1000000000000) . ' triliun' . terbilang1($angka1 % 1000000000000);
                            }
                            return $terbilang1;
                        }
                        
                        echo "<em>" . terbilang1($item->transaction_total) . ' rupiah </em>';
                        ?>
                    </p>
                </td>
                {{-- <td colspan="5" style="border-left: none"></td> --}}
            </tr>
        </table>

        <table style="width: 100%" cellspacing="0" cellspadding="0" border="0">
            <tr>
                <td>
                    <p style="margin: 0; text-align: center; font-size: 12px">
                        <br />
                        Bag. Keuangan,
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        ________________________
                    </p>
                </td>
                <td>
                    <p style="margin: 0; text-align: center; font-size: 12px">
                        Jakarta, <?php setlocale(LC_TIME, 'id_ID');
                        echo strftime('%e %B %Y'); ?> <br />
                        Penyetor,
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        ________________________
                    </p>
                </td>
            </tr>
        </table>

        <table style="width: 100%" cellspacing="0" cellspadding="0" border="0">
            <tr>
                <td>
                    <h4 style="margin: 10px 0; font-size: 12px">
                        Catatan :
                    </h4>
                    <p style="font-size: 12px">
                        1. Disimpan sebagai bukti pembayaran yang SAH. <br>
                        2. Uang yang sudah dibayarkan tidak dapat diminta kembali. <br>
                        3. Jatuh tempo pembayaran paling lambat tanggal 10 setiap bulannya.
                    </p>
                </td>
            </tr>
        </table>
    </section>

    <hr style="border: 1px solid #000; margin: 10px 0;">

    <section class="main-pd-wrapper" style="width: 1000px; margin: auto">
        <div style="display: table-header-group">
            <h4 style="text-align: center; margin: 0">
                <b>Bukti Pembayaran</b>
            </h4>

            <table style="width: 100%; table-layout: fixed">
                <tr>
                    <td style="border-left: 1px solid #ddd; border-right: 1px solid #ddd">
                        <div
                            style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                ">
                            <svg width="220" height="10" viewBox="0 0 272 73" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <center><img src="{{ asset('assets/backend/img/logo/LA.png') }}" width="70"
                                        alt=""></center>

                            </svg>

                            <p style="font-weight: reguler; margin-top: 5px; font-size: 10px">
                                Jl. Pondok Kelapa Selatan, No. 26, RT 009 / RW 012
                            </p>
                            <p style="font-weight: reguler; font-size: 10px">
                                Kel. Pondok Kelapa, Kec. Duren Sawit, Jakarta Timur
                            </p>
                            <p style="font-weight: reguler; font-size: 10px">
                                No. Telp : (021) 8690 0906, Website : almanar.sch.id
                            </p>
                        </div>
                    </td>
                    <td align="right"
                        style="
                text-align: right;
                padding-left: 50px;
                line-height: 1.5;
                color: #323232;
              ">
                        <div>
                            <h4 style="margin-top: 5px; margin-bottom: 5px; font-size: 14px">
                                Diberikan kepada :
                            </h4>
                            <p style="font-size: 12px">Nama : <b>{{ $pembayaran[0]->name }}</b>, Kelas :
                                <b>{{ $pembayaran[0]->class_id }}</b>
                            </p>
                            <p style="font-size: 12px">Nomor Transaksi :<b>{{ $pembayaran[0]->transaction_order }}</b>
                            </p>
                            <p style="font-size: 12px">Tanggal Transaksi :
                                <b>{{ $pembayaran[0]->transaction_date }}</b>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table class="table table-bordered h4-14" style="width: 100%; -fs-table-paginate: paginate; margin-top: 15px">
            <thead style="display: table-header-group">
                <tr
                    style="
              margin: 0;
              background: #fcbd021f;
              padding: 15px;
              padding-left: 20px;
              -webkit-print-color-adjust: exact;
            ">
                </tr>

                <tr>
                    <th style="width: 50px">#</th>
                    <th style="width: 150px">
                        <h4>Jenis Transaksi</h4>
                    </th>
                    <th style="width: 80px">
                        <h4>
                            Bulan
                        </h4>
                    </th>
                    <th style="width: 80px">
                        <h4>Biaya Transaksi</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($pembayaran as $item)
                    <tr>
                        <td style="font-size: 12px">
                            {{ $no++ }}
                        </td>
                        <td style="font-size: 12px">{{ $item->transaction_type }}</td>
                        <td style="font-size: 12px">{{ $item->transaction_month }}</td>
                        <td style="font-size: 12px">Rp {{ number_format($item->transaction_fee, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
        </table>

        <table class="hm-p table-bordered" style="width: 100%; margin-top: 30px">
            <tr>
                <th style="width: 200px">
                    <p style="font-size: 14px">Metode Pembayaran</p>
                </th>
                <td style="width: 200px; border-right: none">
                    <p style="text-align: left">Tunai</p>
                </td>
                <td colspan="5" style="border-left: none"></td>
            </tr>
            <tr style="background: #84C225">
                <th>
                    <p style="font-size: 14px">Total Pembayaran</p>
                </th>
                <td style="width: 200px; text-align: right; border-right: none">
                    <p style="text-align: left">Rp {{ number_format($item->transaction_total, 2) }}</p>
                </td>
                <td style="width: 200px; text-align: right; border-right: none">
                    <p style="text-align: left">
                        <?php
                        function terbilang($angka)
                        {
                            $angka = abs($angka);
                            $baca = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
                            $terbilang = '';
                            if ($angka < 12) {
                                $terbilang = ' ' . $baca[$angka];
                            } elseif ($angka < 20) {
                                $terbilang = terbilang($angka - 10) . ' belas';
                            } elseif ($angka < 100) {
                                $terbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
                            } elseif ($angka < 200) {
                                $terbilang = ' seratus' . terbilang($angka - 100);
                            } elseif ($angka < 1000) {
                                $terbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
                            } elseif ($angka < 2000) {
                                $terbilang = ' seribu' . terbilang($angka - 1000);
                            } elseif ($angka < 1000000) {
                                $terbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
                            } elseif ($angka < 1000000000) {
                                $terbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
                            } elseif ($angka < 1000000000000) {
                                $terbilang = terbilang($angka / 1000000000) . ' miliar' . terbilang($angka % 1000000000);
                            } elseif ($angka < 1000000000000000) {
                                $terbilang = terbilang($angka / 1000000000000) . ' triliun' . terbilang($angka % 1000000000000);
                            }
                            return $terbilang;
                        }
                        
                        echo "<em>" . terbilang1($item->transaction_total) . ' rupiah </em>';
                        ?>
                    </p>
                </td>
                {{-- <td colspan="5" style="border-left: none"></td> --}}
            </tr>
        </table>

        <table style="width: 100%" cellspacing="0" cellspadding="0" border="0">
            <tr>
                <td>
                    <p style="margin: 0; text-align: center; font-size: 12px">
                        <br />
                        Bag. Keuangan,
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        ________________________
                    </p>
                </td>
                <td>
                    <p style="margin: 0; text-align: center; font-size: 12px">
                        Jakarta, <?php setlocale(LC_TIME, 'id_ID');
                        echo strftime('%e %B %Y'); ?> <br />
                        Penyetor,
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        ________________________
                    </p>
                </td>
            </tr>
        </table>

        <table style="width: 100%" cellspacing="0" cellspadding="0" border="0">
            <tr>
                <td>
                    <h4 style="margin: 10px 0; font-size: 12px">
                        Catatan :
                    </h4>
                    <p style="font-size: 12px">
                        1. Disimpan sebagai bukti pembayaran yang SAH. <br>
                        2. Uang yang sudah dibayarkan tidak dapat diminta kembali. <br>
                        3. Jatuh tempo pembayaran paling lambat tanggal 10 setiap bulannya.
                    </p>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
