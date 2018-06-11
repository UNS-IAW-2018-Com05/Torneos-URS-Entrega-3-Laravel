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


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/index', 'IndexController@index')->middleware('checkAdmin');
Route::get('/editarTorneo', 'EditarTorneoController@index')->middleware('checkAdmin');
Route::get('/editarClubes', 'AgregarClubesController@show')->middleware('checkAdmin');
Route::get('/nuevoTorneo','NuevoTorneoController@index')->middleware('checkAdmin');
Route::get('/editarDias','EditarDiasController@index')->middleware('checkAdmin');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/editarTorneo/guardar','EditarTorneoController@guardarEditor')->middleware('checkAdmin');
Route::post('/nuevoTorneo/guardar','NuevoTorneoController@guardar')->middleware('checkAdmin');
Route::post('/editarClubes/guardar', 'AgregarClubesController@guardar');
Route::post('/editarDias/guardar','EditarDiasController@guardar')->middleware('checkAdmin')->middleware('checkAdmin');
