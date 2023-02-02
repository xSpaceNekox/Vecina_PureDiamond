<?php

use App\Http\Controllers\BrandController;
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
Route::get('/brand',[BrandController::class,'index']);
Route::get('/addBrand',[BrandController::class,'addBrand']);
Route::get('/viewBrand/{id}',[BrandController::class,'viewBrand']);
Route::post('/storeBrand',[BrandController::class,'store']);

Route::get('/items',function() { return view('items');});
