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

Route::get('/', function () {
    return view('transport');
});
Route::get('/marchandise','App\Http\Controllers\C_Transport@c_allCompany');
Route::get('/', 'App\Http\Controllers\C_Transport@allTransport');
Route::get('/saveCompany/{name}', 'App\Http\Controllers\RestController@saveCompany');
Route::get('/allCompany', 'App\Http\Controllers\RestController@allCompany');
Route::get('/modifyTransport/{id}/{contact}', 'App\Http\Controllers\RestController@modifyTransport');
Route::get('/disableTransport/{id}', 'App\Http\Controllers\RestController@disableTransport');
Route::post('/saveTransport', 'App\Http\Controllers\C_Transport@saveTransport');
Route::post('/saveContrat', 'App\Http\Controllers\C_Transport@saveContrat');
Route::get('/readContract', 'App\Http\Controllers\C_Transport@readContract');
Route::get('/showPDF', 'App\Http\Controllers\C_Transport@showPDF');
Route::get('/sendEmail', 'App\Http\Controllers\C_Transport@sendEmail');
