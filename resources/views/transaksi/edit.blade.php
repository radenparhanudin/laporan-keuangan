@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Penambahan Stok Produk
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Edit <span class="backto">Penambahan Stok Produk</span></h1>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('transaksi.update', [$transaksi->id]) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="price" value="{{ $transaksi->price }}">
                                <label class="col-md-5 control-label">Edit Stok</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="qty" name="qty" value="{{ $transaksi->qty }}" placeholder="Stok">
                                </div>
                                @if ($errors->has('qty'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        {{ $errors->first('qty') }}
                                    </span>
                                @endif    
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-block flat"><i class="fa fa-plus"></i> Update Penambahan</button>
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
