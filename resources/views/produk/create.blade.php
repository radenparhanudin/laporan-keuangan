@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tambah Produk
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Tambah <span class="backto">Produk</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('produk.index') }}" class="btn btn-success flat"><i class="fa fa-undo"></i> <span class="backto">Ke Halaman Produk</span></a>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('produk.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Produk</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Nama Produk">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Deskripsi Produk</label>
                                <div class="col-sm-9">
                                    <textarea id="description" name="description" class="form-control" placeholder="Deskripsi Produk">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('description') }}
                                        </span>
                                    @endif    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Stok Awal</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock')}}" placeholder="Stok Awal">
                                </div>
                                @if ($errors->has('stock'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        {{ $errors->first('stock') }}
                                    </span>
                                @endif    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Harga Satuan</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Harga Satuan">
                                    
                                </div>
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        {{ $errors->first('price') }}
                                    </span>
                                @endif    
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-sm-3 control-label">Terbilang</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="terbilang" name="terbilang" placeholder="Terbilang" readonly="">
                                </div>
                            </div> --}}
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right flat"><i class="fa fa-plus"></i> Tambah Produk</button>
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
