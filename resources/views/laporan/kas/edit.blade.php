@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Kas
        <small class="text-success">Selamat datang di Aplikasi Laporan Keuangan ( <span class="text-danger">User Login : {{ Auth::user()->name }}</span> )</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h1 class="box-title">Edit <span class="backto">Kas</span></h1>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ route('laporan_kas.update', [$laporan_kas->id]) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Kas</label>
                                <div class="col-sm-7">
                                    <input type="text" name="tanggal_kas" id="tanggal_kas" value="{{ $laporan_kas->tanggal_kas }}" class="form-control" placeholder="Tanggal Kas">
                                    @if ($errors->has('tanggal_kas'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('tanggal_kas') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nomor</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_kas" id="nomor_kas" value="{{ $laporan_kas->nomor_kas }}" class="form-control" placeholder="Nomor">
                                    @if ($errors->has('nomor_kas'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('nomor_kas') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="keterangan" id="keterangan" value="{{ $laporan_kas->keterangan }}" class="form-control" placeholder="Keterangan">
                                    @if ($errors->has('keterangan'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('keterangan') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Debit</label>
                                <div class="col-sm-9">
                                    <input type="text" name="debit" id="debit" value="{{ $laporan_kas->debit }}" class="form-control" placeholder="Debit">
                                    @if ($errors->has('debit'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('debit') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kredit</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kredit" id="kredit" value="{{ $laporan_kas->kredit }}" class="form-control" placeholder="Kredit">
                                    @if ($errors->has('kredit'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('kredit') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Saldo</label>
                                <div class="col-sm-9">
                                    <input type="text" name="saldo" id="saldo" value="{{ $laporan_kas->saldo }}" class="form-control" placeholder="Saldo">
                                    @if ($errors->has('saldo'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                            {{ $errors->first('saldo') }}
                                        </span>
                                    @endif      
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right flat"><i class="fa fa-plus"></i> Update Kas</button>
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