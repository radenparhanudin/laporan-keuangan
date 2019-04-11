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

Route::get('/admin', 'HomeController@index')->name('admin');
Route::middleware('auth')->group(function (){
    Route::resource('transaksi', 'Transaksi');
    Route::get('data/transaksi', 'Transaksi@json')->name('data.transaksi');

    Route::resource('produk', 'Produk');
    Route::get('data/produk', 'Produk@json')->name('data.produk');
    Route::get('getdata/produk', 'Produk@getdataproduk')->name('getdataproduk');

    Route::resource('stok', 'Stok');
    Route::get('data/stok', 'Stok@json')->name('data.stok');

    Route::get('laporan', 'Laporan@index')->name('laporan.index');

});
