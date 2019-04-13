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
    Route::get('cetaklaporan', 'Laporan@cetak')->name('cetaklaporan.index')->middleware('role:administrator|keuangan');
    
});
