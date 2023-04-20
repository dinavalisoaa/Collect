<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\EngardController;
use App\Http\Controllers\PlanningCollectController;
use App\Http\Controllers\PointCollectController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StatistiqueController;
use App\Models\Collecteur;
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
    return view(
        'admin.login',
        [
            'id' => '1'
        ]
    );
});
Route::post('admin/action_login', [AdminController::class, 'action_login']);
Route::get('admin/home', [AdminController::class, 'home']);
Route::get('admin/dash', [AdminController::class, 'dash']);
Route::get('admin/detail', [AdminController::class, 'detail']);
// Route::get('admin/ajou', [AdminController::class, 'detail']);

Route::get('collecteur/list', [CollecteurController::class, 'list']);
Route::get('collecteur/home', [CollecteurController::class, 'home']);
Route::get('collecteur/add', [CollecteurController::class, 'add']);
Route::post('collecteur/action_add', [CollecteurController::class, 'action_add']);
Route::get('statistique/all', [StatistiqueController::class, 'autres']);
Route::get('statistique/recette_depense', [StatistiqueController::class, 'recette_depense']);


Route::get('collecte/list', [CollectController::class, 'list']);


Route::get('planningcollect/list', [PlanningCollectController::class, 'list']);
Route::get('planningcollect/detail', [PlanningCollectController::class, 'detail']);
Route::get('planningcollect/test', [PlanningCollectController::class, 'test']);
Route::get('planningcollect/add', [PlanningCollectController::class, 'add']);
Route::get('planningcollect/action_add', [PlanningCollectController::class, 'action_add']);


Route::get('engard/list', [EngardController::class, 'list']);
Route::get('engard/add', [EngardController::class, 'add']);
Route::get('engard/action_add', [EngardController::class, 'action_add']);


Route::get('pointcollect/list', [PointCollectController::class, 'list']);
Route::get('pointcollect/add', [PointCollectController::class, 'add']);
Route::get('pointcollect/action_add', [PointCollectController::class, 'action_add']);


Route::get('produit/list', [ProduitController::class, 'list']);
Route::get('produit/add', [ProduitController::class, 'add']);
Route::get('produit/action_add', [ProduitController::class, 'action_add']);
 

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

Route::get('/s', 'App\Http\Controllers\C_Transport@allTransport');
Route::get('/saveCompany/{name}', 'App\Http\Controllers\RestController@saveCompany');
Route::get('/allCompany', 'App\Http\Controllers\RestController@allCompany');
Route::get('/modifyTransport/{id}/{contact}', 'App\Http\Controllers\RestController@modifyTransport');
Route::get('/disableTransport/{id}', 'App\Http\Controllers\RestController@disableTransport');
Route::get('/readContract', 'App\Http\Controllers\C_Transport@readContract');
