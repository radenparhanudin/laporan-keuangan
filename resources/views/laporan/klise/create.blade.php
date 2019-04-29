@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tambah Data Klise
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Tambah <span class="backto">Jasa</span></h1>
                    <div class="pull-right">
                        <a href="{{ route('laporan_klise.index') }}" class="btn btn-success flat"><i class="fa fa-undo"></i> <span class="backto">Ke Halaman Klise</span></a>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('laporan_klise.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Klise</label>
                                <div class="col-sm-7">
                                    <input type="text" name="tanggal_klise" id="tanggal_klise" value="{{ old('tanggal_klise') }}" class="form-control" placeholder="Tanggal Klise">
                                    @if ($errors->has('tanggal_klise'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('tanggal_klise') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nomor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_klise" id="nomor_klise" value="{{ old('nomor_klise') }}" class="form-control" placeholder="Nomor">
                                    @if ($errors->has('nomor_klise'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('nomor_klise') }}
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
                                <label class="col-sm-3 control-label">Nota</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nota" id="nota" value="{{ old('nota') }}" class="form-control" placeholder="Nota">
                                    @if ($errors->has('nota'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('nota') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="text" name="harga" id="harga" value="{{ old('harga') }}" class="form-control" placeholder="Harga">
                                    @if ($errors->has('harga'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('harga') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jenis" id="jenis" value="{{ old('jenis') }}" class="form-control" placeholder="Jenis">
                                    @if ($errors->has('jenis'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('jenis') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right flat"><i class="fa fa-plus"></i> Tambah Klise</button>
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
            $("#tanggal_klise").datepicker({
                autoclose: true,
                todayBtn : 'linked',
                todayHighlight: true,
                language:'id',
                format: "yyyy-mm-dd"
            });
        });
    </script>
@endpush
