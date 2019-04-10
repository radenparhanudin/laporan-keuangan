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
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Tambah <span class="backto">Transaki Penjualan</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-success flat"><i class="fa fa-undo"></i> <span class="backto">Ke Halaman Transaksi</span></a>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Produk</label>
                                <div class="col-sm-9">
                                    <select name="nama_produk" id="nama_produk" class="form-control">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Harga Satuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" placeholder="Harga Satuan" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Stok Tersedia</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="stok_tersedia" name="stok_tersedia" placeholder="Stok Tersedia" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Jumlah Produk">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Harga</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga" readonly="">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right flat">Tambah</button>
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
