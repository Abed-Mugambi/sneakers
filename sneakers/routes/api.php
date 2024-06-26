<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;

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

// route to register and login using sanctum
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);



// route to get all products
Route::apiResource('/products', ProductController::class);

Route::group(['prefix' => 'products'], function () {
    Route::apiResource('/{product}/reviews', ReviewController::class);
});



// route to create a new product
Route::middleware('auth:sanctum')->post('/products/create', [ProductController::class, 'store']);

// route to update a product
Route::middleware('auth:sanctum')->put('/products/{product}', [ProductController::class, 'update']);

// route to delete a product
Route::middleware('auth:sanctum')->delete('/products/{product}', [ProductController::class, 'destroy']);

// route to get an image
Route::get('/products/{product}/image', [ProductController::class, 'getImage']);

// route to add product to cart
// Route::middleware('auth:sanctum')->post('/cart/{productId}', [CartController::class, 'cart']);
Route::post('/cart/{productId}', [CartController::class, 'cart']);

// route to get products from cart
Route::get('/api/products/cart', [CartController::class, 'getProductsFromCart']);

// route to add to checkout
