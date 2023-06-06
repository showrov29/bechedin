<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["prefix"=>"/user"],function(){

    Route::get('/all',[UserController::class,'getAllUsers']);
    Route::post('/login',[UserController::class,'login']);
    Route::post('/signin',[UserController::class,'signIn']);

}
);


Route::group(["prefix"=>"/brand"],function(){

    Route::post('/add',[BrandController::class,'addBrandName']);
    Route::get('/all',[BrandController::class,'allBrandName']);
    Route::put('/edit/{id}',[BrandController::class,'editBrandName']);
    Route::delete('/delete/{id}',[BrandController::class,'deleteBrandName']);

    Route::post('/sub-brand/add',[BrandController::class,'addSubBrandName']);
    Route::get('/sub-brand/all',[BrandController::class,'allSubBrandName']);
    Route::put('/sub-brand/edit/{id}',[BrandController::class,'editSubBrandName']);
    Route::delete('/sub-brand/delete/{id}',[BrandController::class,'deleteSubBrandName']);

    
   
});


Route::group(["prefix"=>"/advertisement"],function(){
    Route::get('/show',[AdvertisementController::class,'latestAdd']);
    
});