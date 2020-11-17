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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tabungann'], function(){
    Route::get('index', 'tabungannController@index')->name('tabungann.index');

    Route::get('create','tabungannController@create')->name('tabungann.create');

    Route::post('save','tabungannController@store')->name('kegiatan.save');

    Route::get('tampil-formEdit/{tabungann}','tabungannController@edit')->name('tabungann.tampil-formEdit');

    Route::patch('detail/{tabungann}','tabungannController@detail')->name('tabungann.update');

    Route::get('hapus/{tabungann}','tabungannController@destroy')->name('tabungann.hapus');

});