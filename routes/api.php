<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Advertisement;
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
    Route::get('/verify/{id}',[UserController::class,'verify']);

    Route::post('/login',[UserController::class,'login']);
    Route::post('/signin',[UserController::class,'signIn']);
    Route::get('/admin/all',[UserController::class,'getAllAdmin']);
    Route::post('/admin/login',[UserController::class,'adminLogin']);
    Route::post('/admin/signin',[UserController::class,'adminSignIn']);
    Route::get('/profile/{id}',[UserController::class,'getUserById']);
    Route::get('/admin/profile/{id}',[UserController::class,'getAdminById']);

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
    Route::get('/all',[CategoryController::class,'allCategory']);
    Route::put('/edit/{id}',[CategoryController::class,'editCategory']);
    Route::delete('/delete/{id}',[CategoryController::class,'deleteCategory']);

    Route::post('/sub-brand/add',[CategoryController::class,'addSubCategory']);
    Route::get('/sub-brand/all',[CategoryController::class,'allSubCategory']);
    Route::put('/sub-brand/edit/{id}',[CategoryController::class,'editSubCategory']);
    Route::delete('/sub-brand/delete/{id}',[CategoryController::class,'deleteSubCategory']);


    
   
});


Route::group(["prefix"=>"/advertisement"],function(){
    Route::post('/add',[AdvertisementController::class,'addAdvertisement']);
    Route::get('/show',[AdvertisementController::class,'latestAdd']);
    Route::put('/approve/{id}',[AdvertisementController::class,'approve']);
    Route::put('/edit/{id}',[AdvertisementController::class,'updateAdd']);
    Route::get('/details/{id}',[AdvertisementController::class,'details']);
    Route::get('/category/{id}',[AdvertisementController::class,'category']);
    Route::post('/filter',[AdvertisementController::class,'filter']);


});