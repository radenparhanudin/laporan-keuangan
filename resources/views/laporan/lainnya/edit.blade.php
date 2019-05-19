@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Lainnya
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
                    <form class="form-horizontal" action="{{ route('laporan_lainnya.update', [$laporan_lainnya->id]) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Lainnya</label>
                                <div class="col-sm-7">
                                    <input type="text" name="tanggal_lainnya" id="tanggal_lainnya" value="{{ $laporan_lainnya->tanggal_lainnya }}" class="form-control" placeholder="Tanggal Lainnya">
                                    @if ($errors->has('tanggal_lainnya'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('tanggal_lainnya') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nomor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_lainnya" id="nomor_lainnya" value="{{ $laporan_lainnya->nomor_lainnya }}" class="form-control" placeholder="Nomor">
                                    @if ($errors->has('nomor_lainnya'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('nomor_lainnya') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Costumer</label>
                                <div class="col-sm-9">
                                    <input type="text" name="costumer" id="costumer" value="{{ $laporan_lainnya->costumer }}" class="form-control" placeholder="Costumer">
                                    @if ($errors->has('costumer'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('costumer') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="keterangan" id="keterangan" value="{{ $laporan_lainnya->keterangan }}" class="form-control" placeholder="keterangan">
                                    @if ($errors->has('keterangan'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('keterangan') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nota</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nota" id="nota" value="{{ $laporan_lainnya->nota }}" class="form-control" placeholder="Nota">
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
                                    <input type="text" name="harga" id="harga" value="{{ $laporan_lainnya->harga }}" class="form-control" placeholder="Harga">
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
                                    <input type="text" name="jenis" id="jenis" value="{{ $laporan_lainnya->jenis }}" class="form-control" placeholder="Jenis">
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
                            <button type="submit" class="btn btn-success pull-right flat"><i class="fa fa-plus"></i> Update Lainnya</button>
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
            $("#tanggal_lainnya").datepicker({
                autoclose: true,
                todayBtn : 'linked',
                todayHighlight: true,
                language:'id',
                format: "yyyy-mm-dd"
            });
        });
    </script>
@endpush