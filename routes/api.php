<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('users', [App\Http\Controllers\api\UserController::class,'indexAPI']);

Route::Post('register', [App\Http\Controllers\api\UserController::class,'storeAPI']);
Route::Post('login', [App\Http\Controllers\api\UserController::class,'loginAPI']);
Route::Post('profile', [App\Http\Controllers\api\UserController::class,'profileAPI']);
Route::Post('password', [App\Http\Controllers\api\UserController::class, 'passwordAPI']);
Route::Post('product', [App\Http\Controllers\api\UserController::class, 'product']);
Route::Post('productedit', [App\Http\Controllers\api\UserController::class, 'productEdit']);
Route::Post('productupdate', [App\Http\Controllers\api\UserController::class, 'productUpdate']);
Route::Post('slider', [App\Http\Controllers\api\UserController::class, 'Slider']);
Route::Post('content', [App\Http\Controllers\api\UserController::class, 'Site_Content']);
Route::Post('industry', [App\Http\Controllers\api\UserController::class, 'Industry']);
Route::Post('usertype', [App\Http\Controllers\api\UserController::class, 'User_type']);
Route::Post('city', [App\Http\Controllers\api\UserController::class, 'City']);
Route::Post('brand', [App\Http\Controllers\api\UserController::class, 'Brand']);
Route::Post('construction', [App\Http\Controllers\api\UserController::class, 'Construction']);
Route::Post('company', [App\Http\Controllers\api\UserController::class, 'company']);
Route::Post('brickscompany', [App\Http\Controllers\api\UserController::class, 'brickscompany']);
Route::Post('marblecompany', [App\Http\Controllers\api\UserController::class, 'marblecompany']);
Route::Post('search', [App\Http\Controllers\api\UserController::class, 'search']);
Route::Post('userdetail', [App\Http\Controllers\api\UserController::class, 'userDetail']);
Route::Post('userimageremarks', [App\Http\Controllers\api\UserController::class, 'userImageRemarks']);
Route::Post('uservideoremarks', [App\Http\Controllers\api\UserController::class, 'userVideoRemarks']);
Route::Post('videos', [App\Http\Controllers\api\UserController::class, 'VideoRemarks']);
Route::Post('images', [App\Http\Controllers\api\UserController::class, 'ImageRemarks']);
Route::Post('packages', [App\Http\Controllers\api\UserController::class, 'packages']);
Route::Post('contactus', [App\Http\Controllers\api\UserController::class, 'storeContact']);
Route::Post('homepage/slider', [App\Http\Controllers\api\UserController::class, 'homepage_slider']);
Route::Post('userproduct', [App\Http\Controllers\api\UserController::class, 'userProduct']);
Route::Post('addreview', [App\Http\Controllers\api\UserController::class, 'AddReview']);
Route::Post('reviews', [App\Http\Controllers\api\UserController::class, 'ShowReview']);
Route::Post('phone', [App\Http\Controllers\api\UserController::class, 'UserPhone']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
