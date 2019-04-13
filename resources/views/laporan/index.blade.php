@extends('layouts.admin')
@push('style')
    <style>
        table tr th {
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Laporan
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Laporan Stok</span></h1>
                </div>
                <div class="box-body">
                    <table id="tabel" class="table table-bordered table-striped nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                  <th>No</th>
                                  <th>Nama Produk</th>
                                  <th>Jumlah <br> Stok</th>
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
                                    <td class="text-center">{{ $stok->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Laporan Keuangan</span></h1>
                </div>
                <div class="box-body">
                    <table id="tabelKeuangan" class="table table-bordered table-striped nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                  <th>No</th>
                                  <th>Keterangan</th>
                                  <th>Pemasukan</th>
                                  <th>Pengeluaran</th>
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
                                <th colspan="2" style="text-align:right">Jumlah : </th>
                                <th class="text-right"></th>
                                <th class="text-right"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            table = $('#tabel').DataTable({
                responsive: true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing":   "Sedang memproses...",
                    "sLengthMenu":   "Tampilkan _MENU_ Data",
                    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",
                    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 Data",
                    "sInfoFiltered": "(Disaring dari _MAX_ Data Keseluruhan)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cari:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext":     "Selanjutnya",
                        "sLast":     "Terakhir"
                    }
                },
            });
            new $.fn.dataTable.FixedHeader( table );
            tableKeuangan = $('#tabelKeuangan').DataTable({
                responsive: true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing":   "Sedang memproses...",
                    "sLengthMenu":   "Tampilkan _MENU_ Data",
                    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ Data",
                    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 Data",
                    "sInfoFiltered": "(Disaring dari _MAX_ Data Keseluruhan)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cari:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext":     "Selanjutnya",
                        "sLast":     "Terakhir"
                    }
                },
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\.\$,]/g, '')/100 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    totalPemasukan = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                  
                    $( api.column( 2 ).footer() ).html(
                        commaSeparateNumber(totalPemasukan)
                    );

                    // Total over all pages
                    totalPengeluaran = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                  
                    $( api.column( 3 ).footer() ).html(
                        commaSeparateNumber(totalPengeluaran)
                    );
                 
                },
            });
            function commaSeparateNumber(val) {
                while (/(\d+)(\d{3})/.test(val.toString())) {
                    val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
                }
                return val;
            }
            new $.fn.dataTable.FixedHeader( tableKeuangan );
        });
    </script>
@endpush