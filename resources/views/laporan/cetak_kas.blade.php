
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
            <caption><h1 class="text-center">Laporan Kas</h1></caption>
            <thead>
                <tr>
                    <th  style="vertical-align: middle; text-align: center;">No</th>
                    <th  style="vertical-align: middle; text-align: center;">Tanggal Kas</th>
                    <th  style="vertical-align: middle; text-align: center;">Nomor</th>
                    <th  style="vertical-align: middle; text-align: center;">Costumer</th>
                    <th  style="vertical-align: middle; text-align: center;">Nota</th>
                    <th  style="vertical-align: middle; text-align: center;">Harga</th>
                    <th  style="vertical-align: middle; text-align: center;">Jenis</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($kas as $field)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td >{{ $field->tanggal_kas }}</td>
                        <td class="text-center">{{ $field->nomor_kas }}</td>
                        <td >{{ $field->costumer }}</td>
                        <td class="text-right">{{ $field->nota }}</td>
                        <td class="text-right">{{ number_format($field->harga, 2, ',', '.') }}</td>
                        <td class="text-right">{{ $field->jenis }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script src="http://localhost/project/laporan-keuangan/public/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="http://localhost/project/laporan-keuangan/public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>