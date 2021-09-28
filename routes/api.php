<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\foodController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UploadImgController;
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
    Route::get('pizza', [foodController::class, 'pizza']);
    Route::get('burger', [foodController::class, 'burger']);
    Route::get('cocktail', [foodController::class, 'cocktail']);
    Route::get('speciality', [foodController::class, 'speciality']);
});

// category food
Route::prefix('category')->group( function(){
    Route::get('all', [CategoryController::class, 'all']);
    Route::get('one/{id}', [CategoryController::class, 'search']);
});

// authentification
Route::prefix('auth')->group(function(){
    Route::post('signin', [AuthController::class, 'signIn']);
    Route::post('signup', [AuthController::class, 'signUp']);
    Route::post('admin', [AuthController::class, 'admin']);
    Route::get('one/{id}', [AuthController::class, 'one']);
    Route::delete('delete/{id}', [AuthController::class, 'delete']);
});

// chefs
Route::prefix('chef')->group(function(){
    Route::get('all', [ChefController::class, 'all']);
    Route::post('create', [ChefController::class, 'create']);
});

// reservation
Route::prefix('reservation')->group(function(){
    Route::get('getBooking', [ReservationController::class, 'getReservation']);
    Route::post('booking', [ReservationController::class, 'reservation']);
    Route::delete('delete/{id}', [ReservationController::class, 'delete']);
});

// commande
Route::prefix('commande')->group(function(){
    Route::get('getOrder', [CommandeController::class, 'getOrder']);
    Route::post('order', [CommandeController::class, 'order']);
    Route::get('myOrder/{id}', [CommandeController::class, 'myOrder']);
    Route::delete('delete/{id}', [CommandeController::class, 'delete']);
});

Route::post('uploads', [UploadImgController::class, 'index']);
Route::post('contact', [ContactController::class,'contact']);