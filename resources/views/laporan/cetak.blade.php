
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="nhzjtQeSX6OKVdLN327BochKyBpSTTWeGCC045Yp">
        <title>Laporan Keuangan | Tugas Kewirausahaan</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('public/adminlte') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <!-- Ionicons -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
    </head>
    <body>
        <table id="tabel" class="table table-bordered table-striped nowrap" style="width: 100%">
            <caption><h1 class="text-center">Laporan Stok</h1></caption>
            <thead>
                <tr>
                      <th  style="vertical-align: middle; text-align: center;">No</th>
                      <th  style="vertical-align: middle; text-align: center;">Nama Produk</th>
                      <th  style="vertical-align: middle; text-align: center;">Jumlah <br> Stok</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($stoks as $stok)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td >{{ $stok->name }}</td>
                        <td class="text-center">{{ $stok->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <table id="tabelKeuangan" class="table table-bordered table-striped nowrap" style="width: 100%">
            <caption><h1 class="text-center">Laporan Pemasukan dan Pengeluaran</h1></caption>
            <thead>
                <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Keterangan</th>
                      <th class="text-center">Pemasukan</th>
                      <th class="text-center">Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($stoks as $stok)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $stok->name }}</td>
                        <td class="text-right">{{ (laporan('sale', $stok->id)) ? number_format(laporan('sale', $stok->id)->total, 2, ',', '.') : 0 }}</td>
                        <td class="text-right">{{ (laporan('purchase', $stok->id)) ? number_format(laporan('purchase', $stok->id)->total, 2, ',', '.') : 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Jumlah :</th>
                    <th class="text-right">{{ number_format(jumlah('sale')->total, 2, ',', '.') }}</th>
                    <th class="text-right">{{ number_format(jumlah('purchase')->total, 2, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>



        <script src="http://localhost/project/laporan-keuangan/public/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="http://localhost/project/laporan-keuangan/public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>