<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\UserController;

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

//Catégorie
Route::post('/createCat', [CategoriesController::class, 'CreateCat']);
Route::post('/update', [CategoriesController::class, 'UpdateCat']);
Route::get('/allcat',[CategoriesController::class, 'AllCat']);
Route::post('/delcat', [CategoriesController::class, 'DelCate']);
Route::get('/getcat/{id}', [CategoriesController::class, 'GetCat']);
Route::get('/Categories',[CategoriesController::class, 'Categories']);

//Produits
Route::post('/createpro', [ProduitsController::class, 'CreatePro']);
Route::post('/uploadimg', [ProduitsController::class, 'uploadImg']);
Route::get('/allprod', [ProduitsController::class, 'AllProd']);
Route::get('/getpro/{id}',[ProduitsController::class, 'show']);
Route::post('/delimg',[ProduitsController::class, 'deleteImage']);
Route::post('/updatepro',[ProduitsController::class, 'updateProduits']);
Route::post('/delpro', [ProduitsController::class, 'delProd']);

//Utilisateur
Route::post('/createUser',[UserController::class, 'signup']);
Route::post('/login',[UserController::class, 'Login']);
Route::get('/currentUser',[UserController::class, 'CurrentUser'])->middleware('auth');
Route::post('/logout',[UserController::class, 'Logout'])->middleware('auth');
