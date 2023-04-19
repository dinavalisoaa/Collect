<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\StockController;

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

//default
Route::get('/', function () {
    return view('welcome');
});

//list module
Route::view('/all','all');

//getsion marge beneficiaire
Route::get('/modifMarge',[DataController::class,'modifMarge']);
Route::post('/updateMarge',[DataController::class,'updateMarge']);

//insertion mouvement stock
Route::get('/newMouvement',[StockController::class,'newMouvement']);
Route::post('/insertEntree',[StockController::class,'insertEntree']);
Route::post('/insertSortie',[StockController::class,'insertSortie']);

//list mouvement stock
Route::get('/listMouvement',[StockController::class,'listMouvement']);

//update mouvement stock
Route::get('/modifMouvement/{id}',[StockController::class,'modifMouvement']);
Route::put('/updateMouvement',[StockController::class,'updateMouvement']);

//delete mouvement stock
Route::delete('/deleteMouvement/{id}',[StockController::class,'deleteMouvement']);

//filter mouvement stock
Route::get('/filterMouvement',[StockController::class,'filterMouvement']);

//etat stock
Route::get('/choixProduit',[StockController::class,'listProduit']);
Route::get('/etatStock/{id}',[StockController::class,'etatStock']);
