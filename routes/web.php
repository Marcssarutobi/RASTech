<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CodePromoController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoyaltyTransactionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserinfoController;
use App\Http\Controllers\UtilisateurController;

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
Route::get('/prodcat/{id}',[ProduitsController::class, 'AllProdCat']);

//UtilisateurClient
Route::post('/createUser',[UserController::class, 'signup']);
Route::post('/login',[UserController::class, 'Login']);
Route::get('/authUserVerify',[UserController::class, 'authUserVerify']);
Route::get('/currentUser',[UserController::class, 'CurrentUser'])->middleware('auth');
Route::post('/logout',[UserController::class, 'Logout'])->middleware('auth');
Route::get('/alluser',[UserController::class, 'AllUser']);
Route::get('/getUser/{id}',[UserController::class, 'GetUser']);
Route::post('/updateuser',[UserController::class, 'UpdateUser']);
Route::post('/deluser',[UserController::class, 'DelUser']);
//UserinfoClient
Route::post('/usercreateinfo',[UserinfoController::class, 'CreateInfoUser']);
Route::post('/uploadimgC', [UserinfoController::class, 'uploadImgC']);
Route::post('/delimgC',[UserinfoController::class, 'deleteImageC']);
Route::get('/getuserinfo/{id}',[UserinfoController::class, 'GetUserInfo']);
Route::post('/delUserInfo', [UserinfoController::class, 'DelUserInfo']);
Route::get('/alluserinfo',[UserinfoController::class, 'AllUserinfo']);

//Newsletter
Route::post('/createnew',[NewsletterController::class, 'CreateNew']);
Route::get('/allnew',[NewsletterController::class, 'AllNew']);
Route::get('/getnew/{id}',[NewsletterController::class, 'GetNew']);
Route::post('/delnew',[NewsletterController::class, 'DelNew']);

//Contacts
Route::post('/createcontact',[ContactController::class, 'CreateContact']);
Route::post('/updatecontact',[ContactController::class, 'UpdateContact']);
Route::get('/allContact',[ContactController::class, 'AllContact']);
Route::get('/getcontact/{id}',[ContactController::class, 'GetContact']);
Route::post('/delcontact', [ContactController::class, 'DelContact']);
Route::post('/mail',[ContactController::class, 'Email']);

//Role
Route::post('/createrole',[RoleController::class, 'CreateRole']);
Route::get('/allrole',[RoleController::class, 'AllRole']);
Route::get('/getrole/{id}',[RoleController::class, 'GetRole']);
Route::post('/updaterole',[RoleController::class, 'UpdateRole']);
Route::post('/delrole',[RoleController::class, 'DeleteRole']);

//Utilisateur
Route::post('/createutili',[UtilisateurController::class, 'CreateUtlisateur']);
Route::post('/uploadimgU', [UtilisateurController::class, 'uploadImgU']);
Route::post('/delimgU',[UtilisateurController::class, 'deleteImageU']);
Route::get('/getUtili/{id}',[UtilisateurController::class, 'GetUtilisateur']);
Route::get('/allutili',[UtilisateurController::class, 'AllUtilisateur']);
Route::post('/updateutili',[UtilisateurController::class, 'UpdateUtlisateur']);
Route::post('/delutili',[UtilisateurController::class, 'DeleteUtilisateur']);
Route::get('/getutili/{id}',[UtilisateurController::class, 'GetUtiliInfo']);

//Commande
Route::post('/createCmd',[CommandeController::class, 'CreateCMD']);
Route::get('/allcmd',[CommandeController::class, 'AllCMD']);
Route::get('/getcmd/{id}',[CommandeController::class, 'GetCMD']);
Route::post('/delcmd',[CommandeController::class, 'DelCMD']);
Route::post('/updatecmd',[CommandeController::class, 'UpdateCMD']);
Route::get('/allcmds/{id}',[CommandeController::class, 'CMDP']);

//CodePromoController
Route::get('/allcodepromo',[CodePromoController::class, 'index']);
Route::get('/showcodepromo/{id}',[CodePromoController::class, 'showCodePromo']);
Route::post('/createcodepromo',[CodePromoController::class, 'createCodePromo']);
Route::put('/updatecodepromo/{id}',[CodePromoController::class, 'updateCodePromo']);
Route::delete('/deletecodepromo/{id}',[CodePromoController::class, 'deleteCodePromo']);
Route::get('/getcode/{code}', [CodePromoController::class, 'getCodepromo']);

//Loyalty Transaction
Route::post('/addpoint', [LoyaltyTransactionController::class, 'addPoint']);
Route::post('/send-promo-code', [LoyaltyTransactionController::class, 'sendPromoCodeManually']);

