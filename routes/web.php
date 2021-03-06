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

Route::get('/', 'DashboardController@index')->name('index');
Route::get('/kk', 'KartuKeluargaController@index')->name('kk.index');
Route::get('/kk/create', 'KartuKeluargaController@create')->name('kk.create');
Route::post('/kk/store', 'KartuKeluargaController@store')->name('kk.store');
Route::get('/kk/edit/{kk}', 'KartuKeluargaController@edit')->name('kk.edit');
Route::get('/penduduk', 'PendudukController@index')->name('penduduk.index');
