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

Route::post('refresh', [App\Http\Controllers\api\UserController::class, 'indexAPI']);

Route::post('register', [App\Http\Controllers\api\UserController::class, 'storeAPI']);
Route::post('login', [App\Http\Controllers\api\UserController::class, 'loginAPI']);
Route::post('forget-password', [App\Http\Controllers\api\UserController::class, 'forgetPassword']);
Route::post('reset-password', [App\Http\Controllers\api\UserController::class, 'resetpasswordAPI']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('change-password', [App\Http\Controllers\api\UserController::class, 'passwordAPI']);
    Route::post('get-profile', [App\Http\Controllers\api\UserController::class, 'getProfileApi']);
    Route::post('profile', [App\Http\Controllers\api\UserController::class, 'profileAPI']);

    Route::post('product', [App\Http\Controllers\api\UserController::class, 'product']);
    Route::post('productadd', [App\Http\Controllers\api\UserController::class, 'productAdd']);
    Route::post('productedit', [App\Http\Controllers\api\UserController::class, 'productEdit']);
    Route::post('productupdate', [App\Http\Controllers\api\UserController::class, 'productUpdate']);
    Route::post('homepage/slider', [App\Http\Controllers\api\UserController::class, 'homepage_slider']);
    Route::post('content', [App\Http\Controllers\api\UserController::class, 'Site_Content']);
    Route::post('industry', [App\Http\Controllers\api\UserController::class, 'Industry']);
    Route::post('usertype', [App\Http\Controllers\api\UserController::class, 'User_type']);
    Route::post('city', [App\Http\Controllers\api\UserController::class, 'City']);
    Route::post('search-industry', [App\Http\Controllers\api\UserController::class, 'SearchIndustry']);
    Route::post('search-city', [App\Http\Controllers\api\UserController::class, 'SearchCity']);

    Route::post('company', [App\Http\Controllers\api\UserController::class, 'company']);
    Route::post('brickscompany', [App\Http\Controllers\api\UserController::class, 'brickscompany']);
    Route::post('marblecompany', [App\Http\Controllers\api\UserController::class, 'marblecompany']);
    Route::post('userdetail', [App\Http\Controllers\api\UserController::class, 'userDetail']);
    Route::post('slider', [App\Http\Controllers\api\UserController::class, 'Slider']);
    Route::post('userimageremarks', [App\Http\Controllers\api\UserController::class, 'userImageRemarks']);
    Route::post('uservideoremarks', [App\Http\Controllers\api\UserController::class, 'userVideoRemarks']);
    Route::post('userproduct', [App\Http\Controllers\api\UserController::class, 'userProduct']);
    Route::post('addreview', [App\Http\Controllers\api\UserController::class, 'AddReview']);
    Route::post('reviews', [App\Http\Controllers\api\UserController::class, 'ShowReview']);
    Route::post('phone', [App\Http\Controllers\api\UserController::class, 'UserPhone']);

    Route::post('remarks', [App\Http\Controllers\api\UserController::class, 'Remarks']);
    Route::post('construction-videos', [App\Http\Controllers\api\UserController::class, 'ConstructionVideo']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
