<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\apiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [apiController::class, 'getProducts']); 
Route::get('/products/{id}', [apiController::class, 'getProductById']);
Route::post('/products', [apiController::class, 'store']);
Route::put('/products/{id}', [apiController::class, 'update']);
Route::delete('/products/{id}', [apiController::class, 'destroy']);



//// http://127.0.0.1:8000/api/products