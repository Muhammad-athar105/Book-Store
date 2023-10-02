<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\NewsletterController;




// Admin Routes
Route::middleware(['auth','isAdmin'])->group(function (){
    
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/books/create', [BookController::class, 'store']);
    Route::patch('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    
});

// Public Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::post('/subscribe', [NewsletterController::class, 'subscribe']);
Route::post('/unsubscribe', [NewsletterController::class, 'unsubscribe']);

// User Routes
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::post('/orders/create', [OrderController::class, 'store']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'getAll']);
    Route::delete('/cart/{id}', [CartController::class, 'delete']);
    Route::resource('reviews', ReviewController::class);
    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::post('add-wishlist', [WishlistController::class, 'addWishList']);
    Route::delete('/delete-wishlist', [WishlistController::class, 'deleteWishList']);
});








































