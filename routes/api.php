<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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
Route::group(["prefix"=>"/user/admin"],function(){

    Route::get('/all',[UserController::class,'getAllAdmin']);
    Route::post('/login',[UserController::class,'adminLogin']);
    Route::post('/signin',[UserController::class,'adminSignIn']);

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
Route::group(["prefix"=>"/category"],function(){

    Route::post('/add',[CategoryController::class,'addCategoryName']);
    Route::get('/all',[CategoryController::class,'allCategoryName']);
    Route::put('/edit/{id}',[CategoryController::class,'editCategoryName']);
    Route::delete('/delete/{id}',[CategoryController::class,'deleteCategoryName']);

    Route::post('/sub-brand/add',[CategoryController::class,'addSubCategoryName']);
    Route::get('/sub-brand/all',[CategoryController::class,'allSubCategoryName']);
    Route::put('/sub-brand/edit/{id}',[CategoryController::class,'editSubCategoryName']);
    Route::delete('/sub-brand/delete/{id}',[CategoryController::class,'deleteSubCategoryName']);

    
   
});


Route::group(["prefix"=>"/advertisement"],function(){
    Route::get('/show',[AdvertisementController::class,'latestAdd']);
    Route::post('/add',[AdvertisementController::class,'addAdvertisement']);
    Route::put('/edit/{id}',[AdvertisementController::class,'updateAdd']);
    Route::get('/details/{id}',[AdvertisementController::class,'details']);
    Route::get('/search',[AdvertisementController::class,'search']);
    Route::delete('/delete/{id}',[AdvertisementController::class,'search']);


});