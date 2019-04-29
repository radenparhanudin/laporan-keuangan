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
                                  <th>Tanggal Pemesanan</th>
                                  <th>Nomor</th>
                                  <th>Costumer</th>
                                  <th>Nota</th>
                                  <th>Harga</th>
                                  <th>Keterangan</th>
                                  <th>Penjelasan</th>
                                  <th>Jumlah</th>
                                  <th class="text-center" style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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
                ajax: "{{ route('getdatajasa') }}",
                // "order": [[ 4, "desc" ]],
                columns: [
                    { data: 'tanggal_jasa', name: 'tanggal_jasa' },
                    { data: 'nomor_jasa', name: 'nomor_jasa' },
                    { data: 'costumer', name: 'costumer' },
                    { data: 'nota', name: 'nota' },
                    { data: 'harga', name: 'harga' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'penjelasan', name: 'penjelasan' },
                    { data: 'jumlah', name: 'jumlah' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    // { className: "hidden", "targets": [ 4 ] },
                    // { className: "text-right", "targets": [ 3 ] },
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
            });
            new $.fn.dataTable.FixedHeader( table );
        });
    </script>
@endpush