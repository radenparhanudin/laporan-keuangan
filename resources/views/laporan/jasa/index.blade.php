@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Jasa
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Data Jasa</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('laporan_jasa.create') }}" class="btn btn-warning flat"><i class="fa fa-plus"></i><span class="backto"> Tambah Jasa</span></a>
                        <a href="{{ route('cetakjasa.index') }}" target="_blank" class="btn btn-danger flat"><i class="fa fa-print"></i> Laporan Jasa</a>
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
                    <div class="data-filter">
                        <form method="POST" id="search-form" class="form-inline" role="form">
                            <div class="form-group">
                                <label >Tanggal</label>
                                <input type="text" class="form-control tanggal" name="tanggal_awal" id="tanggal_awal" placeholder="Dari Tanggal">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control tanggal" name="tanggal_akhir" id="tanggal_akhir" placeholder="Sampai Tanggal">
                            </div>

                            <button type="submit" class="btn btn-primary flat">Rekap</button>
                        </form>
                    </div>
                    <br>
                    <table id="tabel" class="table table-bordered table-striped nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                  <th>Tanggal Jasa</th>
                                  <th>Nomor</th>
                                  <th>Costumer</th>
                                  <th>Nota</th>
                                  <th>Harga</th>
                                  <th>Jenis</th>
                                  <th class="text-center" style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align:right">Total Jasa : </th>
                                <th></th>
                                <th colspan="2"></th>
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
                serverSide: true,
                ajax: {
                    url: '{{ route('getdatajasa') }}',
                    data: function (d) {
                        d.tanggal_awal = $('input[name=tanggal_awal]').val();
                        d.tanggal_akhir = $('input[name=tanggal_akhir]').val();
                    }
                },
                // "order": [[ 4, "desc" ]],
                columns: [
                    { data: 'tanggal_jasa', name: 'tanggal_jasa' },
                    { data: 'nomor_jasa', name: 'nomor_jasa' },
                    { data: 'costumer', name: 'costumer' },
                    { data: 'nota', name: 'nota' },
                    { data: 'harga', name: 'harga' },
                    { data: 'jenis', name: 'jenis' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    // { className: "hidden", "targets": [ 4 ] },
                    { className: "text-right", "targets": [ 4 ] },
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
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                   
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        'Rp. ' + commaSeparateNumber(total)
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
        $('#search-form').on('submit', function(e) {
            table.draw();
            e.preventDefault();
        });

        $(".tanggal").datepicker({
            autoclose: true,
            todayBtn : 'linked',
            todayHighlight: true,
            language:'id',
            format: "yyyy-mm-dd"
        });
    </script>
@endpush
