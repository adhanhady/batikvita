<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});


Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('/home', 'HomeController@index')->name('home');


// form data barang
Route::get('/input-data', 'BarangController@index')->name('barang');
Route::get('/show-barang', 'BarangController@show')->name('show');
Route::get('/input-barang', 'BarangController@create')->name('input-barang');
Route::post('/barang/tambah','BarangController@store')->name('store');
Route::get('/barang/edit/{id}','BarangController@edit')->name('barang.edit');
Route::put('/barang/edit/{id}','BarangController@update')->name('barang.update');
Route::get('/barang/delete/{id}','BarangController@destroy')->name('barang.hapus');


// laporan
Route::get('/laporan', 'LaporanController@index')->name('laporan');
Route::get('/show-laporan', 'LaporanController@show')->name('show-laporan');
Route::get('/input-laporan', 'LaporanController@create')->name('input-laporan');
Route::post('/laporan/tambah','LaporanController@store')->name('store-laporan');
Route::get('/laporan/edit/{id}','LaporanController@edit')->name('laporan.edit');
Route::put('/laporan/edit/{id}','LaporanController@update')->name('laporan.update');
Route::get('/laporan/delete/{id}','LaporanController@destroy')->name('laporan.hapus');

// export laporan
Route::get('export', 'LaporanController@export')->name('export');
