<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\foodController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('food')->group(function () {
    Route::get('/all', [foodController::class, 'All']);
    Route::get('/one/{id}', [foodController::class, 'One']);
    Route::post('/create', [foodController::class, 'Create']);
    Route::put('/update/{id}', [foodController::class, 'Update']);
    Route::delete('/delete/{id}', [foodController::class, 'Delete']);
});




Route::prefix('category')->group( function(){
    Route::get('all', [CategoryController::class, 'all']);
    Route::get('one/{id}', [CategoryController::class, 'search']);
});

Route::get('restaurant/{id}', [RestaurantController::class, 'restaurant']);


