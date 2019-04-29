@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Jasa
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Edit <span class="backto">Jasa</span></h1>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('laporan_jasa.update', [$laporan_jasa->id]) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Jasa</label>
                                <div class="col-sm-7">
                                    <input type="text" name="tanggal_jasa" id="tanggal_jasa" value="{{ $laporan_jasa->tanggal_jasa }}" class="form-control" placeholder="Tanggal Jasa">
                                    @if ($errors->has('tanggal_jasa'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('tanggal_jasa') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nomor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_jasa" id="nomor_jasa" value="{{ $laporan_jasa->nomor_jasa }}" class="form-control" placeholder="Nomor">
                                    @if ($errors->has('nomor_jasa'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('nomor_jasa') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Costumer</label>
                                <div class="col-sm-9">
                                    <input type="text" name="costumer" id="costumer" value="{{ $laporan_jasa->costumer }}" class="form-control" placeholder="Costumer">
                                    @if ($errors->has('costumer'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('costumer') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Note</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nota" id="nota" value="{{ $laporan_jasa->nota }}" class="form-control" placeholder="Note">
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
                                    <input type="text" name="harga" id="harga" value="{{ $laporan_jasa->harga }}" class="form-control" placeholder="Harga">
                                    @if ($errors->has('harga'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('harga') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="keterangan" id="keterangan" value="{{ $laporan_jasa->keterangan }}" class="form-control" placeholder="Keterangan">
                                    @if ($errors->has('keterangan'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('keterangan') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Penjelasan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="penjelasan" id="penjelasan" value="{{ $laporan_jasa->penjelasan }}" class="form-control" placeholder="Penjelasan">
                                    @if ($errors->has('penjelasan'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('penjelasan') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jumlah" id="jumlah" value="{{ $laporan_jasa->jumlah }}" class="form-control" placeholder="Jumlah">
                                    @if ($errors->has('jumlah'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('jumlah') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right flat"><i class="fa fa-plus"></i> Update Jasa</button>
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