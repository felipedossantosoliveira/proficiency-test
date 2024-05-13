<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('auth/create-token', [AuthController::class, 'createToken']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('auth')->group(function () {
            Route::get('/list-tokens', [AuthController::class, 'listTokens']);
            Route::delete('/revoke-token', [AuthController::class, 'revokeToken']);
        });

        Route::prefix('customers')
            ->controller(CustomerController::class)
            ->group(function () {
                apiResource(image: true);
            });

        Route::prefix('products')
            ->controller(ProductController::class)
            ->group(function () {
                apiResource(image: true);
            });
    });
});
