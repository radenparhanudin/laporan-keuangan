@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Pemesanan
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Data Pemesanan</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('laporan_pemesanan.create') }}" class="btn btn-warning flat"><i class="fa fa-plus"></i><span class="backto"> Tambah Pesanan</span></a>
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
                                  <th>Tanggal Pemesanan</th>
                                  <th>Nomor</th>
                                  <th>Costumer</th>
                                  <th>No. Telepon</th>
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
                serverSide: true,
                ajax: {
                    url: '{{ route('getdatapemesanan') }}',
                    data: function (d) {
                        d.tanggal_awal = $('input[name=tanggal_awal]').val();
                        d.tanggal_akhir = $('input[name=tanggal_akhir]').val();
                    }
                },
                columns: [
                    { data: 'tanggal_pemesanan', name: 'tanggal_pemesanan' },
                    { data: 'nomor_pemesanan', name: 'nomor_pemesanan' },
                    { data: 'costumer', name: 'costumer' },
                    { data: 'no_telp', name: 'no_telp' },
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
        });

    </script>
@endpush

