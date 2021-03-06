@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Transakasi
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Data Transakasi</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-warning flat"><i class="fa fa-plus"></i><span class="backto"> Tambah Transakasi</span></a>
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
                                  <th>Nama Produk</th>
                                  <th>Stok</th>
                                  <th>Harga Jual</th>
                                  <th>Total Harga Jual</th>
                                  <th>Time Update</th>
                                  <th class="text-center" style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                {{-- <div class="box-footer">
                    <div class="pull-right">
                        Total Data : 
                    </div>
                </div> --}}
                <!-- /.box-footer-->
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
                ajax: "{{ route('data.transaksi') }}",
                "order": [[ 4, "desc" ]],
                columns: [
                    { data: 'product_id', name: 'product_id' },
                    { data: 'qty', name: 'qty' },
                    { data: 'price', name: 'price' },
                    { data: 'total_price', name: 'total_price' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 4 ] },
                    { className: "text-right", "targets": [ 3 ] },
                    { className: "text-right", "targets": [ 2 ] },
                    { className: "text-center", "targets": [ 5 ] }
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
