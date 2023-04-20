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
Route::get('/', 'App\Http\Controllers\Transport@allTransport');
Route::get('/saveCompany/{name}', 'App\Http\Controllers\RestController@saveCompany');
Route::get('/allCompany', 'App\Http\Controllers\RestController@allCompany');
Route::get('/modifyTransport/{id}/{contact}', 'App\Http\Controllers\RestController@modifyTransport');
Route::get('/disableTransport/{id}', 'App\Http\Controllers\RestController@disableTransport');
Route::get('/readContract', 'App\Http\Controllers\Transport@readContract');
