@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tambah Data Pesananan
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Tambah <span class="backto">Pesanan</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('laporan_pemesanan.index') }}" class="btn btn-success flat"><i class="fa fa-undo"></i> <span class="backto">Ke Halaman Pemesanan</span></a>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('laporan_pemesanan.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Pemesanan</label>
                                <div class="col-sm-7">
                                    <input type="text" name="tanggal_pemesanan" id="tanggal_pemesanan" value="{{ old('tanggal_pemesanan') }}" class="form-control" placeholder="Tanggal Pemesanan">
                                    @if ($errors->has('tanggal_pemesanan'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('tanggal_pemesanan') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nomor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_pemesanan" id="nomor_pemesanan" value="{{ old('nomor_pemesanan') }}" class="form-control" placeholder="Nomor">
                                    @if ($errors->has('nomor_pemesanan'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('nomor_pemesanan') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Costumer</label>
                                <div class="col-sm-9">
                                    <input type="text" name="costumer" id="costumer" value="{{ old('costumer') }}" class="form-control" placeholder="Costumer">
                                    @if ($errors->has('costumer'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('costumer') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}" class="form-control" placeholder="No. Telepon">
                                    @if ($errors->has('no_telp'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('no_telp') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right flat"><i class="fa fa-plus"></i> Tambah Pesanan</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
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
            $("#tanggal_pemesanan").datepicker({
                autoclose: true,
                todayBtn : 'linked',
                todayHighlight: true,
                language:'id',
                format: "yyyy-mm-dd"
            });
        });
    </script>
@endpush
