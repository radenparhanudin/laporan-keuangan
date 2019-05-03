@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Kas
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Data Kas</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('laporan_kas.create') }}" class="btn btn-warning flat"><i class="fa fa-plus"></i><span class="backto"> Tambah Kas</span></a>
                        <a href="{{ route('cetakkas.index') }}" target="_blank" class="btn btn-danger flat"><i class="fa fa-print"></i> Laporan Kas</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has($msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                    <table id="tabel" class="table table-bordered table-striped nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                  <th>Tanggal Kas</th>
                                  <th>Nomor</th>
                                  <th>Keterangan</th>
                                  <th>Debit</th>
                                  <th>Kredit</th>
                                  <th>Saldo</th>
                                  <th class="text-center" style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total Kas : </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
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
                // stateSave: true,
                processing: true,
                // serverSide: true,
                ajax: "{{ route('getdatakas') }}",
                // "order": [[ 4, "desc" ]],
                columns: [
                    { data: 'tanggal_kas', name: 'tanggal_kas' },
                    { data: 'nomor_kas', name: 'nomor_kas' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'debit', name: 'debit' },
                    { data: 'kredit', name: 'kredit' },
                    { data: 'saldo', name: 'saldo' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    // { className: "hidden", "targets": [ 4 ] },
                    { className: "text-right", "targets": [ 3, 4, 5 ] },
                    // { className: "text-right", "targets": [ 2 ] },
                    // { className: "text-center", "targets": [ 5 ] }
                ],
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
                    total_debit = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    total_kredit = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    total_saldo = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                   
                    // Update footer
                    $( api.column( 3 ).footer() ).html(
                        'Rp. ' + commaSeparateNumber(total_debit)
                    );
                     // Update footer
                    $( api.column( 4 ).footer() ).html(
                        'Rp. ' + commaSeparateNumber(total_kredit)
                    );
                     // Update footer
                    $( api.column( 5 ).footer() ).html(
                        'Rp. ' + commaSeparateNumber(total_saldo)
                    );
                },
            });
            new $.fn.dataTable.FixedHeader( table );
            function commaSeparateNumber(val) {
                while (/(\d+)(\d{3})/.test(val.toString())) {
                    val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
                }
                return val;
            }
        });
    </script>
@endpush
