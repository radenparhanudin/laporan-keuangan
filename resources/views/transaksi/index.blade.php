@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Transaksi
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h1 class="box-title">Transaki <span class="backto">Penjualan Barang</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-warning flat"><i class="fa fa-plus"></i><span class="backto"> Transaksi Baru</span></a>
                    </div>
                </div>
                <div class="box-body">
                    Start creating your amazing application!
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        Total Data : 
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
