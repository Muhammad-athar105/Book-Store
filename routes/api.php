<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;

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

Route::Post('/register', [UserController::class,'register']);
Route::Post('/login', [UserController::class,'login']); 
Route::resource('books', BookController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('orders', OrderController::class);
// Route::get('/books/{id}/rating', [ReviewController::class,'averageRatingForBook']); 

// Cart Routes
Route::Post('/cart/add', [CartController::class,'add']); 
Route::get('/cart', [CartController::class,'getAll']); 
Route::Put('/cart/{id}', [CartController::class,'update']); 
Route::delete('/cart/{id}', [CartController::class,'delete']); 


Route::middleware('auth:sanctum')->group(function () {
    Route::Post('/logout', [UserController::class,'logout']);
});