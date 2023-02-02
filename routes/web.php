<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\TblItemsController;
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

Route::get('/', function () { return view('welcome');});

//brand
Route::get('/brand',[BrandController::class,'index']);
Route::get('/addBrand',[BrandController::class,'addBrand']);
Route::get('/viewBrand/{id}',[BrandController::class,'viewBrand']);
Route::post('/storeBrand',[BrandController::class,'store']);
Route::post('/updateBrand',[BrandController::class,'updateBrand']);
Route::get('/deleteBrand/{id}',[BrandController::class,'deleteBrand']);

//items
Route::get('/items',[TblItemsController::class,'index']);
Route::get('/addItem',[TblItemsController::class,'addItem']);
Route::post('/storeItem',[TblItemsController::class,'store']);
Route::get('/viewItem/{id}',[TblItemsController::class,'viewItem']);
Route::post('/updateItem',[TblItemsController::class,'updateItem']);
Route::get('/deleteItem/{id}',[TblItemsController::class,'deleteItem']);
