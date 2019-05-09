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
    return view('templates.material.index');
});
Route::get('/kk/create', 'KartuKeluargaController@create');
Route::post('/kk/store', 'KartuKeluargaController@store')->name('kk.store');
