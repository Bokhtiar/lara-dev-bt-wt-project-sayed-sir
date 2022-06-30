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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [App\Http\Controllers\Auth\ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register',  [App\Http\Controllers\Auth\ApiAuthController::class, 'register'])->name('register.api');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\ApiAuthController::class, 'logout'])->name('logout.api');
    Route::get('/user/profile', [App\Http\Controllers\Auth\ApiAuthController::class, 'userProfile']);
});

//no auth api
Route::group(['middleware' => ['cors']], function () {
    Route::get('/category/list', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('/banner/list', [App\Http\Controllers\Api\BannerController::class, 'index']);
    Route::get('/medicine/list', [App\Http\Controllers\Api\MedicineController::class, 'index']);
    /* geo location */
    Route::get('/division/list', [App\Http\Controllers\Api\GeoLocationController::class, 'division']);
    Route::get('/district/list', [App\Http\Controllers\Api\GeoLocationController::class, 'district']);
    Route::get('/thana/list', [App\Http\Controllers\Api\GeoLocationController::class, 'thana']);
    Route::get('/union/list', [App\Http\Controllers\Api\GeoLocationController::class, 'union']);
    /* product */
    Route::get('/product/list', [App\Http\Controllers\Api\ProductController::class, 'index']);
});

