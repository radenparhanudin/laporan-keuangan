<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware('auth')->group(function (){

    Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('role:administrator|kasir|keuangan');
    Route::resource('transaksi', 'Transaksi')->middleware('role:administrator|kasir');
    Route::get('data/transaksi', 'Transaksi@json')->name('data.transaksi')->middleware('role:administrator|kasir');

    Route::resource('produk', 'Produk')->middleware('role:administrator');
    Route::get('data/produk', 'Produk@json')->name('data.produk')->middleware('role:administrator');
    Route::get('getdata/produk', 'Produk@getdataproduk')->name('getdataproduk')->middleware('role:administrator');

    Route::resource('stok', 'Stok')->middleware('role:administrator|kasir');
    Route::get('data/stok', 'Stok@json')->name('data.stok')->middleware('role:administrator|kasir');

    Route::get('laporan', 'Laporan@index')->name('laporan.index')->middleware('role:administrator|keuangan');

    Route::resource('laporan_pemesanan', 'LaporanPemesananController')->middleware('role:administrator|keuangan');
    Route::get('getdata/pemesanan', 'LaporanPemesananController@json')->name('getdatapemesanan')->middleware('role:administrator');

    Route::resource('laporan_jasa', 'LaporanJasaController')->middleware('role:administrator|keuangan');
    Route::get('getdata/jasa', 'LaporanJasaController@json')->name('getdatajasa')->middleware('role:administrator');

    Route::resource('laporan_klise', 'LaporanKliseController')->middleware('role:administrator|keuangan');
    Route::get('getdata/klise', 'LaporanKliseController@json')->name('getdataklise')->middleware('role:administrator');

    Route::resource('laporan_kas', 'LaporanKasController')->middleware('role:administrator|keuangan');
    Route::get('getdata/kas', 'LaporanKasController@json')->name('getdatakas')->middleware('role:administrator');

    Route::get('cetaklaporan', 'Laporan@cetak')->name('cetaklaporan.index')->middleware('role:administrator|keuangan');
    Route::get('cetakkas', 'Laporan@kas')->name('cetakkas.index')->middleware('role:administrator|keuangan');
    Route::get('cetakklise', 'Laporan@klise')->name('cetakklise.index')->middleware('role:administrator|keuangan');
    Route::get('cetakjasa', 'Laporan@jasa')->name('cetakjasa.index')->middleware('role:administrator|keuangan');
    
});
