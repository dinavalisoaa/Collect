<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\EngardController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PlanningCollectController;
use App\Http\Controllers\PointCollectController;
use App\Http\Controllers\ProduitController;
use App\Models\Collecteur;
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
    return view(
        'users.login',
        [
            'id' => '1'
        ]
    );
});
Route::get('users/home', [UsersController::class, 'test']);
Route::post('admin/action_login', [AdminController::class, 'action_login']);

Route::get('collecteur/list', [CollecteurController::class, 'list']);
Route::get('collecteur/add', [CollecteurController::class, 'add']);
Route::post('collecteur/action_add', [CollecteurController::class, 'action_add']);




Route::get('planningcollect/list', [PlanningCollectController::class, 'list']);
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


/** API */
Route::post('collect', [MobileController::class, 'add']);
Route::get('collect/list', [MobileController::class, 'liste_collect']);
Route::get('collect/{id}', [MobileController::class, 'liste_collect_one']);


Route::post('collecteur/login', [MobileController::class, 'login_collecteur']);
Route::get('produit/list', [MobileController::class, 'liste_produit']);
Route::get('pointcollect/list', [MobileController::class, 'liste_point']);


Route::get('charge/add', [MobileController::class, 'add_charge']);
Route::get('charge/list', [MobileController::class, 'liste_charge']);
// Route::get('charge/{id}', [MobileController::class, 'liste_charge_one']);
Route::get('charge/{id}', [MobileController::class, 'delete_charge']);

Route::get('typecharge/list', [MobileController::class, 'liste_typecharge']);
Route::get('typecharge/add', [MobileController::class, 'add_typecharge']);
Route::get('typecharge/{id}', [MobileController::class, 'liste_produit_one']);

// liste_produit_one
// Route::post('collect', [CollectController::class, 'add']);
// Route::get('produit/add', [ProduitController::class, 'add']);
// Route::get('produit/action_add', [ProduitController::class, 'action_add']);
