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
        <div class="col-sm-6 col-sm-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Tambah <span class="backto">Stok Produk</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('stok.index') }}" class="btn btn-success flat"><i class="fa fa-undo"></i> <span class="backto">Ke Halaman Stok Produk</span></a>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('stok.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Produk</label>
                                <div class="col-sm-6">
                                    <select name="nama_produk" id="nama_produk" class="form-control">
                                        <option value=""></option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->name }}" {{ ($produk->name == old('nama_produk')) ? "selected" : "" }}>{{  $produk->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tambah Stok</label>
                                    <input type="hidden"id="id" name="id" value="">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock')}}" placeholder="Stok">
                                </div>
                                @if ($errors->has('stock'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        {{ $errors->first('stock') }}
                                    </span>
                                @endif    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Stok Tersedia</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control text-right" id="stock_tersedia" value="{{ old('stock_tersedia')}}" name="stock_tersedia" readonly="" placeholder="Stok Tersedia">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Harga Beli</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control text-right" id="price" name="price" value="{{ old('price')}}" readonly="" placeholder="Harga Beli">
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
@push('script')
    <script>
        var nama_produk = $("#nama_produk");
        $(document).ready(function() {
            $('select').select2({
                placeholder : "Pilih Produk"
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
        });

        nama_produk.on('change', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('getdataproduk') }}',
                type: 'GET',
                dataType: 'json',
                data: { nama_produk: nama_produk.val() },
                success : function (data) {
                    $.each(data, function(index, val) {
                        $("#"+index).val(val);
                    });
                }
            });
        });
    </script>
@endpush
