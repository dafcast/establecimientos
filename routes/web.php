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

Route::get('/','InicioController')->name('inicio.index');

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function(){

    //Establecimiento
    Route::get('/establecimientos/create','EstablecimientoController@create')->name('establecimientos.create');
    Route::post('/establecimientos','EstablecimientoController@store')->name('establecimientos.store');
    
    //Imagenes
    Route::post('/imagenes/store', 'ImagenController@store')->name('imagenes.store');
    Route::delete('/imagenes/{imagen}','ImagenController@destroy')->name('imagenes.destroy');
});


Route::get('/home', 'HomeController@index')->name('home');
