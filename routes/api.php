<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\apiController;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [apiController::class, 'getProducts']); 
Route::get('/products/{id}', [apiController::class, 'getProductById']);
Route::post('/products', [apiController::class, 'store']);
Route::put('/products/{id}', [apiController::class, 'update']);
Route::delete('/products/{id}', [apiController::class, 'destroy']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require JWT in Authorization header)
Route::middleware(['jwt.auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Optional: User management
    Route::get('/users', [AuthController::class, 'listUsers']);
});


//// https://sneakerhub-main-ys9otk.laravel.cloud/api/products
//  https://sneakerhub-main-ys9otk.laravel.cloud/api/products/1683d598aa599a73b67068353
//   Create a new product   https://sneakerhub-main-ys9otk.laravel.cloud/api/products
//   
// 
// 