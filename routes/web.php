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

Route::get('/', 'IndexController@index');
Route::get('/editarTorneo', 'EditarTorneoController@index');
Route::get('/editarClubes', 'AgregarClubesController@show');
Route::get('/nuevoTorneo','NuevoTorneoController@index');

Route::post('/editarTorneo/guardar','EditarTorneoController@guardarEditor');
Route::post('/nuevoTorneo/guardar','NuevoTorneoController@guardar');
Route::post('/editarClubes/guardar', 'AgregarClubesController@guardar');
