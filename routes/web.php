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

    //Produk
    Route::resource('produk', 'Produk');
    Route::get('data/produk', 'Produk@json')->name('data.produk');

    Route::resource('stok', 'Stok');
});
